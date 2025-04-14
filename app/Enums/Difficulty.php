<?php

namespace App\Enums;

enum Difficulty: int
{
    case Expert = 4;
    case Hard = 3;
    case Intermediate = 2;
    case Easy = 1;
    case Noob = 0;

    /**
     * Return the difficulty into a user readable string
     * /!\ THIS IS NOT THE MAGIC __toString function
     */
    public function toString(): string
    {
        switch ($this) {
            case self::Expert:
                return 'expert';
            case self::Hard:
                return 'hard';
            case self::Intermediate:
                return 'intermediate';
            case self::Easy:
                return 'easy';
            case self::Noob:
                return 'knowing nothing :)';
            default:
                return 'Unknown';
        }
    }
}
