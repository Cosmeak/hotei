<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Notifications\Notifiable;
use LemonSqueezy\Laravel\Billable;

class LemonSqueezyOrder extends Model
{
    use Billable, HasFactory, HasUuids, Notifiable;

    protected $fillable = [
        'id',
        'billable_type',
        'billable_id',
        'lemon_squeezy_id',
        'customer_id',
        'identifier',
        'product_id',
        'variant_id',
        'order_number',
        'currency',
        'subtotal',
        'discount_total',
        'tax',
        'total',
        'tax_name',
        'status',
        'receipt_url',
        'refunded',
        'refunded_at',
        'ordered_at',
    ];

    protected $casts = [
        'subtotal' => 'integer',
        'discount_total' => 'integer',
        'tax' => 'integer',
        'total' => 'integer',
        'refunded' => 'boolean',
        'refunded_at' => 'datetime',
        'ordered_at' => 'datetime',
    ];

    /**
     * Relation polymorphe vers le modèle "billable" (User, Team, etc.)
     */
    public function billable(): MorphTo
    {
        return $this->morphTo();
    }
}
