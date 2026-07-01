<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class OrderController extends Controller
{
    private function getCartId()
    {
        $sessionId = session()->getId();

        $cart = DB::selectOne(
            'SELECT id FROM carts WHERE session_id = ?',
            [$sessionId]
        );

        return $cart ? $cart->id : null;
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'shipping_name' => 'required',
            'shipping_address' => 'required',
            'shipping_city' => 'required',
            'shipping_state' => 'required',
            'shipping_zip' => 'required',
        ]);

        $cartId = $this->getCartId();

        if (!$cartId) {
            return redirect('/products')->with('success', 'Cart is empty!');
        }

        $items = DB::select(
            'SELECT cart_items.product_id, cart_items.quantity,
                    products.price, products.stock, products.name
             FROM cart_items
             JOIN products ON cart_items.product_id = products.id
             WHERE cart_items.cart_id = ?',
            [$cartId]
        );

        if (empty($items)) {
            return redirect('/products')->with('success', 'Cart is empty!');
        }

        $total = 0;

        foreach ($items as $item) {
            $total += $item->price * $item->quantity;
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        $paymentIntent = PaymentIntent::create([
            'amount' => (int) ($total * 100),
            'currency' => 'usd',
            'description' => 'Game Store Order',
        ]);

        DB::transaction(function () use ($items, $total, $paymentIntent, $cartId, $request) {
            foreach ($items as $item) {
                DB::update(
                    'UPDATE products
                     SET stock = GREATEST(stock - ?, 0), updated_at = NOW()
                     WHERE id = ?',
                    [$item->quantity, $item->product_id]
                );
            }

            DB::insert(
                'INSERT INTO orders
                (total_price, order_date, stripe_payment_id,
                 shipping_name, shipping_address, shipping_city, shipping_state, shipping_zip,
                 created_at, updated_at)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())',
                [
                    $total,
                    now(),
                    $paymentIntent->id,
                    $request->shipping_name,
                    $request->shipping_address,
                    $request->shipping_city,
                    $request->shipping_state,
                    $request->shipping_zip,
                ]
            );

            DB::delete(
                'DELETE FROM cart_items WHERE cart_id = ?',
                [$cartId]
            );
        });

        return redirect('/orders')->with('success', 'Order placed successfully!');
    }

    public function index()
    {
        $orders = DB::select(
            'SELECT * FROM orders ORDER BY order_date DESC'
        );

        return view('orders.index', compact('orders'));
    }
}