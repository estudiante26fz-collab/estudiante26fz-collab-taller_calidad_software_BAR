@extends('layouts.admin')

@section('title', 'Gestión de Categorías')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Listado de Categorías</h1>

    {{-- Mostrar mensajes --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    {{-- Formulario de CREACIÓN --}}
    @if(isset($showCreateForm) && $showCreateForm)
    <div class="card mb-4 shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-plus me-2"></i>Crear Nueva Categoría</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('product-types.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="create_name" class="form-label">Nombre de la Categoría *</label>
                        <input type="text" name="name" id="create_name" class="form-control" 
                               value="{{ old('name') }}" required placeholder="Ej: Bebidas, Snacks, etc.">
                        <small class="form-text text-muted">El nombre debe ser único.</small>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-1"></i> Crear Categoría
                    </button>
                    <a href="{{ route('product-types.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
    @endif

    {{-- Formulario de EDICIÓN --}}
    @if(isset($typeToEdit))
    <div class="card mb-4 shadow">
        <div class="card-header bg-warning text-white">
            <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Editando Categoría: {{ $typeToEdit->name }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('product-types.update', $typeToEdit->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="edit_name" class="form-label">Nombre de la Categoría *</label>
                        <input type="text" name="name" id="edit_name" class="form-control" 
                               value="{{ old('name', $typeToEdit->name) }}" required>
                        <small class="form-text text-muted">El nombre debe ser único.</small>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-1"></i> Guardar Cambios
                    </button>
                    <a href="{{ route('product-types.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
    @endif

    {{-- Botón Crear --}}
    @if(!isset($showCreateForm) && !isset($typeToEdit))
    <a href="{{ route('product-types.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus me-2"></i> Crear Nueva Categoría
    </a>
    @endif

    {{-- Tabla de Categorías --}}
    <div class="card shadow">
        <div class="card-body">
            @if($types->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nombre de la Categoría</th>
                                <th>Fecha de Creación</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($types as $type)
                                <tr>
                                    <td>{{ $type->id }}</td>
                                    <td>{{ $type->name }}</td>
                                    <td>
                                        @if($type->created_at)
                                            {{ $type->created_at->format('d/m/Y') }}
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{-- Botón Editar --}}
                                        <a href="{{ route('product-types.edit', $type->id) }}" 
                                           class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>

                                        {{-- Botón Eliminar --}}
                                        <form action="{{ route('product-types.destroy', $type->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('¿Estás seguro de eliminar esta categoría?')">
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
                <p class="text-center text-muted mb-0">No hay categorías registradas aún.</p>
            @endif
        </div>
    </div>
</div>
@endsection