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
}
