<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventoryAdjustment;

class InventoryAjustmentController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
    
        $query = InventoryAdjustment::with(['product', 'admin']);
    
        if ($search) {
            $query->whereHas('product', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            })->orWhereHas('admin', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }
    
        $adjustments = $query->orderBy('created_at', 'desc')->paginate($perPage);
    
        return view('admin.inventory.index', compact('adjustments'));
    }
    
    
}
