<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    // Gets the current cart row or creates one.
    private function getCartId()
    {
        $sessionId = session()->getId();

        $cart = DB::selectOne(
            'SELECT id FROM carts WHERE session_id = ?',
            [$sessionId]
        );

        if ($cart) {
            return $cart->id;
        }

        $newCart = DB::selectOne(
            'INSERT INTO carts (session_id, created_at, updated_at)
             VALUES (?, NOW(), NOW())
             RETURNING id',
            [$sessionId]
        );

        return $newCart->id;
    }

    public function add($id)
    {
        $cartId = $this->getCartId();

        DB::insert(
            'INSERT INTO cart_items (cart_id, product_id, quantity, created_at, updated_at)
             VALUES (?, ?, 1, NOW(), NOW())
             ON CONFLICT (cart_id, product_id)
             DO UPDATE SET quantity = cart_items.quantity + 1, updated_at = NOW()',
            [$cartId, $id]
        );

        return redirect('/products')->with('success', 'Added to cart!');
    }

    public function index()
    {
        $cartId = $this->getCartId();

        $items = DB::select(
            'SELECT cart_items.product_id, cart_items.quantity,
                    products.name, products.price, products.image, products.stock,
                    cart_items.quantity * products.price AS subtotal
             FROM cart_items
             JOIN products ON cart_items.product_id = products.id
             WHERE cart_items.cart_id = ?
             ORDER BY cart_items.id',
            [$cartId]
        );

        return view('cart.index', compact('items'));
    }

    public function increase($id)
    {
        $cartId = $this->getCartId();

        DB::update(
            'UPDATE cart_items
             SET quantity = quantity + 1, updated_at = NOW()
             WHERE cart_id = ? AND product_id = ?',
            [$cartId, $id]
        );

        return redirect('/cart');
    }

    public function decrease($id)
    {
        $cartId = $this->getCartId();

        DB::update(
            'UPDATE cart_items
             SET quantity = quantity - 1, updated_at = NOW()
             WHERE cart_id = ? AND product_id = ?',
            [$cartId, $id]
        );

        DB::delete(
            'DELETE FROM cart_items
             WHERE cart_id = ? AND product_id = ? AND quantity <= 0',
            [$cartId, $id]
        );

        return redirect('/cart');
    }

    public function remove($id)
    {
        $cartId = $this->getCartId();

        DB::delete(
            'DELETE FROM cart_items
             WHERE cart_id = ? AND product_id = ?',
            [$cartId, $id]
        );

        return redirect('/cart');
    }
}