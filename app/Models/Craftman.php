<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Craftman extends Model
{
    use HasFactory, HasUuids;

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
}
