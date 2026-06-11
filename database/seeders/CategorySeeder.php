<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['id' => 1, 'name' => 'Dress', 'slug' => 'dress', 'image_url' => 'https://picsum.photos/seed/blog-1/800/400'],
            ['id' => 2, 'name' => 'Cardigan', 'slug' => 'cardigan'],
            ['id' => 3, 'name' => 'Rompi', 'slug' => 'rompi'],
            ['id' => 4, 'name' => 'Atasan', 'slug' => 'atasan'],
            ['id' => 5, 'name' => 'Set Brukat', 'slug' => 'set-brukat'],
            ['id' => 6, 'name' => 'Rok Brukat', 'slug' => 'rok-brukat', 'image_url' => 'https://picsum.photos/seed/blog-1/800/400'],
        ];

        foreach ($categories as $category) {
            $id = $category['id'];
            unset($category['id']);

            Category::updateOrCreate(
                ['id' => $id],
                $category
            );
        }
    }
}
