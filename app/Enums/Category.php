<?php

namespace App\Enums;

enum Category: String
{
    case Cutlery = 'cutlery';
    case Embroidery = 'embroidery';
    case Crochet = 'crochet';
    case Woodworking = 'woodworking';
    case Knitting = 'knitting';

    public static function casesToString(): string
    {
        return implode(',', array_map(fn ($case) => $case->name, self::cases()));
    }
}
