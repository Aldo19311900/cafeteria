<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Buscar los roles
        $userRole = Role::where('name', 'user')->first();
        $adminrole = Role::where('name', 'admin')->first();

        // Crear usuario regular
        User::create([
            'name' => 'John Doe',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role_id' => $userRole->id, // Asignar rol de usuario
        ]);

        // Crear encargado de la cafetería
        User::create([
            'name' => 'Jane Smith',
            'email' => 'manager@example.com',
            'password' => Hash::make('password'),
            'role_id' => $adminrole->id, // Asignar rol de encargado de la cafetería
        ]);
    }
}
