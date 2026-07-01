<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class ProductController extends Controller
{
    // ===============
    // CUSTOMER VIEW
    // ===============
    public function index()
    {
        $products = DB::select('SELECT * FROM products ORDER BY id');

        return view('products.index', compact('products'));
    }

    // ===========
    // ADMIN CRUD
    // ===========

    // SHOW ALL PRODUCTS (ADMIN)
    public function adminIndex()
    {
        $products = DB::select('SELECT * FROM products ORDER BY id');

        return view('admin.products.index', compact('products'));
    }

    // SHOW CREATE FORM
    public function create()
    {
        return view('admin.products.create');
    }

    // STORE PRODUCT
    public function store(Request $request)
    {
        DB::insert(
            'INSERT INTO products (sku, name, description, price, image, stock, created_at, updated_at)
             VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())',
            [
                $request->sku,
                $request->name,
                $request->description,
                $request->price,
                $request->image,
                $request->stock
            ]
        );

        return redirect('/admin/products')->with('success', 'Product added!');
    }

    // SHOW EDIT FORM
    public function edit($id)
    {
        $product = DB::selectOne(
            'SELECT * FROM products WHERE id = ?',
            [$id]
        );

        if (!$product) {
            abort(404);
        }

        return view('admin.products.edit', compact('product'));
    }

    // UPDATE PRODUCT
    public function update(Request $request, $id)
    {
        DB::update(
            'UPDATE products
             SET sku = ?, name = ?, description = ?, price = ?, image = ?, stock = ?, updated_at = NOW()
             WHERE id = ?',
            [
                $request->sku,
                $request->name,
                $request->description,
                $request->price,
                $request->image,
                $request->stock,
                $id
            ]
        );

        return redirect('/admin/products')->with('success', 'Product updated!');
    }

    // DELETE PRODUCT
    public function destroy($id)
    {
        DB::delete(
            'DELETE FROM products WHERE id = ?',
            [$id]
        );

        return redirect('/admin/products')->with('success', 'Product deleted!');
    }
}