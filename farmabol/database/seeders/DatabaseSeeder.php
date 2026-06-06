<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Usuario Administrador
        User::create([
            'name' => 'Admin Farmabol',
            'email' => 'admin@farmabol.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Usuario Vendedor
        User::create([
            'name' => 'Vendedor Juan',
            'email' => 'juan@farmabol.com',
            'password' => Hash::make('password'),
            'role' => 'vendedor',
        ]);

        // Un par de productos de muestra
        Product::create([
            'codigo' => 'PARAC500',
            'nombre' => 'Paracetamol 500mg',
            'precio' => 2.50,
            'stock' => 20,
            'laboratorio' => 'Bago'
        ]);

        Product::create([
            'codigo' => 'IBU400',
            'nombre' => 'Ibuprofeno 400mg',
            'precio' => 4.00,
            'stock' => 3, // Saldrá en stock bajo
            'laboratorio' => 'Siles'
        ]);
    }
}