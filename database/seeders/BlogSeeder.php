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
        if ($admins->isEmpty()) {
            $admins = User::where('role', 'superadmin')->get();
        }
        
        $blogsData = [
            [
                'title' => 'Tips Mencuci Rajutan Wol Agar Awet',
                'title_en' => 'Tips for Washing Wool Knits to Last Long',
                'content' => 'Merajut pakaian wol membutuhkan waktu dan usaha, jadi wajar jika Anda ingin rajutan tersebut bertahan lama. Kunci utama perawatan wol adalah mencuci secara manual dengan air dingin dan sabun khusus wol. Hindari memeras terlalu keras, cukup tekan lembut dan keringkan mendatar di atas handuk kering.',
                'content_en' => 'Knitting wool garments takes time and effort, so it is natural to want them to last. The main key to wool care is manual washing with cold water and special wool detergent. Avoid wringing too hard, simply press gently and dry flat on a dry towel.',
            ],
            [
                'title' => 'Sejarah Seni Merajut di Nusantara',
                'title_en' => 'History of Knitting Art in the Archipelago',
                'content' => 'Seni merajut masuk ke Nusantara sejak zaman kolonial dan terus berkembang sebagai kerajinan tangan bernilai seni tinggi. Hari ini, para perajin lokal memadukan teknik rajut modern dengan motif tradisional Indonesia untuk menciptakan karya yang unik dan diminati pasar global.',
                'content_en' => 'The art of knitting entered the archipelago since colonial times and continues to develop as a handcraft of high artistic value. Today, local artisans combine modern knitting techniques with traditional Indonesian motifs to create unique masterpieces sought after by the global market.',
            ],
            [
                'title' => 'Manfaat Psikologis Merajut untuk Ketenangan',
                'title_en' => 'Psychological Benefits of Knitting for Calming',
                'content' => 'Banyak orang menganggap merajut sebagai bentuk meditasi aktif. Gerakan berulang merajut merangsang pelepasan dopamin yang meredakan stres dan kecemasan, sekaligus melatih fokus dan kesabaran kita di era serba cepat ini.',
                'content_en' => 'Many consider knitting as a form of active meditation. The repetitive movement of knitting stimulates dopamine release, which relieves stress and anxiety, while training our focus and patience in this fast-paced era.',
            ],
            [
                'title' => 'Cara Memilih Benang Terbaik untuk Cardigan',
                'title_en' => 'How to Choose the Best Yarn for Cardigans',
                'content' => 'Untuk membuat cardigan yang nyaman, pilihlah benang yang lembut namun kuat seperti campuran katun dan wol premium. Ketebalan benang juga menentukan kehangatan dan kelenturan pakaian Anda saat dikenakan sehari-hari.',
                'content_en' => 'To make a comfortable cardigan, choose a soft yet strong yarn such as a premium cotton and wool blend. The thickness of the yarn also determines the warmth and flexibility of your garment for daily wear.',
            ],
            [
                'title' => 'Cerita Nenek: Rajutan Cinta Pertama Kami',
                'title_en' => 'Grandma’s Story: Our First Knit of Love',
                'content' => 'Semua ini berawal di teras rumah sederhana Nenek, dengan sepasang jarum rajut tua dan gulungan benang wol merah muda. Dari rajutan pertama itulah lahir komitmen kami untuk membagikan kehangatan dan kasih sayang melalui setiap helai rajutan premium.',
                'content_en' => 'All this started on Grandma’s simple porch, with a pair of old knitting needles and a roll of pink wool yarn. From that first knit was born our commitment to share warmth and affection through every thread of premium knitting.',
            ],
        ];

        foreach ($blogsData as $index => $data) {
            Blog::create([
                'author_id' => $admins->random()->id,
                'title' => $data['title'],
                'title_en' => $data['title_en'],
                'slug' => Str::slug($data['title']),
                'content' => $data['content'],
                'content_en' => $data['content_en'],
                'image' => "https://picsum.photos/seed/blog-" . ($index + 1) . "/800/400",
                'status' => 'published',
                'published_at' => now()->subDays(rand(1, 30)),
            ]);
        }
    }
}
