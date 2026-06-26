<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // ADD TO CART (with stock check)
    public function add($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            if ($cart[$id] < $product->stock) {
                $cart[$id]++;
            }
        } else {
            $cart[$id] = 1;
        }

        session()->put('cart', $cart);

        return redirect('/products')->with('success', 'Added to cart!');
    }

    // VIEW CART
    public function index()
    {
        $cart = session()->get('cart', []);
        $products = Product::whereIn('id', array_keys($cart))->get();

        return view('cart.index', compact('cart', 'products'));
    }

    // INCREASE QUANTITY
    public function increase($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id]) && $cart[$id] < $product->stock) {
            $cart[$id]++;
        }

        session()->put('cart', $cart);
        return redirect('/cart');
    }

    // DECREASE QUANTITY
    public function decrease($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]--;

            if ($cart[$id] <= 0) {
                unset($cart[$id]);
            }
        }

        session()->put('cart', $cart);
        return redirect('/cart');
    }

    // REMOVE ITEM
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        unset($cart[$id]);

        session()->put('cart', $cart);
        return redirect('/cart');
    }
}