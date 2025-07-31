<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Completed extends Model
{
    use HasFactory;

    protected $table = 'completed';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'course_id',
        'completed_at',
    ];
}
