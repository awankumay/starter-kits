<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class UnitType
 *
 * @property $id
 * @property $type
 * @property $brand
 * @property $description
 * @property $is_deleted
 * @property $deleted_at
 * @property $created_at
 * @property $updated_at
 *
 * @property Units[] $units
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class UnitType extends Model
{
    use SoftDeletes;

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['type', 'brand', 'description', 'is_deleted'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function units()
    {
        return $this->hasMany(Units::class, 'unit_type_id');
    }

}
