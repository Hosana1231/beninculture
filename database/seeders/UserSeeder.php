<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@culture.com',
            'password' => Hash::make('admin123'),
            'region' => 'Littoral',
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Contributeur 1',
            'email' => 'contrib1@culture.com',
            'password' => Hash::make('password'),
            'region' => 'Atlantique',
            'role' => 'contributeur'
        ]);

        User::create([
            'name' => 'Contributeur 2',
            'email' => 'contrib2@culture.com',
            'password' => Hash::make('password'),
            'region' => 'Borgou',
            'role' => 'contributeur'
        ]);

        User::create([
            'name' => 'Utilisateur 2',
            'email' => 'user2@culture.com',
            'password' => Hash::make('password'),
            'region' => 'Zou',
            'role' => 'utilisateur'
        ]);
    }
}
