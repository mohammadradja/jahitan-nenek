<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'image_url',
        'description',
        'meta_title',
        'meta_description',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
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
