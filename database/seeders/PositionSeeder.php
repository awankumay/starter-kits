<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Position;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = [
            ['name' => 'Supervisor', 'description' => 'Mengawasi dan mengelola tim'],
            ['name' => 'Staff', 'description' => 'Staf administrasi atau pendukung'],
            ['name' => 'HRD', 'description' => 'Mengelola sumber daya manusia'],
            ['name' => 'Operator', 'description' => 'Mengoperasikan mesin atau alat'],
            ['name' => 'Driver', 'description' => 'Pengemudi kendaraan'],
            ['name' => 'Crew', 'description' => 'Buruh kasar, pekerja fisik umum'],
            ['name' => 'Helper', 'description' => 'Bantuan untuk pekerjaan tertentu'],
        ];

        foreach ($positions as $position) {
            Position::firstOrCreate(['name' => $position['name']], $position);
        }
    }
}
