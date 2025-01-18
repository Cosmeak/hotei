<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'craftman_id',
        'title',
        'description',
        'difficulty',
        'is_draft',
        'duration',
        'cost',
        'category',
        'materials',
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
        return $this->belongsToMany(Course::class, 'projects_courses');
    }

    public function completions(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'completed');
    }

    public function buyed(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'orders');
    }
}
