<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect('/products')->with('success', 'Cart is empty!');
        }

        $total = 0;

        foreach ($cart as $productId => $quantity) {

            // Get product from database
            $product = Product::find($productId);

            if ($product) {

                // Calculate total
                $total += $product->price * $quantity;

                // Update stock
                $product->stock -= $quantity;

                // Prevent negative stock
                if ($product->stock < 0) {
                    $product->stock = 0;
                }

                $product->save();
            }
        }

        // Save order
        Order::create([
            'total_price' => $total,
            'order_date' => now()
        ]);

        // Clear cart
        session()->forget('cart');

        return redirect('/orders')->with('success', 'Order placed successfully!');
    }

    public function index()
    {
        $orders = Order::latest()->get();
        return view('orders.index', compact('orders'));
    }
}