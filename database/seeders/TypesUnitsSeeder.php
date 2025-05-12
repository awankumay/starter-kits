<?php

namespace Database\Seeders;

use App\Models\UnitType;
use Illuminate\Database\Seeder;

class TypesUnitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data yang sudah ada untuk menghindari konflik dengan UNIQUE constraint
        UnitType::truncate();

        $types = [
            // Excavator dengan berbagai brand
            [
                'type' => 'Excavator CAT',
                'brand' => 'Caterpillar',
                'description' => 'Alat berat untuk penggalian dan pengerukan tanah dengan kapasitas besar',
                'is_deleted' => 0
            ],
            [
                'type' => 'Mini Excavator KOM',
                'brand' => 'Komatsu',
                'description' => 'Excavator ukuran kecil untuk penggalian di area terbatas',
                'is_deleted' => 0
            ],
            [
                'type' => 'Crawler Excavator HIT',
                'brand' => 'Hitachi',
                'description' => 'Excavator dengan roda rantai untuk stabilitas di medan berat',
                'is_deleted' => 0
            ],

            // Bulldozer dengan berbagai brand
            [
                'type' => 'Bulldozer KOM',
                'brand' => 'Komatsu',
                'description' => 'Alat berat untuk mendorong material seperti tanah, pasir atau sampah',
                'is_deleted' => 0
            ],
            [
                'type' => 'Heavy Bulldozer CAT',
                'brand' => 'Caterpillar',
                'description' => 'Bulldozer kapasitas besar untuk proyek skala besar',
                'is_deleted' => 0
            ],

            // Loader
            [
                'type' => 'Wheel Loader VOL',
                'brand' => 'Volvo',
                'description' => 'Alat berat dengan bucket di depan untuk mengangkut material',
                'is_deleted' => 0
            ],
            [
                'type' => 'Compact Wheel Loader JD',
                'brand' => 'John Deere',
                'description' => 'Wheel loader ukuran kompak untuk proyek konstruksi kecil hingga menengah',
                'is_deleted' => 0
            ],

            // Truck
            [
                'type' => 'Dump Truck HIN',
                'brand' => 'Hino',
                'description' => 'Kendaraan untuk mengangkut material dalam jumlah besar',
                'is_deleted' => 0
            ],
            [
                'type' => 'Heavy Duty Dump Truck SCA',
                'brand' => 'Scania',
                'description' => 'Dump truck dengan kapasitas angkut sangat besar untuk pertambangan',
                'is_deleted' => 0
            ],
            [
                'type' => 'Mini Dump Truck MIT',
                'brand' => 'Mitsubishi',
                'description' => 'Dump truck ukuran kecil untuk proyek konstruksi di area terbatas',
                'is_deleted' => 0
            ],

            // Grader
            [
                'type' => 'Motor Grader CAT',
                'brand' => 'Caterpillar',
                'description' => 'Alat berat untuk meratakan permukaan tanah',
                'is_deleted' => 0
            ],
            [
                'type' => 'Articulated Grader JD',
                'brand' => 'John Deere',
                'description' => 'Grader dengan sasis yang dapat bergerak untuk fleksibilitas tinggi',
                'is_deleted' => 0
            ],

            // Backhoe
            [
                'type' => 'Backhoe Loader JCB',
                'brand' => 'JCB',
                'description' => 'Alat berat kombinasi excavator dan loader',
                'is_deleted' => 0
            ],
            [
                'type' => 'Compact Backhoe Loader CAS',
                'brand' => 'Case',
                'description' => 'Backhoe loader ukuran kompak untuk proyek di area terbatas',
                'is_deleted' => 0
            ],

            // Mixer
            [
                'type' => 'Truck Mixer MBZ',
                'brand' => 'Mercedes-Benz',
                'description' => 'Kendaraan untuk mengangkut beton siap pakai',
                'is_deleted' => 0
            ],
            [
                'type' => 'Self-Loading Mixer FIO',
                'brand' => 'Fiori',
                'description' => 'Mixer beton yang dapat memuat dan mencampur sendiri',
                'is_deleted' => 0
            ],

            // Crane
            [
                'type' => 'Mobile Crane LIE',
                'brand' => 'Liebherr',
                'description' => 'Alat berat untuk mengangkat dan memindahkan beban berat',
                'is_deleted' => 0
            ],
            [
                'type' => 'Tower Crane POT',
                'brand' => 'Potain',
                'description' => 'Crane permanen untuk konstruksi bangunan tinggi',
                'is_deleted' => 0
            ],
            [
                'type' => 'Crawler Crane MAN',
                'brand' => 'Manitowoc',
                'description' => 'Crane dengan roda rantai untuk stabilitas di area konstruksi',
                'is_deleted' => 0
            ],

            // Forklift
            [
                'type' => 'Forklift TOY',
                'brand' => 'Toyota',
                'description' => 'Kendaraan untuk mengangkat dan memindahkan material di gudang',
                'is_deleted' => 0
            ],
            [
                'type' => 'Electric Forklift HYS',
                'brand' => 'Hyster',
                'description' => 'Forklift dengan tenaga listrik untuk penggunaan dalam ruangan',
                'is_deleted' => 0
            ],
            [
                'type' => 'Rough Terrain Forklift LIN',
                'brand' => 'Linde',
                'description' => 'Forklift untuk operasi di medan kasar atau tidak rata',
                'is_deleted' => 0
            ],

            // Articulated Truck
            [
                'type' => 'Articulated Truck VOL',
                'brand' => 'Volvo',
                'description' => 'Truk dengan sasis berengsel untuk medan berat',
                'is_deleted' => 0
            ],
            [
                'type' => 'Heavy Articulated Truck BEL',
                'brand' => 'Bell',
                'description' => 'Articulated truck dengan kapasitas angkut ekstra besar',
                'is_deleted' => 0
            ],

            // Tambahan jenis alat berat lainnya
            [
                'type' => 'Paver WIR',
                'brand' => 'Wirtgen',
                'description' => 'Alat untuk meletakkan aspal di jalan',
                'is_deleted' => 0
            ],
            [
                'type' => 'Roller Compactor BOM',
                'brand' => 'BOMAG',
                'description' => 'Alat untuk memadatkan tanah, aspal, atau material lainnya',
                'is_deleted' => 0
            ],
            [
                'type' => 'Drilling Rig ATC',
                'brand' => 'Atlas Copco',
                'description' => 'Peralatan untuk pengeboran tanah atau batuan',
                'is_deleted' => 0
            ],
            [
                'type' => 'Telehandler JLG',
                'brand' => 'JLG',
                'description' => 'Alat angkat dengan lengan teleskopik untuk mengangkat material ke ketinggian',
                'is_deleted' => 0
            ],
            [
                'type' => 'Scissor Lift GEN',
                'brand' => 'Genie',
                'description' => 'Platform kerja yang dapat dinaikkan secara vertikal',
                'is_deleted' => 0
            ],
            [
                'type' => 'Concrete Pump PUT',
                'brand' => 'Putzmeister',
                'description' => 'Alat untuk memompa beton ke lokasi pengecoran',
                'is_deleted' => 0
            ],
        ];

        $this->command->info('Membuat ' . count($types) . ' tipe unit...');

        foreach ($types as $type) {
            // Periksa apakah tipe sudah ada untuk menghindari konflik UNIQUE constraint
            $existingType = UnitType::where('type', $type['type'])->first();

            if (!$existingType) {
                UnitType::create($type);
            } else {
                $this->command->warn('Tipe ' . $type['type'] . ' sudah ada, dilewati.');
            }
        }

        $this->command->info('Selesai membuat tipe unit.');
    }
}
