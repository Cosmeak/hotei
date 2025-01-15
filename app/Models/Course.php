<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'course';

    protected $fillable = [
        'craftman_id',
        'name',
        'theme',
        'time',
        'materials',
        'is_draft',
        'is_free',
        'difficulty',
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
