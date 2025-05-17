<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'employee_number', 'name', 'email', 'phone', 'position_id',
        'join_date', 'photo', 'is_active'
    ];

    public function position()
    {
        // Tidak perlu foreign key constraint di database, cukup relasi Eloquent
        return $this->belongsTo(Position::class, 'position_id');
    }

    public function absences()
    {
        return $this->hasMany(Absence::class);
    }

    public function leaves() {
        return $this->hasMany(EmployeeLeave::class);
    }

    public function salaries()
    {
        return $this->hasMany(EmployeeSalary::class);
    }

    public function balances()
    {
        return $this->hasMany(EmployeeBalance::class);
    }
}
