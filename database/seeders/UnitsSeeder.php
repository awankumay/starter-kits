<?php

namespace Database\Seeders;

use App\Models\Units;
use App\Models\UnitType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan ada types terlebih dahulu
        $unitTypesCount = UnitType::count();

        if ($unitTypesCount === 0) {
            $this->command->info('Menjalankan TypesUnitsSeeder terlebih dahulu...');
            $this->call(TypesUnitsSeeder::class);
        }

        // Ambil semua unit type yang berhasil di-seed
        $unitTypes = UnitType::all();

        if ($unitTypes->isEmpty()) {
            $this->command->error('Tidak ada data unit type yang tersedia. Seeding units dibatalkan.');
            return;
        }

        $this->command->info('Ditemukan ' . $unitTypes->count() . ' tipe unit.');

        // List lokasi untuk variasi data
        $locations = [
            'Site A', 'Site B', 'Site C', 'Mine Pit 1', 'Mine Pit 2',
            'Processing Plant', 'Workshop', 'Stockpile Area', 'Port Facility', 'Access Road'
        ];

        // List jenis bahan bakar
        $fuelTypes = ['Diesel', 'Petrol', 'Biodiesel', 'Electric', 'Hybrid'];

        // List operator
        $operators = ['John Doe', 'Jane Smith', 'Robert Johnson', 'Emily Davis', 'Michael Wilson'];

        $this->command->info('Membuat 100 data units...');

        // Hapus data units yang sudah ada untuk menghindari duplikasi
        Units::truncate();

        // Buat 100 unit dummy
        for ($i = 1; $i <= 100; $i++) {
            // Pilih unit type acak dari yang tersedia
            $unitType = $unitTypes->random();

            // Generate kode unit berdasarkan brand dan type dari UnitType
            $code = strtoupper(substr($unitType->brand, 0, 3)) . '-' .
                   strtoupper(substr(preg_replace('/\s+/', '', $unitType->type), 0, 3)) . '-' .
                   str_pad($i, 4, '0', STR_PAD_LEFT);

            // Pastikan kode unik dengan menambahkan suffix jika perlu
            $existingCode = Units::where('code', $code)->exists();
            if ($existingCode) {
                $code .= '-' . chr(rand(65, 90));
            }

            Units::create([
                'code' => $code,
                'name' => $unitType->type . ' #' . $i,
                'unit_type_id' => $unitType->id,
                'location' => $locations[array_rand($locations)],
                'fuel_type' => $fuelTypes[array_rand($fuelTypes)],
                'operator' => $operators[array_rand($operators)],
                'description' => 'Unit ' . $i . ' untuk operasional ' . $locations[array_rand($locations)],
                'image_unit' => null,
                'is_deleted' => 0
            ]);

            if ($i % 10 === 0) {
                $this->command->info("Dibuat $i units...");
            }
        }

        $this->command->info('Selesai membuat 100 data units.');
    }
}
