<?php

namespace App\Repositories;

use App\Interfaces\FractionReadServiceInterface;
use App\Models\Fraction;

class FractionReadRepository implements FractionReadServiceInterface
{
    /**
     * Returns a single Fraction
     *
     * @param int $id
     * @return Fraction
     */
    public function find(int $id): Fraction
    {
        return Fraction::find($id);
    }

    public function areSumOfFractionsEqualOne(array $array): bool
    {
        $sum = 0;

        foreach ($array as $item) {
            $sum += $item['fraction'];
        }

        return (int)$sum === 1;
    }
}
