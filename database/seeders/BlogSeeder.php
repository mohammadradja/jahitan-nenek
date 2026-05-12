<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run()
    {
        $admins = User::where('role', 'admin')->get();
        
        $titles = [
            'Tips Mencuci Rajutan Wol', 'Sejarah Merajut di Indonesia', 
            'Manfaat Psikologis Merajut', 'Memilih Benang Terbaik',
            'Cerita Nenek: Rajutan Pertama', 'Trend Fashion Knitwear 2026',
            'Cara Memulai Amigurumi', 'Mengenal Berbagai Jenis Simpul',
            'Komunitas Rajut Bandung', 'Kisah Penjahit Lokal Kami'
        ];

        for ($i = 1; $i <= 15; $i++) {
            $title = $titles[$i % count($titles)] . " Vol. " . $i;
            Blog::create([
                'author_id' => $admins->random()->id,
                'title' => $title,
                'slug' => Str::slug($title),
                'content' => "Ini adalah konten blog tentang dunia rajutan. Kami membagikan tips, trik, dan cerita inspiratif di balik setiap produk yang kami buat...",
                'image' => "https://picsum.photos/seed/blog-" . $i . "/800/400",
                'published_at' => now()->subDays(rand(1, 30)),
            ]);
        }
    }
}
