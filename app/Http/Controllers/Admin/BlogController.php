<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = \App\Models\Blog::with('author')->latest()->paginate(10);
        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:blogs,slug',
            'content' => 'required',
            'image_url' => 'nullable|url'
        ]);

        \App\Models\Blog::create([
            'author_id' => auth()->id(),
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'image' => $request->image_url,
            'published_at' => $request->is_published ? now() : null,
        ]);

        return redirect()->back()->with('success', 'Artikel berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $blog = \App\Models\Blog::findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:blogs,slug,' . $id,
            'content' => 'required',
            'image_url' => 'nullable|url'
        ]);

        $blog->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'image' => $request->image_url,
            'published_at' => $request->is_published ? ($blog->published_at ?? now()) : null,
        ]);

        return redirect()->back()->with('success', 'Artikel berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = \App\Models\Blog::findOrFail($id);
        $blog->delete();

        return redirect()->back()->with('success', 'Artikel berhasil dihapus!');
    }
}
