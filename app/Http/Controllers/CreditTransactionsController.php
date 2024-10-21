<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CreditTransaction;

class CreditTransactionsController extends Controller
{
    public function transactionsIndex(Request $request)
{
    $perPage = $request->input('per_page', 10);
    $search = $request->input('search');

    // Consulta base para las transacciones
    $query = CreditTransaction::with('user');

    // Filtro de búsqueda por usuario o cantidad
    if ($search) {
        $query->whereHas('user', function ($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
        })->orWhere('amount', 'like', '%' . $search . '%');
    }

    // Ordenar por la columna 'created_at' en orden descendente
    $transactions = $query->orderBy('created_at', 'desc')->paginate($perPage);

    return view('admin.transactions.index', compact('transactions'));
}

}
