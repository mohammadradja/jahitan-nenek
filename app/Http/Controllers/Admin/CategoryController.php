<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::withCount('products')->latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        Category::create($this->validatedCategoryData($request));

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dibuat!');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $category->update($this->validatedCategoryData($request, $category));

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus!');
    }

    private function validatedCategoryData(Request $request, ?Category $category = null): array
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'name')->ignore($category),
            ],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'slug')->ignore($category),
            ],
            'image_file' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,gif,avif', 'max:5120'],
            'description' => ['nullable', 'string'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
        ]);

        $validated['image_url'] = $this->storeImage($request, $category?->image_url);
        unset($validated['image_file']);

        return $validated;
    }

    private function storeImage(Request $request, ?string $currentImage = null): ?string
    {
        if (!$request->hasFile('image_file')) {
            return $currentImage;
        }

        File::ensureDirectoryExists(public_path('assets/images/categories'));

        $file = $request->file('image_file');
        $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $filename = ($filename ?: 'category') . '-' . time() . '.' . $file->getClientOriginalExtension();

        $file->move(public_path('assets/images/categories'), $filename);

        return 'assets/images/categories/' . $filename;
    }
}
