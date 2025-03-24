<?php

namespace database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['id' => 1, 'name' => 'Admin', 'email' => 'practicas.it@delem.es', 'password'=> Hash::make('1112j1112')],
            ['id' => 2, 'name' => 'Bob', 'email' => 'bob@example.com'],
            ['id' => 3, 'name' => 'Charlie', 'email' => 'charlie@example.com'],
            ['id' => 4, 'name' => 'Diana', 'email' => 'diana@example.com'],
            ['id' => 5, 'name' => 'Eve', 'email' => 'eve@example.com'],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['id' => $user['id']],
                [
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'password' => Hash::make('password'),
                ]
            );
        }
    }
}
