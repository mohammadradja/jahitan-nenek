<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $categories = Category::all();

        $names = [
            'Classic Wool Sweater', 'Hand-knitted Scarf', 'Vintage Beanie', 
            'Crochet Teddy Bear', 'Artisan Totebag', 'Boho Cardigan', 
            'Chunky Knit Blanket', 'Floral Amigurumi', 'Modern Beret',
            'Pastel Poncho', 'Nordic Pattern Jumper', 'Silk Blend Scarf',
            'Rainbow Baby Booties', 'Minimalist Knit Vest', 'Oversized Knit Jacket'
        ];

        for ($i = 1; $i <= 50; $i++) {
            $baseName = $names[$i % count($names)];
            $name = $baseName . " #" . $i;
            Product::create([
                'category_id' => $categories->random()->id,
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => "Produk rajutan tangan berkualitas tinggi yang dibuat dengan kasih sayang oleh Nenek dan penjahit lokal pilihan. Menggunakan bahan premium yang nyaman di kulit.",
                'price' => rand(50000, 1500000),
                'stock' => rand(5, 100),
                'image_url' => "https://picsum.photos/seed/" . Str::slug($name) . "/400/500",
                'rating' => rand(40, 50) / 10,
            ]);
        }
    }
}
