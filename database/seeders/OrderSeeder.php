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
        $couriers = ['jne', 'pos', 'tiki'];

        $realistic_addresses = [
            'Jl. Melati No. 12, Jakarta Selatan',
            'Perumahan Griya Asri Blok C4/10, Bandung',
            'Jl. Sudirman No. 45, Surabaya',
            'Apartemen Gateway Tower A Lt. 15, Tangerang',
            'Jl. Diponegoro No. 88, Semarang',
            'Gg. Kelinci No. 5, Yogyakarta',
        ];

        for ($i = 1; $i <= 40; $i++) {
            $customer = $customers->random();
            $date = now()->subDays(rand(0, 30));
            
            $order = Order::create([
                'user_id' => $customer->id,
                'invoice_number' => 'JN-' . $date->format('Ymd') . '-' . strtoupper(\Illuminate\Support\Str::random(5)),
                'customer_name' => $customer->name,
                'customer_email' => $customer->email,
                'customer_phone' => '08' . rand(11, 19) . rand(1000000, 9999999),
                'customer_address' => $realistic_addresses[rand(0, count($realistic_addresses)-1)],
                'total_price' => 0,
                'shipping_cost' => rand(9000, 25000),
                'status' => $statuses[rand(0, count($statuses)-1)],
                'payment_status' => $payment_statuses[rand(0, 1)],
                'courier' => $couriers[rand(0, 2)],
                'created_at' => $date,
                'updated_at' => $date,
            ]);

            $total = 0;
            $itemsCount = rand(1, 4);
            $selectedProducts = $products->random($itemsCount);

            foreach ($selectedProducts as $product) {
                $qty = rand(1, 2);
                $price = $product->price;
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'price' => $price,
                    'quantity' => $qty,
                    'subtotal' => $price * $qty,
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);
                $total += $price * $qty;
            }
            $order->update(['total_price' => $total + $order->shipping_cost]);
        }
    }
}
