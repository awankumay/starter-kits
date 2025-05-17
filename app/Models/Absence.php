<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    protected $fillable = [
        'employee_id', 'absence_date', 'attendance_type_id', 'notes'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function attendanceType()
    {
        // Tidak perlu foreign key constraint di database, cukup relasi Eloquent
        return $this->belongsTo(AttendanceType::class, 'attendance_type_id');
    }
}
