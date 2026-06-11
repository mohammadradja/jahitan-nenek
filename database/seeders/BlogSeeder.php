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
                'title_en' => 'Tips for Washing Wool Knits to Last Long',
                'slug' => 'tips-mencuci-rajutan-wol-agar-awet',
                'content' => 'Baju brukat bukan hanya dikenal karena keindahan motif dan teksturnya yang mewah, tetapi juga memiliki makna filosofis yang erat kaitannya dengan keanggunan, kelembutan, dan nilai budaya.',
                'content_en' => 'Knitting wool garments takes time and effort, so it is natural to want them to last. The main key to wool care is manual washing with cold water and special wool detergent. Avoid wringing too hard, simply press gently and dry flat on a dry towel.',
                'views' => 0,
                'published_at' => '2026-06-02 05:50:26',
            ],
            [
                'id' => 2,
                'title' => 'Tampil Elegan dengan Baju Brukat: Cocok Dipakai di Acara Apa Saja?',
                'title_en' => 'History of Knitting Art in the Archipelago',
                'slug' => 'tampil-elegan-baju-brukat',
                'content' => 'Baju brukat atau brokat adalah salah satu jenis busana yang identik dengan kesan elegan, mewah, dan anggun. Tidak heran kalau bahan ini sering dipilih untuk berbagai acara penting.',
                'content_en' => 'The art of knitting entered the archipelago since colonial times and continues to develop as a handcraft of high artistic value. Today, local artisans combine modern knitting techniques with traditional Indonesian motifs to create unique masterpieces sought after by the global market.',
                'views' => 0,
                'published_at' => '2026-06-03 05:50:26',
            ],
            [
                'id' => 3,
                'title' => 'Cara Mencuci Baju Brukat Agar Tetap Awet dan Tidak Mudah Rusak',
                'title_en' => 'Psychological Benefits of Knitting for Calming',
                'slug' => 'manfaat-psikologis-merajut-untuk-ketenangan',
                'content' => 'Baju brukat memiliki tekstur yang halus dan detail jahitan yang cukup sensitif, sehingga perlu perawatan khusus saat dicuci agar tidak mudah robek, melar, atau rusak.',
                'content_en' => 'Many consider knitting as a form of active meditation. The repetitive movement of knitting stimulates dopamine release, which relieves stress and anxiety, while training our focus and patience in this fast-paced era.',
                'views' => 3,
                'published_at' => '2026-05-09 05:50:26',
            ],
            [
                'id' => 4,
                'title' => 'Makna di Balik Baju Brukat yang Membuatnya Selalu Istimewa',
                'title_en' => 'How to Choose the Best Yarn for Cardigans',
                'slug' => 'makna-di-balik-baju-brukat-yang-membuat-selalu-istimewah',
                'content' => 'Baju brukat memiliki filosofi mendalam sebagai simbol keanggunan, kemewahan, kesabaran, dan penghormatan terhadap budaya.',
                'content_en' => 'To make a comfortable cardigan, choose a soft yet strong yarn such as a premium cotton and wool blend. The thickness of the yarn also determines the warmth and flexibility of your garment for daily wear.',
                'views' => 3,
                'published_at' => '2026-05-08 05:50:26',
            ],
            [
                'id' => 5,
                'title' => 'Rahasia Tampil Mewah dan Berkelas dengan Baju Brukat',
                'title_en' => 'Grandma’s Story: Our First Knit of Love',
                'slug' => 'rahasia-tampil-mewah-berkelas-dengan-baju-brukat',
                'content' => 'Baju brukat identik dengan kesan elegan, feminin, dan mewah. Tampilan yang berkelas lahir dari pemilihan warna, kualitas bahan, model, aksesori, dan cara membawa diri.',
                'content_en' => 'All this started on Grandma’s simple porch, with a pair of old knitting needles and a roll of pink wool yarn. From that first knit was born our commitment to share warmth and affection through every thread of premium knitting.',
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
