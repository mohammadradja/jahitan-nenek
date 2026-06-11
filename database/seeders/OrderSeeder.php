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
            [1, 3, 'JN-20260518-JEEAS', 'Customer Happy', 'customer@example.com', '08193659679', 'Jl. Sudirman No. 45, Surabaya', 2080254, 19146, 'pending', 'unpaid', 'tiki', '2026-05-18 05:50:26'],
            [2, 3, 'JN-20260607-CZDL3', 'Customer Happy', 'customer@example.com', '08196638530', 'Perumahan Griya Asri Blok C4/10, Bandung', 4938430, 18403, 'pending', 'unpaid', 'jne', '2026-06-07 05:50:26'],
            [3, 3, 'JN-20260520-PMAAS', 'Customer Happy', 'customer@example.com', '08186436352', 'Jl. Melati No. 12, Jakarta Selatan', 4098778, 18241, 'completed', 'paid', 'tiki', '2026-05-20 05:50:26'],
            [4, 3, 'JN-20260520-3SQZO', 'Customer Happy', 'customer@example.com', '08138942781', 'Jl. Melati No. 12, Jakarta Selatan', 1082381, 10827, 'completed', 'paid', 'tiki', '2026-05-20 05:50:26'],
            [5, 3, 'JN-20260604-ALYYR', 'Customer Happy', 'customer@example.com', '08155802593', 'Perumahan Griya Asri Blok C4/10, Bandung', 6251568, 14543, 'pending', 'paid', 'tiki', '2026-06-04 05:50:26'],
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
            [1, 1, null, 'Minimalist Knit Vest #13', 2, 72985, 145970, '2026-05-18 05:50:26'],
            [2, 1, null, 'Nordic Pattern Jumper #25', 1, 1388304, 1388304, '2026-05-18 05:50:26'],
            [3, 1, null, 'Chunky Knit Blanket #36', 1, 526834, 526834, '2026-05-18 05:50:26'],
            [4, 2, 4, 'Artisan Totebag #4', 1, 1350713, 1350713, '2026-06-07 05:50:26'],
            [5, 2, 9, 'Pastel Poncho #9', 2, 1257823, 2515646, '2026-06-07 05:50:26'],
            [6, 2, null, 'Chunky Knit Blanket #36', 2, 526834, 1053668, '2026-06-07 05:50:26'],
            [7, 3, 4, 'Artisan Totebag #4', 1, 1350713, 1350713, '2026-05-20 05:50:26'],
            [8, 3, null, 'Pastel Poncho #39', 1, 1478171, 1478171, '2026-05-20 05:50:26'],
            [9, 3, null, 'Vintage Beanie #47', 1, 1251653, 1251653, '2026-05-20 05:50:26'],
            [10, 4, null, 'Rainbow Baby Booties #27', 1, 1071554, 1071554, '2026-05-20 05:50:26'],
            [11, 5, null, 'Modern Beret #8', 2, 1433437, 2866874, '2026-06-04 05:50:26'],
            [12, 5, null, 'Rainbow Baby Booties #12', 2, 324424, 648848, '2026-06-04 05:50:26'],
            [13, 5, 16, 'Hand-knitted Scarf #16', 1, 886335, 886335, '2026-06-04 05:50:26'],
            [14, 5, null, 'Hand-knitted Scarf #31', 2, 917484, 1834968, '2026-06-04 05:50:26'],
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
