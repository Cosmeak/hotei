<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    // ┌───────────────────────────────┐
    // │ attributes                    │
    // └───────────────────────────────┘
    protected $fillable = [
        'craftman_id',
        'craftsmanship_id',
        'title',
        'description',
        'duration',
        'difficulty',
        'cost',
        'materials',
        'is_draft',
        'is_skill',
    ];

    protected $casts = [
        'materials' => 'json',
    ];

    // ┌───────────────────────────────┐
    // │ relations                     │
    // └───────────────────────────────┘
    public function craftman(): BelongsTo
    {
        return $this->belongsTo(Craftman::class);
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'skills', 'skill_id');
    }

    public function completed(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'completed');
    }

    public function buyed(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'orders');
    }

    public function craftmanship(): BelongsTo
    {
        return $this->belongsTo(Craftsmanship::class);
    }

    public function project(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'projects_courses');
    }

    // ┌───────────────────────────────┐
    // │ scope queries                 │
    // └───────────────────────────────┘
    public function scopeSkill(Builder $query): void
    {
        $query->where('is_skill', '=', true);
    }

    public function scopeNotSkill(Builder $query): void
    {
        $query->where('is_skill', '!=', false);
    }
}
