<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Newsletter extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'newsletter';

    protected $fillable = [
        'name',
        'email',
    ];
}
