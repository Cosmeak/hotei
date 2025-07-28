<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class LemonSqueezySubscription extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'id',
        'billable_type',
        'billable_id',
        'type',
        'lemon_squeezy_id',
        'status',
        'product_id',
        'variant_id',
        'card_brand',
        'card_last_four',
        'pause_mode',
        'pause_resumes_at',
        'trial_ends_at',
        'renews_at',
        'ends_at',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'trial_ends_at' => 'datetime',
        'renews_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    /**
     * Polymorphic relation to the billable model (User, Team, etc.).
     */
    public function billable(): MorphTo
    {
        return $this->morphTo();
    }
}
