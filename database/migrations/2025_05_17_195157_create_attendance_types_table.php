<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendance_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // e.g. present, sick, leave, absent, etc.
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendance_types');
    }
};

// tidak ada foreign key, biarkan seperti ini
