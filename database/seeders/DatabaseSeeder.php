<?php

namespace Database\Seeders;

// use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Jalankan PermissionSeeder untuk membuat roles dan permissions
        $this->call([
            PermissionSeeder::class,
            RoleAndUserSeeder::class,
            RoleAndPermissionSeeder::class,
            TypesUnitsSeeder::class,
            UnitsSeeder::class,
        ]);

    }
}
