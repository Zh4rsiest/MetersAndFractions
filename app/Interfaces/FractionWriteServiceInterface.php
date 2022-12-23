<?php

namespace App\Interfaces;

use App\Models\Fraction;
use Illuminate\Support\Collection;

interface FractionWriteServiceInterface
{
    public function insert(array $fraction): Fraction;
    public function insertMultiple(array $fractions): Collection;
    public function update(int $id, array $array): Fraction;
    public function delete(int $id): void;
}
