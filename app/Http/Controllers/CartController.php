<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);
        
        $measurements = null;
        if ($product->is_customizable) {
            $measurements = $request->only(['chest', 'waist', 'hip', 'shoulder', 'sleeve_length', 'body_length', 'notes']);
        }

        // To support multiple customizations, we create a unique key
        $cartKey = $product->id;
        if ($measurements) {
            $cartKey .= '-' . md5(json_encode($measurements));
        }

        if(isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity']++;
        } else {
            $cart[$cartKey] = [
                "product_id" => $product->id,
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image_url,
                "category" => $product->category->name,
                "measurements" => $measurements
            ];
        }

        session()->put('cart', $cart);
        
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Produk ditambahkan ke keranjang!', 'cart_count' => count($cart)]);
        }

        return redirect()->back()->with('success', 'Produk ditambahkan ke keranjang!');
    }

    public function buyNow(Request $request, Product $product)
    {
        $this->add($request, $product);
        return redirect()->route('checkout.index');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Produk dihapus dari keranjang.');
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        if(isset($cart[$id]) && $request->quantity > 0) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Keranjang diperbarui.');
    }
}
