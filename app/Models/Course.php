<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'craftman_id',
        'title',
        'description',
        'category',
        'duration',
        'materials',
        'is_draft',
        'cost',
        'difficulty',
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

    public function project(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'projects_courses');
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
