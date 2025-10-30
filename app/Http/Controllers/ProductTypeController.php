<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    public function index()
    {
        $types = ProductType::all();
        return view('typeProduct', compact('types'));
    }

    public function create()
    {
        $types = ProductType::all();
        $showCreateForm = true;
        return view('typeProduct', compact('types', 'showCreateForm'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:product_types,name',
        ]);

        ProductType::create($request->all());

        return redirect()->route('product-types.index')
            ->with('success', 'Categoría creada correctamente.');
    }

    public function edit($id)
    {
        $typeToEdit = ProductType::findOrFail($id);
        $types = ProductType::all();
        return view('typeProduct', compact('types', 'typeToEdit'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:product_types,name,' . $id,
        ]);

        $type = ProductType::findOrFail($id);
        $type->update($request->all());

        return redirect()->route('product-types.index')
            ->with('success', 'Categoría actualizada correctamente.');
    }

    public function destroy($id)
    {
        $type = ProductType::findOrFail($id);
        
        if ($type->products()->count() > 0) {
            return redirect()->route('product-types.index')
                ->with('error', 'No se puede eliminar la categoría porque tiene productos asociados.');
        }

        $type->delete();

        return redirect()->route('product-types.index')
            ->with('success', 'Categoría eliminada correctamente.');
    }
}