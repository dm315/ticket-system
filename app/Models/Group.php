<?php

namespace App\Models;

use App\Models\Project\Project;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];


    public function scopeSearch($query, $value)
    {
        $query->where('name', 'LIKE', "%{$value}%");
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo($this, 'parent_id')->with('parent');
    }

    public function children(): HasMany
    {
        return $this->hasMany($this, 'parent_id')->with('children');
    }


    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'group_user');
    }

    public function groupLeader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'group_leader_id');
    }


    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'group_id');
    }
}
