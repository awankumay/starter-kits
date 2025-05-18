<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Position; // Ensure Position is imported

class Employee extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'employee_number', 'name', 'email', 'phone', 'position_id',
        'join_date', 'photo', 'is_active'
    ];

    /**
     * Get the position that the employee belongs to.
     */
    public function position()
    {
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
