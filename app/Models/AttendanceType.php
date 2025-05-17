<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceType extends Model
{
    protected $fillable = ['name', 'description'];

    public function absences()
    {
        // Tidak perlu foreign key constraint di database, cukup relasi Eloquent
        return $this->hasMany(Absence::class, 'attendance_type_id');
    }
}
