<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Fuel
 *
 * @property $id
 * @property $request_number
 * @property $operations_unit_id
 * @property $request_date
 * @property $fuels_type
 * @property $volume
 * @property $location
 * @property $status
 * @property $notes
 * @property $fuels_indicator_photo
 * @property $requested_by
 * @property $approved_by
 * @property $approved_at
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property Units $operationsUnit
 * @property User $requester
 * @property User $approver
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Fuel extends Model
{
    use SoftDeletes;

    protected $perPage = 20;

    /**
     * Status permintaan bahan bakar
     */
    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';
    const STATUS_COMPLETED = 'completed';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'request_number',
        'operations_unit_id',
        'request_date',
        'fuels_type',
        'volume',
        'location',
        'status',
        'notes',
        'fuels_indicator_photo',
        'requested_by',
        'approved_by',
        'approved_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'request_date' => 'date',
        'approved_at' => 'datetime',
        'volume' => 'decimal:2'
    ];

    /**
     * Get the operations unit associated with the fuel request.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function operationsUnit()
    {
        return $this->belongsTo(Units::class, 'operations_unit_id');
    }

    /**
     * Get the user who requested the fuel.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function requester()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    /**
     * Get the user who approved the fuel request.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Generate a unique request number.
     *
     * @return string
     */
    public static function generateRequestNumber()
    {
        $lastRequest = self::orderBy('id', 'desc')->first();
        $nextId = $lastRequest ? $lastRequest->id + 1 : 1;

        $dateCode = now()->format('Ymd');

        return "FUEL-{$dateCode}-" . str_pad($nextId, 4, '0', STR_PAD_LEFT);
    }
}
