<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = Wishlist::where('user_id', Auth::id())->with('product')->latest()->paginate(12);
        return view('dashboards.user.wishlist', compact('wishlist'));
    }

    public function toggle(Product $product)
    {
        $user = Auth::user();
        $wishlist = Wishlist::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        if ($wishlist) {
            $wishlist->delete();
            $status = 'removed';
            $message = 'Produk dihapus dari wishlist.';
        } else {
            Wishlist::create([
                'user_id' => $user->id,
                'product_id' => $product->id
            ]);
            $status = 'added';
            $message = 'Produk ditambahkan ke wishlist.';
        }

        if (request()->wantsJson()) {
            return response()->json([
                'status' => $status,
                'message' => $message,
                'in_wishlist' => $status === 'added'
            ]);
        }

        return redirect()->back()->with('success', $message);
    }
}
