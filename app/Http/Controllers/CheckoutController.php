<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

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

    public function process(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:30',
            'customer_address' => 'required|string',
            'shipping_cost' => 'required|numeric',
            'courier' => 'required|string',
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
            'payment_method' => 'bank_transfer',
        ]);

        foreach($cart as $id => $details) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $details['product_id'],
                'product_name' => $details['name'],
                'price' => $details['price'],
                'product_price' => $details['price'],
                'quantity' => $details['quantity'],
                'measurements' => $details['measurements'] ?? null,
                'subtotal' => $details['price'] * $details['quantity'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('checkout.payment', $order->id)->with('success', 'Pesanan berhasil dibuat. Silakan transfer pembayaran.');
    }

    public function payment(Order $order)
    {
        if ($order->user_id !== auth()->id() && auth()->user()->role === 'user') {
            abort(403);
        }

        $bankTransferInfo = \App\Models\SiteSetting::get('bank_transfer_info', "BCA: 123-456-7890 a/n Jahitan Nenek\nMandiri: 987-654-3210 a/n Jahitan Nenek");

        return view('checkout.payment', compact('order', 'bankTransferInfo'));
    }

    public function uploadPaymentProof(Request $request, Order $order)
    {
        if ($order->user_id !== auth()->id() && auth()->user()->role === 'user') {
            abort(403);
        }

        $request->validate([
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,webp,gif,avif|max:5120',
        ]);

        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof');
            $filename = 'proof-' . $order->id . '-' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('payment_proofs', $filename, 'public');

            $order->update([
                'payment_proof' => 'storage/' . $path,
                'payment_status' => 'pending_manual_approval',
            ]);

            return redirect()->route('checkout.success', $order->id)->with('success', 'Bukti pembayaran berhasil diunggah. Menunggu konfirmasi admin.');
        }

        return redirect()->back()->with('error', 'Gagal mengunggah bukti pembayaran.');
    }

    public function success(Order $order)
    {
        return view('checkout.success', compact('order'));
    }

    public function track(Request $request)
    {
        if ($request->filled('order_id') && $request->filled('email')) {
            $order = Order::where('id', $request->order_id)
                ->where('customer_email', $request->email)
                ->first();

            if ($order) {
                return view('checkout.track_result', compact('order'));
            }
        }
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
}
