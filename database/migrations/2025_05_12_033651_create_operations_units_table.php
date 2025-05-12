<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Optimasi:
     * - Menambahkan relasi ke tabel unit_types melalui unit_type_id (foreign key).
     * - Menghapus kolom unit_type (string) dan mengganti capacity menjadi integer.
     */
    public function up(): void
    {
        Schema::create('operations_units', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->unsignedBigInteger('unit_type_id'); // relasi ke unit_types
            $table->string('location')->nullable();
            $table->string('fuel_type')->nullable(); // tipe data string untuk jenis bbm
            $table->integer('fuel_capacity')->nullable(); // tipe data integer untuk kapasitas bbm
            $table->integer('capacity')->nullable();
            $table->string('operator')->nullable();
            $table->string('status')->nullable(); // Status data (misal: active, deleted)
            $table->string('description')->nullable();
            $table->string('image_unit')->nullable(); // Menyimpan nama file gambar
            $table->softDeletes(); // Menambahkan kolom deleted_at untuk soft delete
            $table->timestamps();

            // Menambahkan foreign key constraint ke unit_types
            $table->foreign('unit_type_id')->references('id')->on('unit_types')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operations_units');
    }
};
