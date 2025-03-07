<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    // ┌───────────────────────────────┐
    // │ attributes                    │
    // └───────────────────────────────┘
    protected $fillables = [
        'craftman_id',
        'craftmanship_id',
        'description',
        'duration',
        'is_draft',
    ];

    // ┌───────────────────────────────┐
    // │ relations                     │
    // └───────────────────────────────┘
    public function craftman(): BelongsTo
    {
        return $this->belongsTo(Craftman::class);
    }

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'projects_courses');
    }

    public function craftmanship(): BelongsTo
    {
        return $this->belongsTo(Craftsmanship::class);
    }

}
