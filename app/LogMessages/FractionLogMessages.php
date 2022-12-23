<?php

namespace App\LogMessages;

class FractionLogMessages
{
    public static function fractionsSumNotEqualOne(string $profile) : string {
        return 'Data rejected for profile ' . $profile . '. Reason: Fractions sum is not 1';
    }
}
