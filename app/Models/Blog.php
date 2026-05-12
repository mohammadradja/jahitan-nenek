<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Blog extends Model
{
    use Searchable;
    protected $fillable = [
        'author_id', 'title', 'slug', 'content', 'image', 'published_at',
        'meta_title', 'meta_description', 'meta_keywords', 'views'
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
