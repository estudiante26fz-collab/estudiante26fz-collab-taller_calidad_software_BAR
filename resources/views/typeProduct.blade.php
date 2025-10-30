@extends('layouts.admin') 

@section('title', 'Gestión de Categorías')

@section('content')
    <h1 class="mb-4">Listado de Categorías</h1>
    
    <a href="{{ route('product-types.create') }}" class="btn btn-success mb-3">
        <i class="fas fa-plus me-1"></i> Crear Nueva Categoría
    </a>
    
    <div class="card p-4 shadow-sm">
        <h2>Tabla de Categorías</h2>
        <p>Aquí se mostrará la lista de categorías con las opciones de editar y eliminar.</p>

        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre de la Categoría</th>
                    <th>Productos asociados</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Electrónica</td>
                    <td>15</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-info">Editar</a>
                        <button class="btn btn-sm btn-danger">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection