@extends('layouts.admin')

@section('title', 'Gestión de Productos')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Listado de Productos</h1>

    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus me-2"></i> Crear Nuevo Producto
    </a>

    <div class="card shadow">
        <div class="card-body">
            @if($products->count() > 0)
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                            <th>Tipo de Producto</th>
                            <th>Fecha de creación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->nombre }}</td>
                                <td>{{ $product->descripcion }}</td>
                                <td>${{ number_format($product->precio, 2) }}</td>
                                <td>{{ $product->type?->nombre ?? 'Sin tipo' }}</td>
                                <td>{{ $product->created_at->format('d/m/Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center text-muted mb-0">No hay productos registrados aún.</p>
            @endif
        </div>
    </div>
</div>
@endsection
