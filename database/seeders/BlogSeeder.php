<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    public function run()
    {
        $authorId = User::where('role', 'admin')->value('id') ?? User::where('role', 'superadmin')->value('id');
        
        $blogsData = [
            [
                'id' => 1,
                'title' => 'Baju Brukat: Simbol Elegansi, Budaya, dan Kemewahan',
                'title_en' => 'Brocade Clothing: A Symbol of Elegance, Culture, and Luxury',
                'slug' => 'baju-brukat-simbol-elegansi-budaya-kemewahan',
                'content' => 'Baju brukat bukan hanya dikenal karena keindahan motif dan teksturnya yang mewah, tetapi juga memiliki makna filosofis yang erat kaitannya dengan keanggunan, kelembutan, dan nilai budaya.',
                'content_en' => 'Brocade clothing is known for its beautiful motifs and luxurious texture, carrying a graceful character that feels timeless for special occasions.',
                'views' => 0,
                'published_at' => '2026-06-02 05:50:26',
            ],
            [
                'id' => 2,
                'title' => 'Tampil Elegan dengan Baju Brukat: Cocok Dipakai di Acara Apa Saja?',
                'title_en' => 'Elegant Brocade Looks for Special Occasions',
                'slug' => 'tampil-elegan-baju-brukat',
                'content' => 'Baju brukat atau brokat adalah salah satu jenis busana yang identik dengan kesan elegan, mewah, dan anggun. Tidak heran kalau bahan ini sering dipilih untuk berbagai acara penting.',
                'content_en' => 'Brocade is loved for its elegant, luxurious, and graceful impression, making it suitable for formal events, celebrations, and polished everyday styling.',
                'views' => 0,
                'published_at' => '2026-06-03 05:50:26',
            ],
            [
                'id' => 3,
                'title' => 'Cara Mencuci Baju Brukat Agar Tetap Awet dan Tidak Mudah Rusak',
                'title_en' => 'How to Wash Brocade Clothes So They Last Longer',
                'slug' => 'cara-mencuci-baju-brukat-agar-awet',
                'content' => 'Baju brukat memiliki tekstur yang halus dan detail jahitan yang cukup sensitif, sehingga perlu perawatan khusus saat dicuci agar tidak mudah robek, melar, atau rusak.',
                'content_en' => 'Brocade has delicate texture and sensitive stitched details, so it needs gentle care during washing to keep its shape, finish, and character.',
                'views' => 3,
                'published_at' => '2026-05-09 05:50:26',
            ],
            [
                'id' => 4,
                'title' => 'Makna di Balik Baju Brukat yang Membuatnya Selalu Istimewa',
                'title_en' => 'The Meaning Behind Brocade Clothing',
                'slug' => 'makna-di-balik-baju-brukat-yang-membuat-selalu-istimewah',
                'content' => 'Baju brukat memiliki filosofi mendalam sebagai simbol keanggunan, kemewahan, kesabaran, dan penghormatan terhadap budaya.',
                'content_en' => 'Brocade carries a deep sense of elegance, patience, and cultural respect, which is why it continues to feel special across generations.',
                'views' => 3,
                'published_at' => '2026-05-08 05:50:26',
            ],
            [
                'id' => 5,
                'title' => 'Rahasia Tampil Mewah dan Berkelas dengan Baju Brukat',
                'title_en' => 'How to Look Refined and Elegant in Brocade',
                'slug' => 'rahasia-tampil-mewah-berkelas-dengan-baju-brukat',
                'content' => 'Baju brukat identik dengan kesan elegan, feminin, dan mewah. Tampilan yang berkelas lahir dari pemilihan warna, kualitas bahan, model, aksesori, dan cara membawa diri.',
                'content_en' => 'A refined brocade look comes from thoughtful color choices, quality fabric, careful tailoring, balanced accessories, and the confidence to wear it with ease.',
                'views' => 3,
                'published_at' => '2026-05-21 05:50:26',
            ],
        ];

        foreach ($blogsData as $index => $data) {
            Blog::updateOrCreate(['id' => $data['id']], [
                'author_id' => $authorId,
                'title' => $data['title'],
                'title_en' => $data['title_en'],
                'slug' => $data['slug'],
                'content' => $data['content'],
                'content_en' => $data['content_en'],
                'image' => "https://picsum.photos/seed/blog-" . ($index + 1) . "/800/400",
                'views' => $data['views'],
                'status' => 'published',
                'published_at' => $data['published_at'],
            ]);
        }
    }
}
