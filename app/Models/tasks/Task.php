<?php

namespace App\Models\tasks;

use App\Models\Media;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];


    public function scopeSearch($query, $value)
    {
        $query->where('subject', 'LIKE', "%{$value}%")
            ->orWhere('id', 'LIKE', "%{$value}%");
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'task_user')->withPivot(['access', 'is_owner']);
    }

    public function owner()
    {
        $owners = $this->users()->where('is_owner', 1)->get();
        foreach ($owners as $owner) {
            return $owner;
        }
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_id')->where('type', 0);
    }

    public function medias(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }

}
