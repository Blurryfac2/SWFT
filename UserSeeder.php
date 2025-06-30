<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Usuario Test
        User::create([
            'name' => 'Usuario Test',
            'email' => 'test@pirotecnia.com',
            'password' => Hash::make('password123'),
            'rol' => 'test',
        ]);

        // Administrador Base
        User::create([
            'name' => 'Admin Base',
            'email' => 'admin@pirotecnia.com',
            'password' => Hash::make('admin123'),
            'rol' => 'admin_base',
        ]);

        // Administrador Full
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@pirotecnia.com',
            'password' => Hash::make('superadmin123'),
            'rol' => 'admin_full',
        ]);

        // Usuarios adicionales para pruebas
        User::create([
            'name' => 'Tester Juan',
            'email' => 'juan.test@pirotecnia.com',
            'password' => Hash::make('test123'),
            'rol' => 'test',
        ]);

        User::create([
            'name' => 'Admin María',
            'email' => 'maria.admin@pirotecnia.com',
            'password' => Hash::make('admin123'),
            'rol' => 'admin_base',
        ]);
    }
}
