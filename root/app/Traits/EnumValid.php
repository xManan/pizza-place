<?php

namespace App\Traits;

trait EnumValid {
    public static function isValid(string $value): bool {
        $valid = false;
        foreach (self::cases() as $case) {
            if ($case->value === $value) {
                $valid = true;
                break;
            }
        }
        return $valid;
    }

    public static function isNotValid(string $value): bool {
        $valid = false;
        foreach (self::cases() as $case) {
            if ($case->value === $value) {
                $valid = true;
                break;
            }
        }
        return !$valid;
    }
}