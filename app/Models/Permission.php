<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function scopeSearch($query, $value)
    {
        $query->where('title', 'LIKE', "%{$value}%")
            ->OrWhere('persian_name', 'LIKE', "%{$value}%")
            ->OrWhere('description', 'LIKE', "%{$value}%")
            ->OrWhere('status', 'LIKE', "%{$value}%");
    }


    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'permission_role');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'permission_user');
    }
}
