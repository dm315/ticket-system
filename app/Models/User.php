<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\tasks\Task;
use App\Traits\Permissions\HasPermissionsTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasPermissionsTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    //! Helper function::

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn() => "{$this->fName} {$this->lName}"
        );
    }

    public function scopeSearch($query, $value)
    {
        $query->where('fName', 'LIKE', "%{$value}%")
            ->orWhere('lName', 'LIKE', "%{$value}%")
            ->orWhere('email', 'LIKE', "%{$value}%")
            ->orWhere('mobile', 'LIKE', "%{$value}%")
            ->orWhere('birth', 'LIKE', "%{$value}%");
    }

    public function isSuperAdmin()
    {
        return $this->user_type == 2;
    }

    public function isAdmin()
    {
        return $this->user_type == 1;
    }

    //! Relationship::
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(Group::class, 'group_user');
    }

    public function groups(): HasMany
    {
        return $this->hasMany(Group::class, 'group_leader_id');
    }


    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'task_user');
    }
}
