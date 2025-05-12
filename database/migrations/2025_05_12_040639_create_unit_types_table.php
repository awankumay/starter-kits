<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Menambahkan kolom deleted_at untuk mendukung konsep soft delete.
     * Data tidak akan dihapus secara permanen, hanya diberi penanda waktu penghapusan.
     */
    public function up(): void
    {
        Schema::create('unit_types', function (Blueprint $table) {
            $table->id();
            $table->string('type')->unique(); // Jenis unit (misal: unit, sub-unit)
            $table->string('brand')->nullable(); // Merek unit (misal: unit, sub-unit)
            $table->string('description')->nullable();
            $table->boolean('is_deleted')->default(0); // is_deleted: Status data (misal: active = 0, deleted = 1)
            $table->softDeletes(); // Menambahkan kolom deleted_at untuk soft delete
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_types');
    }
};
