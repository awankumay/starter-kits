<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Position extends Model
{
    use SoftDeletes;

    protected $fillable = ['position', 'description'];

    public function employees()
    {
        // Tidak perlu foreign key constraint di database, cukup relasi Eloquent
        return $this->hasMany(Employee::class, 'position_id');
    }
}
