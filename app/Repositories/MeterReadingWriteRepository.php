<?php

namespace App\Repositories;

use App\Interfaces\MeterReadingWriteServiceInterface;
use App\Models\MeterReading;

class MeterReadingWriteRepository implements MeterReadingWriteServiceInterface
{
    /**
     * Inserts a single MeterReading
     *
     * @param array $array
     * @return MeterReading
     */
    public function insert(array $array): MeterReading
    {
        return MeterReading::create($array);
    }

    /**
     * Updates a single MeterReading
     *
     * @param array $array
     * @return MeterReading
     */
    public function update(int $id, array $array): MeterReading
    {
        return MeterReading::find($id)->update($array);
    }

    /**
     * Deletes a single MeterReading
     *
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        MeterReading::find($id)->delete();
    }
}
