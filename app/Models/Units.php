<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Units
 *
 * @property $id
 * @property $code
 * @property $name
 * @property $unit_type_id
 * @property $location
 * @property $fuel_type
 * @property $operator
 * @property $description
 * @property $image_unit
 * @property $is_deleted
 * @property $deleted_at
 * @property $created_at
 * @property $updated_at
 *
 * @property UnitType $unitType
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Units extends Model
{
    use SoftDeletes;

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'name',
        'unit_type_id',
        'location',
        'fuel_type',
        'operator',
        'description',
        'image_unit',
        'is_deleted'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function unitType()
    {
        return $this->belongsTo(UnitType::class, 'unit_type_id');
    }
}
