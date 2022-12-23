<?php

namespace App\Repositories;

use App\Interfaces\FractionWriteServiceInterface;
use App\Models\Fraction;
use Illuminate\Support\Collection;

class FractionWriteRepository implements FractionWriteServiceInterface
{
    /**
     * Inserts a single Fraction in the database
     *
     * @param array $fraction
     * @return Fraction
     */
    public function insert(array $fraction): Fraction
    {
        return Fraction::create($fraction);
    }

    /**
     * Inserts as many Fractions in the database as it is in array $fractions
     *
     * @param array $fractions
     * @return Collection
     */
    public function insertMultiple(array $fractions): Collection
    {
        $fractionModels = [];

        foreach ($fractions as $fraction) {
            $fractionModels[] = Fraction::create($fraction);
        }

        return collect($fractionModels);
    }

    /**
     * Updates a single Fraction
     *
     * @param array $array
     * @return Fraction
     */
    public function update(int $id, array $array): Fraction
    {
        return Fraction::find($id)->update($array);
    }

    /**
     * Deletes a single Fraction
     *
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        Fraction::find($id)->delete();
    }
}
