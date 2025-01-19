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
        'type',
        'title',
        'category',
        'duration',
        'difficulty',
        'cost',
        'materials',
        'is_draft',
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

    public function linkedCourses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'projects_skills');
    }

    public function completions(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'completed');
    }

    public function buyed(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'orders');
    }

    // ┌───────────────────────────────┐
    // │ scope queries                 │
    // └───────────────────────────────┘
    public function scopeProject(Builder $query): void
    {
        $query->where('type', '=', 'project');
    }

    public function scopeSkill(Builder $query): void
    {
        $query->where('type', '=', 'skill');
    }
}
