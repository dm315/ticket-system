<?php

namespace App\Models\Project;

use App\Models\Group;
use App\Models\Media;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;


    protected $guarded = ['id'];



    public function scopeSearch($query, $value)
    {
        $query->where('title', 'LIKE', "%{$value}%")
            ->orWhere('id', 'LIKE', "%{$value}%")
            ->orWhere('client', 'LIKE', "%{$value}%");
    }


    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status_id')->where('type', 1);
    }

    public function medias(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }
}
