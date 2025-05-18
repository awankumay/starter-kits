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
            ['position' => 'Supervisor', 'description' => 'Mengawasi dan mengelola tim'],
            ['position' => 'Staff', 'description' => 'Staf administrasi atau pendukung'],
            ['position' => 'HRD', 'description' => 'Mengelola sumber daya manusia'],
            ['position' => 'Operator', 'description' => 'Mengoperasikan mesin atau alat'],
            ['position' => 'Driver', 'description' => 'Pengemudi kendaraan'],
            ['position' => 'Crew', 'description' => 'Buruh kasar, pekerja fisik umum'],
            ['position' => 'Helper', 'description' => 'Bantuan untuk pekerjaan tertentu'],
        ];

        foreach ($positions as $position) {
            Position::firstOrCreate(['position' => $position['position']], $position);
        }
    }
}
