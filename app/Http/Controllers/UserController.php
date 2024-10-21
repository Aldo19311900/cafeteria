<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CreditTransaction;

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

    public function addCredit(Request $request, $userId)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
        ]);

        $user = User::findOrFail($userId);

        // Actualizar o crear el crédito del usuario
        $credit = $user->credit()->firstOrCreate(
            [], // Condición de búsqueda
            ['balance' => 0] // Valores a insertar si no existe
        );

        // Incrementar el balance del crédito existente
        $credit->balance += $request->amount;
        $credit->save();

        // Crear una nueva transacción de crédito
        CreditTransaction::create([
            'user_id' => $user->id,
            'amount' => $request->amount, // Cambiado de 'balance' a 'amount'
        ]);

        return redirect()->route('users')->with('success', 'Credit added successfully.');
    }
}
