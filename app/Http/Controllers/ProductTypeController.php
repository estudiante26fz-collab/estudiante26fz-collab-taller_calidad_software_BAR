<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    /**
     * Muestra una lista de los recursos (tipos de producto/categorías).
     */
    public function index()
    {
        // NOTA: Aquí iría la lógica para obtener todos los tipos de producto
        // $productTypes = ProductType::all();
        
        // Carga la vista product-types.blade.php (asumiendo que está en /resources/views)
        return view('typeProduct'); 
    }

    /**
     * Muestra el formulario para crear un nuevo recurso.
     */
    public function create()
    {
        // return view('product-types-create'); // Vista para el formulario de creación
    }

    /**
     * Almacena un recurso recién creado en la base de datos.
     */
    public function store(Request $request)
    {
        // Lógica para guardar el tipo de producto...
    }

    /**
     * Muestra el recurso especificado.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Muestra el formulario para editar el recurso especificado.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Actualiza el recurso especificado en el almacenamiento.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Elimina el recurso especificado del almacenamiento.
     */
    public function destroy(string $id)
    {
        //
    }
}