<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use Searchable;
    protected $fillable = [
        'category_id', 'name', 'slug', 'description', 
        'price', 'price_min', 'price_max', 'stock', 'is_customizable', 'weight', 'sales_count', 'view_count',
        'image_url', 'rating',
        'meta_title', 'meta_description', 'meta_keywords'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function formattedEstimatedPrice(): string
    {
        $min = $this->price_min ?: $this->price;
        $max = $this->price_max ?: $this->price;

        if ($min && $max && $min !== $max) {
            return 'Rp' . number_format($min, 0, ',', '.') . ' - Rp' . number_format($max, 0, ',', '.');
        }

        return 'Rp' . number_format($min ?: 0, 0, ',', '.');
    }

    public function imageUrl(?string $fallback = null): ?string
    {
        if (!$this->image_url) {
            return $fallback;
        }

        if (str_starts_with($this->image_url, 'http://') || str_starts_with($this->image_url, 'https://') || str_starts_with($this->image_url, '//')) {
            return $this->image_url;
        }

        return asset($this->image_url);
    }
}
