<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Sort by sales_count if requested or default
        if ($request->sort === 'popular') {
            $query->orderBy('sales_count', 'desc');
        } else {
            $query->latest();
        }

        $products = $query->paginate(9)->withQueryString();

        return view('home', compact('products'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->with('category')->firstOrFail();
        $related = Product::where('category_id', $product->category_id)
                          ->where('id', '!=', $product->id)
                          ->take(4)
                          ->get();
        return view('product.show', compact('product', 'related'));
    }
}
