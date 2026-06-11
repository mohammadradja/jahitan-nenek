<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Blog extends Model
{
    use Searchable;
    protected $fillable = [
        'author_id', 'title', 'title_en', 'slug', 'content', 'content_en', 'excerpt', 'excerpt_en', 'image', 'published_at',
        'meta_title', 'meta_description', 'meta_keywords', 'views', 'status'
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function getTitleAttribute($value)
    {
        if (request()->is('admin/*') || request()->is('superadmin/*')) {
            return $value;
        }
        if (app()->getLocale() === 'en' && $this->title_en) {
            return $this->title_en;
        }
        return $value;
    }

    public function getContentAttribute($value)
    {
        if (request()->is('admin/*') || request()->is('superadmin/*')) {
            return $value;
        }
        if (app()->getLocale() === 'en' && $this->content_en) {
            return $this->content_en;
        }
        return $value;
    }

    public function getExcerptAttribute($value)
    {
        if (request()->is('admin/*') || request()->is('superadmin/*')) {
            return $value;
        }
        if (app()->getLocale() === 'en' && $this->excerpt_en) {
            return $this->excerpt_en;
        }
        return $value;
    }

    public function imageUrl(?string $fallback = null): ?string
    {
        if (!$this->image) {
            return $fallback;
        }

        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://') || str_starts_with($this->image, '//')) {
            return $this->image;
        }

        return asset($this->image);
    }
}
