<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image',
        'product_type_id'
    ];

    /**
     * Relación con las órdenes.
     * Un producto puede pertenecer a muchas órdenes.
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity', 'price');
    }

    /**
     * Relación con los ajustes de inventario.
     * Un producto puede tener muchos ajustes de inventario.
     */
    public function inventoryAdjustments()
    {
        return $this->hasMany(InventoryAdjustment::class);
    }

    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }
    public function adjustments()
{
    return $this->hasMany(InventoryAdjustment::class, 'product_id');
}

    
}
