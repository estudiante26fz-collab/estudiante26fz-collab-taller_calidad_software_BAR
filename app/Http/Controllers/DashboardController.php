<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Muestra la vista principal del panel de administración (ahora llamada 'admin').
     */
    public function index()
    {
        // ¡CORRECCIÓN SOLICITADA! Apuntamos a la vista 'admin'
        // Esta vista DEBE llamarse resources/views/admin.blade.php
        return view('layouts.admin');
    }
}