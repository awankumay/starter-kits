<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class OperationsUnit
 *
 * @property $id
 * @property $code
 * @property $name
 * @property $unit_type_id
 * @property $location
 * @property $fuel_type
 * @property $fuel_capacity
 * @property $capacity
 * @property $operator
 * @property $status
 * @property $description
 * @property $image_unit
 * @property $deleted_at
 * @property $created_at
 * @property $updated_at
 *
 * @property UnitType $unitType
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class OperationsUnit extends Model
{
    use SoftDeletes;

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['code', 'name', 'unit_type_id', 'location', 'fuel_type', 'fuel_capacity', 'capacity', 'operator', 'status', 'description', 'image_unit'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function unitType()
    {
        return $this->belongsTo(\App\Models\UnitType::class, 'unit_type_id', 'id');
    }
    
}
