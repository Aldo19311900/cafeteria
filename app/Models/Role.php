<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'description',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
