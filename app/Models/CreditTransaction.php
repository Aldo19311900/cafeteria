<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditTransaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'amount',
    ];

    /**
     * Relación con el modelo User
     * Cada transacción de crédito pertenece a un usuario.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
