<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if(empty($cart)) {
            return redirect()->route('home')->with('error', 'Keranjang Anda kosong.');
        }

        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('checkout.index', compact('cart', 'total'));
    }

    public function getProvinces()
    {
        $rajaongkir = new \App\Services\RajaOngkirService();
        return response()->json($rajaongkir->getProvinces());
    }

    public function getCities($provinceId)
    {
        $rajaongkir = new \App\Services\RajaOngkirService();
        return response()->json($rajaongkir->getCities($provinceId));
    }

    public function getCost(Request $request)
    {
        $request->validate([
            'city_id' => 'required',
            'courier' => 'required',
        ]);

        $cart = session()->get('cart', []);
        $weight = 0;
        foreach($cart as $id => $item) {
            // Assume default weight of 500g if not specified
            $product = \App\Models\Product::find($id);
            $weight += ($product->weight ?? 500) * $item['quantity'];
        }

        $rajaongkir = new \App\Services\RajaOngkirService();
        $costs = $rajaongkir->getCost($request->city_id, $weight, $request->courier);

        return response()->json($costs);
    }

    public function process(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'customer_email' => 'required|email',
            'customer_phone' => 'required',
            'customer_address' => 'required',
            'city_id' => 'required',
            'shipping_cost' => 'required|numeric',
            'courier' => 'required',
        ]);

        $cart = session()->get('cart', []);
        $subtotal = 0;
        foreach($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $total = $subtotal + $request->shipping_cost;
        $invoice = 'JN-' . date('Ymd') . '-' . strtoupper(\Illuminate\Support\Str::random(5));

        $order = Order::create([
            'user_id' => auth()->id(),
            'invoice_number' => $invoice,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'total_price' => $total,
            'shipping_cost' => $request->shipping_cost,
            'courier' => $request->courier,
            'status' => 'pending',
            'payment_status' => 'unpaid',
        ]);

        foreach($cart as $id => $details) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'product_name' => $details['name'],
                'product_price' => $details['price'],
                'quantity' => $details['quantity'],
                'subtotal' => $details['price'] * $details['quantity'],
            ]);
        }

        // Midtrans Logic
        $serverKey = \App\Models\SiteSetting::get('midtrans_server_key', config('midtrans.server_key'));
        $isProduction = \App\Models\SiteSetting::get('midtrans_is_production', config('midtrans.is_production'));

        if (!$serverKey || $serverKey === 'SB-Mid-server-placeholder' || $serverKey === 'SB-Mid-server-XXXXX') {
            return redirect()->back()->with('error', 'Konfigurasi pembayaran (Midtrans Server Key) belum diatur. Silakan masukkan Server Key yang valid di dashboard admin.');
        }

        Config::$serverKey = $serverKey;
        Config::$isProduction = $isProduction;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $order->invoice_number,
                'gross_amount' => (int) $total,
            ],
            'customer_details' => [
                'first_name' => $request->customer_name,
                'email' => $request->customer_email,
                'phone' => $request->customer_phone,
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            $order->update(['snap_token' => $snapToken]);
            
            session()->forget('cart');
            return view('checkout.payment', compact('order', 'snapToken'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memproses pembayaran: ' . $e->getMessage());
        }
    }

    public function success(Order $order)
    {
        return view('checkout.success', compact('order'));
    }

    public function track()
    {
        return view('checkout.track');
    }

    public function trackOrder(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'email' => 'required|email',
        ]);

        $order = Order::where('id', $request->order_id)
            ->where('customer_email', $request->email)
            ->first();

        if (!$order) {
            return redirect()->back()->with('error', 'Pesanan tidak ditemukan atau informasi tidak cocok.');
        }

        return view('checkout.track_result', compact('order'));
    }

    public function notification(Request $request)
    {
        Config::$serverKey = \App\Models\SiteSetting::get('midtrans_server_key', config('midtrans.server_key'));
        Config::$isProduction = \App\Models\SiteSetting::get('midtrans_is_production', config('midtrans.is_production'));

        try {
            $notification = new \Midtrans\Notification();
            
            $transaction = $notification->transaction_status;
            $type = $notification->payment_type;
            $order_id_raw = $notification->order_id;
            $order_id = explode('-', $order_id_raw)[0]; // Extract original ID
            $fraud = $notification->fraud_status;

            $order = Order::find($order_id);

            if (!$order) {
                return response()->json(['message' => 'Order not found'], 404);
            }

            if ($transaction == 'capture') {
                if ($type == 'credit_card') {
                    if ($fraud == 'challenge') {
                        $order->update(['payment_status' => 'challenge']);
                    } else {
                        $order->update(['payment_status' => 'paid', 'status' => 'processing']);
                    }
                }
            } else if ($transaction == 'settlement') {
                $order->update(['payment_status' => 'paid', 'status' => 'processing']);
            } else if ($transaction == 'pending') {
                $order->update(['payment_status' => 'pending']);
            } else if ($transaction == 'deny') {
                $order->update(['payment_status' => 'denied']);
            } else if ($transaction == 'expire') {
                $order->update(['payment_status' => 'expired']);
            } else if ($transaction == 'cancel') {
                $order->update(['payment_status' => 'cancelled']);
            }

            return response()->json(['message' => 'Notification processed']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
