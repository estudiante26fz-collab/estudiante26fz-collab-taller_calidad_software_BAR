<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Trae productos con su tipo (join)
        $products = Product::with('type')->get();

        return view('product', compact('products'));
    }
}
