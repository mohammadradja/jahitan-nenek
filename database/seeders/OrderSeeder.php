<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $customers = User::where('role', 'user')->get();
        $products = Product::all();
        $statuses = ['pending', 'paid', 'shipped', 'completed', 'cancelled'];
        $payment_statuses = ['unpaid', 'paid', 'expired'];

        for ($i = 1; $i <= 30; $i++) {
            $customer = $customers->random();
            $order = Order::create([
                'user_id' => $customer->id,
                'invoice_number' => 'JN-' . date('Ymd') . '-' . strtoupper(\Illuminate\Support\Str::random(5)),
                'customer_name' => $customer->name,
                'customer_email' => $customer->email,
                'customer_phone' => '0812' . rand(1000000, 9999999),
                'customer_address' => 'Alamat Pengiriman Order #' . $i,
                'total_price' => 0, // calculated below
                'shipping_cost' => rand(10000, 50000),
                'status' => $statuses[rand(0, 2)], // keep it active
                'payment_status' => $payment_statuses[rand(0, 1)],
                'courier' => 'jne',
            ]);

            $total = 0;
            $itemsCount = rand(1, 3);
            for ($j = 0; $j < $itemsCount; $j++) {
                $product = $products->random();
                $qty = rand(1, 2);
                $price = $product->price;
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'product_price' => $price,
                    'quantity' => $qty,
                    'subtotal' => $price * $qty,
                ]);
                $total += $price * $qty;
            }
            $order->update(['total_price' => $total + $order->shipping_cost]);
        }
    }
}
