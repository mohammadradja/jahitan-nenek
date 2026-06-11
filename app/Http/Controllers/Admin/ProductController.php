<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = \App\Models\Product::with('category');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('slug', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->latest()->paginate(10);
        $categories = \App\Models\Category::all();
        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products',
            'price' => 'required|integer|min:0',
            'price_min' => 'nullable|integer|min:0',
            'price_max' => 'nullable|integer|min:0|gte:price_min',
            'stock' => 'required|integer|min:0',
            'image_file' => 'required|file|mimes:jpg,jpeg,png,webp,gif,avif|max:5120',
            'description' => 'nullable|string',
        ]);

        $validated['price_min'] = $validated['price_min'] ?? $validated['price'];
        $validated['price_max'] = $validated['price_max'] ?? $validated['price'];
        $validated['image_url'] = $this->resolveImageUrl($request, null);
        unset($validated['image_file']);
        
        Product::create($validated);
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        $categories = \App\Models\Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,'.$product->id,
            'price' => 'required|integer|min:0',
            'price_min' => 'nullable|integer|min:0',
            'price_max' => 'nullable|integer|min:0|gte:price_min',
            'stock' => 'required|integer|min:0',
            'image_file' => 'nullable|file|mimes:jpg,jpeg,png,webp,gif,avif|max:5120',
            'description' => 'nullable|string',
        ]);

        $validated['price_min'] = $validated['price_min'] ?? $validated['price'];
        $validated['price_max'] = $validated['price_max'] ?? $validated['price'];
        $validated['image_url'] = $this->resolveImageUrl($request, $product->image_url);
        unset($validated['image_file']);
        
        $product->update($validated);
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus!');
    }

    private function resolveImageUrl(Request $request, ?string $currentUrl): ?string
    {
        if (!$request->hasFile('image_file')) {
            return $currentUrl;
        }

        File::ensureDirectoryExists(public_path('assets/images/products'));

        $file = $request->file('image_file');
        $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $filename = ($filename ?: 'product') . '-' . time() . '.' . $file->getClientOriginalExtension();

        $file->move(public_path('assets/images/products'), $filename);

        return 'assets/images/products/' . $filename;
    }
}
