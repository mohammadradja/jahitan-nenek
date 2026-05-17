<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('author')->whereNotNull('published_at')->latest()->paginate(9);
        return view('blog.index', compact('blogs'));
    }

    public function show($slug)
    {
        $blog = Blog::with('author')->where('slug', $slug)->firstOrFail();
        $blog->increment('views');
        
        $otherBlogs = Blog::where('id', '!=', $blog->id)
            ->whereNotNull('published_at')
            ->latest()
            ->take(5)
            ->get();
            
        return view('blog.show', compact('blog', 'otherBlogs'));
    }
}
