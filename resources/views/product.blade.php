@extends('layouts.admin')

@section('title', 'Gestión de Productos')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Listado de Productos</h1>

    {{-- Mostrar mensajes de éxito --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    {{-- Mostrar formulario de CREACIÓN --}}
    @if(isset($showCreateForm) && $showCreateForm)
    <div class="card mb-4 shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-plus me-2"></i>Crear Nuevo Producto</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="create_nombre" class="form-label">Nombre *</label>
                        <input type="text" name="nombre" id="create_nombre" class="form-control" 
                               value="{{ old('nombre') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="create_precio" class="form-label">Precio *</label>
                        <input type="number" name="precio" id="create_precio" class="form-control" 
                               value="{{ old('precio') }}" step="0.01" min="0" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="create_descripcion" class="form-label">Descripción</label>
                        <textarea name="descripcion" id="create_descripcion" class="form-control" rows="3">{{ old('descripcion') }}</textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="create_product_type_id" class="form-label">Tipo de Producto</label>
                        <select name="product_type_id" id="create_product_type_id" class="form-control">
                            <option value="">Seleccionar tipo</option>
                            @foreach($types as $type)
                                <option value="{{ $type->id }}" {{ old('product_type_id') == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-1"></i> Crear Producto
                    </button>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
    @endif

    {{-- Mostrar formulario de EDICIÓN --}}
    @if(isset($productToEdit))
    <div class="card mb-4 shadow">
        <div class="card-header bg-warning text-white">
            <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Editando Producto: {{ $productToEdit->nombre }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('products.update', $productToEdit->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="edit_nombre" class="form-label">Nombre *</label>
                        <input type="text" name="nombre" id="edit_nombre" class="form-control" 
                               value="{{ old('nombre', $productToEdit->nombre) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="edit_precio" class="form-label">Precio *</label>
                        <input type="number" name="precio" id="edit_precio" class="form-control" 
                               value="{{ old('precio', $productToEdit->precio) }}" step="0.01" min="0" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="edit_descripcion" class="form-label">Descripción</label>
                        <textarea name="descripcion" id="edit_descripcion" class="form-control" rows="3">{{ old('descripcion', $productToEdit->descripcion) }}</textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="edit_product_type_id" class="form-label">Tipo de Producto</label>
                        <select name="product_type_id" id="edit_product_type_id" class="form-control">
                            <option value="">Seleccionar tipo</option>
                            @foreach($types as $type)
                                <option value="{{ $type->id }}" 
                                    {{ $productToEdit->product_type_id == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-1"></i> Guardar Cambios
                    </button>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
    @endif

    {{-- BOTÓN DE CREACIÓN --}}
    @if(!isset($showCreateForm) && !isset($productToEdit))
    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus me-2"></i> Crear Nuevo Producto
    </a>
    @endif

    {{-- TABLA DE PRODUCTOS --}}
    <div class="card shadow">
        <div class="card-body">
            @if($products->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Precio</th>
                                <th>Tipo de Producto</th>
                                <th>Fecha de creación</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->nombre }}</td>
                                    <td>{{ Str::limit($product->descripcion, 50) }}</td>
                                    <td>${{ number_format($product->precio, 2) }}</td>
                                    <td>{{ $product->type?->name ?? 'Sin tipo' }}</td>
                                    <td>{{ $product->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        {{-- Enlace para editar --}}
                                        <a href="{{ route('products.edit', $product->id) }}" 
                                           class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>

                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('¿Estás seguro de eliminar este producto?')">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-center text-muted mb-0">No hay productos registrados aún.</p>
            @endif
        </div>
    </div>
</div>
@endsection