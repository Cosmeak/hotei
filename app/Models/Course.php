<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'course';

    protected $fillable = [
        'user_id',
        'project_id',
        'name',
        'theme',
        'time',
        'materials',
        'is_draft',
        'is_free',
        'difficulty',
    ];
}
