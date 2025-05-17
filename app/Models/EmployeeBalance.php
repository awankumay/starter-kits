<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeBalance extends Model
{
    protected $fillable = [
        'employee_id',
        'balance_type',
        'amount',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
