<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeLeave extends Model
{
    protected $fillable = [
        'employee_id',
        'attendance_type_id',
        'start_date',
        'end_date',
        'reason',
        'attachment',
        'status',
    ];

    // Relasi ke Employee
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    // Relasi ke AttendanceType
    public function attendanceType()
    {
        return $this->belongsTo(AttendanceType::class);
    }
}
