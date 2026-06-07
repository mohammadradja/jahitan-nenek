<?php

namespace Tests\Feature\Admin;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_render_category_edit_page(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $category = Category::create([
            'name' => 'Cardigan Lama',
            'slug' => 'cardigan-lama',
        ]);

        $response = $this->actingAs($admin)->get(route('admin.categories.edit', $category));

        $response->assertOk();
        $response->assertSee('Edit Kategori');
        $response->assertSee('Cardigan Lama');
    }

    public function test_admin_can_update_category(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $category = Category::create([
            'name' => 'Cardigan Lama',
            'slug' => 'cardigan-lama',
        ]);

        $response = $this->actingAs($admin)->put(route('admin.categories.update', $category), [
            'name' => 'Cardigan Baru',
            'slug' => 'cardigan-baru',
            'image_url' => 'https://example.com/cardigan.jpg',
            'description' => 'Kategori cardigan rajut terbaru.',
            'meta_title' => 'Cardigan Rajut',
            'meta_description' => 'Koleksi cardigan rajut handmade.',
        ]);

        $response->assertRedirect(route('admin.categories.index'));
        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => 'Cardigan Baru',
            'slug' => 'cardigan-baru',
            'image_url' => 'https://example.com/cardigan.jpg',
            'description' => 'Kategori cardigan rajut terbaru.',
            'meta_title' => 'Cardigan Rajut',
            'meta_description' => 'Koleksi cardigan rajut handmade.',
        ]);
    }

    public function test_superadmin_can_update_category_through_admin_category_routes(): void
    {
        $superadmin = User::factory()->create(['role' => 'superadmin']);
        $category = Category::create([
            'name' => 'Syal Lama',
            'slug' => 'syal-lama',
        ]);

        $response = $this->actingAs($superadmin)->put(route('admin.categories.update', $category), [
            'name' => 'Syal Baru',
            'slug' => 'syal-baru',
        ]);

        $response->assertRedirect(route('admin.categories.index'));
        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => 'Syal Baru',
            'slug' => 'syal-baru',
        ]);
    }
}
