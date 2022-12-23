<?php

namespace App\Interfaces;

use App\Models\Fraction;

interface FractionReadServiceInterface
{
    public function find(int $id) : Fraction;
    public function areSumOfFractionsEqualOne(array $array): bool;
}
