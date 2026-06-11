<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [1, 4, 'Aurelia Lace #1', 'aurelia-lace-1', 'Atasan brukat warna broken white dengan detail pita depan yang manis dan feminin. Modelnya flowy dengan lengan transparan, cocok dipakai untuk acara formal, kondangan, atau outfit semi classy sehari-hari.', 49999, 50000, 100000, 9, 'https://picsum.photos/seed/aurelia-lace-1/400/500', 4.3],
            [2, 4, 'Midnight Bloom #2', 'midnight-bloom-2', 'Outer brukat hitam dengan motif floral elegan dan sentuhan transparan yang memberi kesan chic dan modern. Dipadukan dengan inner simpel membuat look terlihat mewah tapi tetap effortless.', 79999, 80000, 130000, 31, 'https://picsum.photos/seed/midnight-bloom-2/400/500', 4.5],
            [3, 1, 'Rose Ethnica #3', 'rose-ethnica-3', 'Dress bernuansa dusty pink dengan motif etnik artistik yang unik. Potongannya longgar dan nyaman dipakai, memberikan kesan anggun, kalem, dan classy untuk berbagai acara spesial.', 119000, 119000, 180000, 25, 'https://picsum.photos/seed/crose-ethnica-3/400/500', 4.1],
            [4, 5, 'Ivory Grace #4', 'ivory-grace-4', 'Set outfit bernuansa putih lembut dengan detail floral transparan yang feminin. Modelnya simple elegant, cocok untuk tampilan hijab yang clean, manis, dan berkelas.', 119000, 119000, 180000, 22, 'https://picsum.photos/seed/ivory-grace-4/400/500', 4.4],
            [5, 1, 'Veloura Blossom #5', 'veloura-blossom-5', 'Outer brukat premium dengan bordir bunga maroon dan gold yang mewah. Detail bordir timbul memberikan kesan glamor dan eksklusif, cocok untuk party, kondangan, atau acara formal.', 149000, 149000, 220000, 32, 'https://picsum.photos/seed/veloura-blossom-5/400/500', 4.3],
            [6, 3, 'Snow Elara #6', 'snow-elara-6', 'One set putih minimalis dengan aksen brukat halus yang memberi tampilan clean dan sophisticated. Modelnya anggun, ringan dipakai, dan cocok untuk pecinta outfit monochrome elegan.', 53999, 54000, 104000, 13, 'https://picsum.photos/seed/snow-elara-6/400/500', 4.5],
            [7, 3, 'Silver Mist #7', 'silver-mist-7', 'Outer transparan warna silver abu dengan motif abstrak modern. Desainnya unik dan artsy, cocok dipadukan dengan inner polos untuk menciptakan look fashionable dan kekinian.', 47800, 47800, 97800, 15, 'https://picsum.photos/seed/silver-mist-7/400/500', 4.5],
            [9, 1, 'Dress Custome #8', 'dress-custome-9', 'Produk rajutan tangan berkualitas tinggi yang dibuat dengan kasih sayang oleh Nenek dan penjahit lokal pilihan. Menggunakan bahan premium yang nyaman di kulit. Untuk Dress Custome kirim desain dan ukuran melalui WhatsApp admin.', 179000, 179000, 300000, 6, 'https://picsum.photos/seed/dress-custome-9/400/500', 4.6],
            [15, 2, 'Cardigan Brukat Custome #9', 'cardigan-brukat-custome-9', 'Produk rajutan tangan berkualitas tinggi yang dibuat dengan kasih sayang oleh Nenek dan penjahit lokal pilihan. Menggunakan bahan premium yang nyaman di kulit. Untuk Cardigan Brukat Costume bahan dan ukuran chat WhatsApp admin.', 119000, 119000, 240000, 73, 'https://picsum.photos/seed/cardigan-brukat-custome-9/400/500', 4.8],
            [16, 3, 'Rompi Brukat Custome #10', 'rompi-brukat-custome-10', 'Produk rajutan tangan berkualitas tinggi yang dibuat dengan kasih sayang oleh Nenek dan penjahit lokal pilihan. Menggunakan bahan premium yang nyaman di kulit. Untuk Rompi Brukat Custome desain dan ukuran chat WhatsApp admin.', 66000, 66000, 130000, 63, 'https://picsum.photos/seed/rompi-brukat-custome-10/400/500', 4.8],
            [17, 4, 'Atasan Brukat Custome #11', 'atasan-brukat-custome-11', 'Produk rajutan tangan berkualitas tinggi yang dibuat dengan kasih sayang oleh Nenek dan penjahit lokal pilihan. Menggunakan bahan premium yang nyaman di kulit. Untuk Atasan Brukat Custome desain dan ukuran kirim ke WhatsApp admin.', 119000, 119000, 220000, 39, 'https://picsum.photos/seed/atasan-brukat-custome-11/400/500', 4.1],
            [18, 5, 'Set Brukat Custome #18', 'set-brukat-custome-12', 'Produk rajutan tangan berkualitas tinggi yang dibuat dengan kasih sayang oleh Nenek dan penjahit lokal pilihan. Menggunakan bahan premium yang nyaman di kulit. Untuk Set Brukat Custome desain dan ukuran chat WhatsApp admin.', 199999, 200000, 350000, 64, 'https://picsum.photos/seed/set-brukat-custome-12/400/500', 4.6],
            [19, 6, 'Rok Brukat Costume #13', 'rok-brukat-custome-13', 'Produk rajutan tangan berkualitas tinggi yang dibuat dengan kasih sayang oleh Nenek dan penjahit lokal pilihan. Menggunakan bahan premium yang nyaman di kulit. Untuk Rok Brukat Costume desain dan ukuran kirim chat WhatsApps admin.', 147999, 148000, 250000, 22, 'https://picsum.photos/seed/rok-brukat-costume-13/400/500', 4.9],
        ];

        foreach ($products as [$id, $categoryId, $name, $slug, $description, $price, $priceMin, $priceMax, $stock, $imageUrl, $rating]) {
            Product::updateOrCreate(
                ['id' => $id],
                [
                    'category_id' => $categoryId,
                    'name' => $name,
                    'slug' => $slug,
                    'description' => $description,
                    'price' => $price,
                    'price_min' => $priceMin,
                    'price_max' => $priceMax,
                    'stock' => $stock,
                    'is_customizable' => false,
                    'weight' => 500,
                    'image_url' => $imageUrl,
                    'rating' => $rating,
                    'sales_count' => 0,
                    'view_count' => 0,
                ]
            );
        }
    }
}
