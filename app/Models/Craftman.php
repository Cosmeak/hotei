<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Craftman extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'craftmen';

    protected $fillable = [
        'user_id',
        'avatar',
        'website',
        'phone',
        'instagram',
        'facebook',
        'categories',
        'description',
    ];

    // ┌───────────────────────────────┐
    // │ attributes                    │
    // └───────────────────────────────┘
    protected function categories(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => explode('|', $value),
            set: fn ($value) => implode('|', $value),
        );
    }

    // ┌───────────────────────────────┐
    // │ relations                     │
    // └───────────────────────────────┘
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }
}
