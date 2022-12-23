<?php

namespace App\Interfaces;

use App\Models\MeterReading;

interface MeterReadingWriteServiceInterface
{
    public function insert(array $array): MeterReading;
    public function update(int $id, array $array): MeterReading;
    public function delete(int $id): void;
}
