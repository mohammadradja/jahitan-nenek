<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->has('search')) {
            $products = Product::search($request->search)->paginate(9);
        } else {
            if ($request->has('category')) {
                $query->whereHas('category', function($q) use ($request) {
                    $q->where('slug', $request->category);
                });
            }
            $products = $query->paginate(9);
        }

        return view('home', compact('products'));
    }
}
