<?php

namespace App\Http\Controllers;

// Models
use App\Models\Product;

use Illuminate\Http\Request;

class productController extends Controller
{
    public function index() {
        $products = Product::get();
        return view('products.products', compact('products'));
    }

    public function create() {
        return view('products.create');
    }

    public function post(Request $request) {
        $product = new Product;
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->save();

        return redirect()->route('products');
    }

    public function edit(Request $request) {
        $product = Product::findOrFail($request->input('id'));
        return view('products.edit', compact('product'));
    }

    public function update(Request $request) {
        $product = Product::findOrFail($request->input('id'));
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->update();
        return redirect()->route('products');
    }

    public function destroy(Request $request) {
        Product::findOrFail($request->input('id'))->delete();
        return redirect()->route('products');
    }
}
