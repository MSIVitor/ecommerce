<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addToCart(Request $request, $productId)
    {
        $cartItem = Cart::where('user_id', auth()->id())
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $productId,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->route('cart.index');
    }

    public function index()
    {
        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
        $total = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        return view('products.cart', compact('cartItems', 'total'));
    }
    public function removeFromCart($cartItemId)
    {
        $cartItem = Cart::findOrFail($cartItemId);

        if ($cartItem->user_id == auth()->id()) {
            $cartItem->delete();
        }

        return redirect()->route('cart.index');
    }

    public function update(Request $request, $cartItemId)
    {
        $cartItem = Cart::findOrFail($cartItemId);

        if ($cartItem->user_id == auth()->id()) {
            $cartItem->quantity = $request->quantity;
            $cartItem->save();
        }

        return redirect()->route('cart.index');
    }
}

