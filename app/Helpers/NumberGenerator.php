<?php

namespace App\Helpers;

class NumberGenerator
{
    public static function generatorRandomDigit(): string
    {
        return now()->timestamp . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
    }
}
