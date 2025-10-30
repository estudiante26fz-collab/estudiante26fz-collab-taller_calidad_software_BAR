<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('type')->get();
        $types = ProductType::all();
        return view('product', compact('products', 'types'));
    }

    public function create()
    {
        $products = Product::with('type')->get();
        $types = ProductType::all();
        $showCreateForm = true;
        
        return view('product', compact('products', 'types', 'showCreateForm'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'product_type_id' => 'required|exists:product_types,id',
        ]);

        Product::create($request->all());
        return redirect()->route('products.index')->with('success', 'Producto creado correctamente.');
    }

    public function edit($id)
    {
        $productToEdit = Product::findOrFail($id);
        $products = Product::with('type')->get();
        $types = ProductType::all();
        
        return view('product', compact('products', 'productToEdit', 'types'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'product_type_id' => 'required|exists:product_types,id',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Producto eliminado correctamente.');
    }
}