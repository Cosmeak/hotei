<?php

namespace App\Models;

use App\Enums\Difficulty;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;

class Project extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    // ┌───────────────────────────────┐
    // │ attributes                    │
    // └───────────────────────────────┘
    protected $fillables = [
        'craftman_id',
        'craftsmanship_id',
        'title',
        'description',
        'difficulty',
        'cost',
        'duration',
        'is_draft',
    ];

    /*
     * Cast Enum difficulty to readable value
     */
    public function difficulty(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Difficulty::tryFrom($value)->toString(),
            set: fn ($value) => $value instanceof Difficulty ? $value->value : (is_int($value) ? $value : null),
        );
    }

    // ┌───────────────────────────────┐
    // │ relations                     │
    // └───────────────────────────────┘
    public function craftman(): BelongsTo
    {
        return $this->belongsTo(Craftman::class);
    }

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'projects_courses')->withPivot(['position']);
    }

    public function craftmanship(): BelongsTo
    {
        return $this->belongsTo(Craftsmanship::class);
    }

    // ┌───────────────────────────────┐
    // │ scope queries                 │
    // └───────────────────────────────┘
    public function scopeIsPublished(Builder $query, bool $bool = false): void
    {
        $query->where('is_draft', $bool);
    }
}
