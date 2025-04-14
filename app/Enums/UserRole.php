<?php

namespace App\Enums;

enum UserRole: string
{
    case Admin = 'admin';
    case Craftman = 'craftman';
    case User = 'user';
}
