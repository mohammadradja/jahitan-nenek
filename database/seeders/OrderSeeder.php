<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $orders = [
            [1, 3, 'JN-20260518-JEEAS', 'Customer Happy', 'customer@example.com', '08193659679', 'Jl. Aria Santika, Kota Tangerang', 0, 0, 'pending', 'unpaid', 'tiki', '2026-05-18 05:50:26'],
            [2, 3, 'JN-20260607-CZDL3', 'Customer Happy', 'customer@example.com', '08196638530', 'Jl. Aria Santika, Kota Tangerang', 0, 0, 'pending', 'unpaid', 'jne', '2026-06-07 05:50:26'],
            [3, 3, 'JN-20260520-PMAAS', 'Customer Happy', 'customer@example.com', '08186436352', 'Jl. Aria Santika, Kota Tangerang', 0, 0, 'completed', 'paid', 'tiki', '2026-05-20 05:50:26'],
            [4, 3, 'JN-20260520-3SQZO', 'Customer Happy', 'customer@example.com', '08138942781', 'Jl. Aria Santika, Kota Tangerang', 0, 0, 'completed', 'paid', 'tiki', '2026-05-20 05:50:26'],
            [5, 3, 'JN-20260604-ALYYR', 'Customer Happy', 'customer@example.com', '08155802593', 'Jl. Aria Santika, Kota Tangerang', 0, 0, 'pending', 'paid', 'tiki', '2026-06-04 05:50:26'],
        ];

        foreach ($orders as [$id, $userId, $invoice, $name, $email, $phone, $address, $total, $shipping, $status, $paymentStatus, $courier, $createdAt]) {
            Order::updateOrCreate(['id' => $id], [
                'user_id' => $userId,
                'invoice_number' => $invoice,
                'customer_name' => $name,
                'customer_email' => $email,
                'customer_phone' => $phone,
                'customer_address' => $address,
                'total_price' => $total,
                'shipping_cost' => $shipping,
                'status' => $status,
                'payment_status' => $paymentStatus,
                'courier' => $courier,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);
        }

        $items = [
            [1, 1, null, 'Atasan Brukat #13', 2, 0, 0, '2026-05-18 05:50:26'],
            [2, 1, null, 'Dress Brukat #25', 1, 0, 0, '2026-05-18 05:50:26'],
            [3, 1, null, 'Outer Brukat #36', 1, 0, 0, '2026-05-18 05:50:26'],
            [4, 2, 4, 'Artisan Brukat #4', 1, 0, 0, '2026-06-07 05:50:26'],
            [5, 2, 9, 'Set Brukat Pastel #9', 2, 0, 0, '2026-06-07 05:50:26'],
            [6, 2, null, 'Outer Brukat #36', 2, 0, 0, '2026-06-07 05:50:26'],
            [7, 3, 4, 'Artisan Brukat #4', 1, 0, 0, '2026-05-20 05:50:26'],
            [8, 3, null, 'Set Brukat Pastel #39', 1, 0, 0, '2026-05-20 05:50:26'],
            [9, 3, null, 'Rok Brukat Vintage #47', 1, 0, 0, '2026-05-20 05:50:26'],
            [10, 4, null, 'Dress Brukat Ceria #27', 1, 0, 0, '2026-05-20 05:50:26'],
            [11, 5, null, 'Outer Brukat Modern #8', 2, 0, 0, '2026-06-04 05:50:26'],
            [12, 5, null, 'Dress Brukat Ceria #12', 2, 0, 0, '2026-06-04 05:50:26'],
            [13, 5, 16, 'Atasan Brukat Custom #16', 1, 0, 0, '2026-06-04 05:50:26'],
            [14, 5, null, 'Atasan Brukat Custom #31', 2, 0, 0, '2026-06-04 05:50:26'],
        ];

        foreach ($items as [$id, $orderId, $productId, $name, $quantity, $price, $subtotal, $createdAt]) {
            OrderItem::updateOrCreate(['id' => $id], [
                'order_id' => $orderId,
                'product_id' => $productId,
                'product_name' => $name,
                'product_price' => $price,
                'price' => $price,
                'quantity' => $quantity,
                'subtotal' => $subtotal,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);
        }
    }
}
