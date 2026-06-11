<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

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
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'slug' => 'required|string|unique:blogs,slug',
            'content' => 'required',
            'content_en' => 'required',
            'image_file' => 'nullable|file|mimes:jpg,jpeg,png,webp,gif,avif|max:5120',
            'status' => 'required|in:published,draft'
        ]);

        \App\Models\Blog::create([
            'author_id' => auth()->id(),
            'title' => $validated['title'],
            'title_en' => $validated['title_en'],
            'slug' => $validated['slug'],
            'content' => $validated['content'],
            'content_en' => $validated['content_en'],
            'image' => $this->storeImage($request),
            'status' => $validated['status'],
            'published_at' => $validated['status'] === 'published' ? now() : null,
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
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'slug' => 'required|string|unique:blogs,slug,' . $id,
            'content' => 'required',
            'content_en' => 'required',
            'image_file' => 'nullable|file|mimes:jpg,jpeg,png,webp,gif,avif|max:5120',
            'status' => 'required|in:published,draft'
        ]);

        $blog->update([
            'title' => $validated['title'],
            'title_en' => $validated['title_en'],
            'slug' => $validated['slug'],
            'content' => $validated['content'],
            'content_en' => $validated['content_en'],
            'image' => $this->storeImage($request, $blog->image),
            'status' => $validated['status'],
            'published_at' => $validated['status'] === 'published' ? ($blog->published_at ?? now()) : null,
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

    private function storeImage(Request $request, ?string $currentImage = null): ?string
    {
        if (!$request->hasFile('image_file')) {
            return $currentImage;
        }

        File::ensureDirectoryExists(public_path('assets/images/blogs'));

        $file = $request->file('image_file');
        $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $filename = ($filename ?: 'blog') . '-' . time() . '.' . $file->getClientOriginalExtension();

        $file->move(public_path('assets/images/blogs'), $filename);

        return 'assets/images/blogs/' . $filename;
    }
}
