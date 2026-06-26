<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // ===============
    // CUSTOMER VIEW
    // ===============
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    // ===========
    // ADMIN CRUD
    // ===========

    // SHOW ALL PRODUCTS (ADMIN)
    public function adminIndex()
    {
        $products = Product::all();
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
        Product::create($request->all());

        return redirect('/admin/products')->with('success', 'Product added!');
    }

    // SHOW EDIT FORM
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    // UPDATE PRODUCT
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());

        return redirect('/admin/products')->with('success', 'Product updated!');
    }

    // DELETE PRODUCT
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect('/admin/products')->with('success', 'Product deleted!');
    }
}