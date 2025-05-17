<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',
        'is_active',
        'is_deleted',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
            'is_deleted' => 'boolean',
        ];
    }

    /**
     * The column to use for soft deletes
     *
     * @var string
     */
    protected $deletedColumn = 'is_deleted';

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->map(fn (string $name) => Str::of($name)->substr(0, 1))
            ->implode('');
    }

    /**
     * Soft delete user
     */
    public function softDelete()
    {
        $this->is_deleted = 1;
        return $this->save();
    }

    /**
     * Check if user is active
     */
    public function isActive(): bool
    {
        return (bool) $this->is_active;
    }

    /**
     * Get user status label
     */
    public function getStatusLabel(): string
    {
        return $this->is_active ? 'Active' : 'Inactive';
    }

    /**
     * Check if user is deleted
     */
    public function isDeleted(): bool
    {
        return (bool) $this->is_deleted;
    }
}
