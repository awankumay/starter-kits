<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AttendanceType;

class AttendanceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['name' => 'Pulang Cepat', 'description' => 'Pulang sebelum jam kerja selesai'],
            ['name' => 'Masuk Terlambat', 'description' => 'Masuk sebelum jam kerja dimulai'],
            ['name' => 'Pulang Terlambat', 'description' => 'Pulang setelah jam kerja selesai'],
            ['name' => 'Cuti', 'description' => 'Cuti tanpa alasan yang jelas'],
            ['name' => 'Cuti (Dengan Surat)', 'description' => 'Cuti disertai surat keterangan'],
            ['name' => 'Cuti (Tanpa Surat)', 'description' => 'Cuti tanpa surat keterangan'],
            ['name' => 'Izin (Dengan Surat)', 'description' => 'Izin tidak masuk kerja disertai surat keterangan'],
            ['name' => 'Izin (Tanpa Surat)', 'description' => 'Izin tidak masuk kerja tanpa surat keterangan'],
            ['name' => 'Sakit (Dengan Surat Dokter)', 'description' => 'Sakit disertai surat keterangan dokter'],
            ['name' => 'Sakit (Tanpa Surat)', 'description' => 'Sakit tanpa surat keterangan dokter'],
            ['name' => 'Menikah', 'description' => 'Cuti karena menikah'],
            ['name' => 'Sunataan Anak', 'description' => 'Cuti karena anak disunat'],
            ['name' => 'Tidak Masuk', 'description' => 'Tidak masuk tanpa alasan yang jelas'],
        ];

        foreach ($types as $type) {
            AttendanceType::firstOrCreate(['name' => $type['name']], $type);
        }
    }
}
