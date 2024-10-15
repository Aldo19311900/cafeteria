<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Credit;

class UserController extends Controller
{
    public function index(Request $request)
{
    // Obtener el valor de la cantidad de usuarios a mostrar por página, por defecto 10
    $perPage = $request->input('per_page', 10);
    
    // Cargar los usuarios junto con su crédito y aplicar paginación
    $users = User::with('credit')->paginate($perPage);
    
    return view('admin.users.index', compact('users'));
}

    
}
