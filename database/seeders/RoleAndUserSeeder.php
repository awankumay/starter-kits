<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RoleAndUserSeeder extends Seeder
{
    public function run()
    {
        // Data user dummy beserta role
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@example.com',
                'password' => Hash::make('password123'),
                'role' => 'administrator'
            ],
            [
                'name' => 'Supervisor User',
                'email' => 'supervisor@example.com',
                'password' => Hash::make('password123'),
                'role' => 'supervisor'
            ],
            [
                'name' => 'Finance User',
                'email' => 'finance@example.com',
                'password' => Hash::make('password123'),
                'role' => 'finance'
            ],
            [
                'name' => 'Admin User',
                'email' => 'adminuser@example.com',
                'password' => Hash::make('password123'),
                'role' => 'admin'
            ],
            [
                'name' => 'Regular User',
                'email' => 'regularuser@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user'
            ],
        ];

        foreach ($users as $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => $userData['password'],
                ]
            );
            $user->syncRoles([$userData['role']]);
        }
    }
}
