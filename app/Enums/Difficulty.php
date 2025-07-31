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
                return 'difficile';
            case self::Intermediate:
                return 'intermédiaire';
            case self::Easy:
                return 'facile';
            case self::Noob:
                return 'super facile';
            default:
                return 'inconnu';
        }
    }

    public static function toArray(): array
    {
        $cases = self::cases();
        $return = [];
        foreach ($cases as $case) {
            $element = [];
            $element['value'] = $case->value;
            $element['name'] = $case->toString();
            $return[] = $element;
        }

        return $return;
    }
}
