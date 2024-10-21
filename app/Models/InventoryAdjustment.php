<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryAdjustment extends Model
{
    use HasFactory;
    protected $table = 'inventory_adjustments';
    // Campos permitidos para la asignación masiva
    protected $fillable = [
        'product_id',
        'previous_stock',
        'new_stock',
        'admin_id',
    ];

    // Relación con el modelo Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Relación con el modelo User (administrador)
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
