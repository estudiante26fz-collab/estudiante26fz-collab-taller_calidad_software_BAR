<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTypeController; 
use Illuminate\Support\Facades\Route;

// ----------------------------------------------------------------------
// 1. AUTENTICACIÓN Y RUTAS PÚBLICAS
// ----------------------------------------------------------------------

Route::get('login', [LoginController::class,'showLogin'])->name('login'); 
Route::post('login', [LoginController::class,'login'])->name('login.perform');


// ----------------------------------------------------------------------
// 2. RUTAS PROTEGIDAS (Requieren 'auth')
// ----------------------------------------------------------------------

Route::middleware('auth')->group(function() {
    
    // Redirección de la raíz y Dashboard
    Route::get('/', function(){ return redirect()->route('dashboard'); });
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

    // Cerrar Sesión
    Route::post('logout', [LoginController::class,'logout'])->name('logout');

    Route::resource('products', ProductController::class);
        
        // Crea product-types.index, product-types.create, etc.
        Route::resource('product-types', ProductTypeController::class);

    


    // ------------------------------------------------------------------
    // 3. RUTAS DE GESTIÓN (Requieren 'auth' y rol 'admin')
    // ------------------------------------------------------------------
    Route::middleware('role:admin')->group(function(){
        
       
    });
});