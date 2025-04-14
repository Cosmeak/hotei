<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, HasUuids, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "google_id",
        "craftman_id",
        "firstname",
        "lastname",
        "role",
        "email",
        "password",
        "credits",
        "subscription_plan",
        "verified_at",
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ["password", "remember_token"];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            "email_verified_at" => "datetime",
            "password" => "hashed",
        ];
    }

    // ┌───────────────────────────────┐
    // │ relations                                          │
    // └───────────────────────────────┘
    public function completedCourses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, "completed")->withPivot(
            "completed_at"
        );
    }

    public function completedProjects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, "completed")->withPivot(
            "completed_at"
        );
    }

    // public function orders(): HasMany
    // {
    //     return $this->hasMany(Order::class);
    // }

    public function craftman(): HasOne
    {
        return $this->hasOne(Craftman::class);
    }
}
