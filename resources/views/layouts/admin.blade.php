<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* SOLO ESTO AGREGAMOS AL CSS EXISTENTE */
        .form-control, .btn, select, textarea {
            position: relative;
            z-index: 1000 !important;
        }
        
        .card {
            position: relative;
            z-index: 1;
        }
    </style>
</head>
<body>

    {{-- Barra superior fija --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm fixed-top">
        <div class="container-fluid">
            <div class="navbar-brand mb-0 h1">
                Panel de Administración
            </div>
            <div class="d-flex align-items-center">
                @auth
                    <span class="navbar-text me-3">Bienvenido, {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    <div class="d-flex">
        {{-- SIDEBAR --}}
        <div id="sidebar" class="p-0">
            <h5 class="sidebar-header">Menú de Administración</h5>
            <ul class="list-group list-group-flush">

                {{-- Enlace a Productos --}}
                <li class="list-group-item @if(request()->routeIs('products.*')) active @endif">
                    <a href="{{ route('products.index') }}">
                        <i class="fas fa-boxes fa-fw me-2"></i> Productos
                    </a>
                </li>

                {{-- Enlace a Categorías --}}
                <li class="list-group-item @if(request()->routeIs('product-types.*')) active @endif">
                    <a href="{{ route('product-types.index') }}">
                        <i class="fas fa-tags fa-fw me-2"></i> Categorías
                    </a>
                </li>
            </ul>
        </div>

        {{-- CONTENIDO PRINCIPAL --}}
        <div class="d-flex flex-column flex-grow-1">
            <div id="main-content" class="flex-grow-1 p-4">
                @yield('content')
            </div>
        </div>
    </div>

    <script 
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ENjdO4Dr2bkBIFxQpeo5s84Knbv9rFQrs9awq20Uu3lzjwW5K5p6x5WF5QXF7CM" 
    crossorigin="anonymous">
</script>
</body>
</html>