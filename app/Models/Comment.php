<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory, HasUuids;

    // ┌───────────────────────────────┐
    // │ attributes                                         |
    // └───────────────────────────────┘
    protected $fillable = [
        'user_id',
        'course_id',
        'comment_id',
        'text',
    ];

    // ┌───────────────────────────────┐
    // │ relations                                          |
    // └───────────────────────────────┘
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'comment_id', 'id');
    }
}
