<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fuels', function (Blueprint $table) {
            $table->id();
            $table->string('request_number')->unique(); // Nomor permintaan pengisian BBM
            $table->unsignedBigInteger('operations_unit_id'); // Relasi ke unit operasi
            $table->date('request_date'); // Tanggal permintaan
            $table->string('fuels_type'); // Jenis bahan bakar
            $table->decimal('volume', 12, 2); // Diubah dari (10,2) ke (12,2) untuk menampung ribuan liter
            $table->string('location')->nullable(); // Lokasi pengisian
            $table->enum('status', ['pending', 'approved', 'rejected', 'completed'])->default('pending'); // Status permintaan
            $table->text('notes')->nullable(); // Catatan tambahan
            $table->string('fuels_indicator_photo')->nullable(); // Foto indikator BBM kendaraan
            $table->unsignedBigInteger('requested_by')->nullable(); // User yang meminta
            $table->unsignedBigInteger('approved_by')->nullable(); // User yang menyetujui
            $table->timestamp('approved_at')->nullable(); // Waktu disetujui
            $table->softDeletes(); // Menambahkan kolom deleted_at untuk soft delete
            $table->timestamps();

            // Menambahkan foreign key constraint ke units (nama tabel yang benar)
            // $table->foreign('operations_unit_id')->references('id')->on('units')->onDelete('restrict');

            // Relasi ke tabel users jika ada
            // $table->foreign('requested_by')->references('id')->on('users')->onDelete('set null');
            // $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuels');
    }
};
