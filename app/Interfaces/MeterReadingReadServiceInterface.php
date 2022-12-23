<?php

namespace App\Interfaces;

use App\Models\MeterReading;
use Illuminate\Support\Collection;

interface MeterReadingReadServiceInterface
{
    public function find(int $id): MeterReading;
    public function convertToMeterReadingCollection(array $meterReadings) : Collection;
    public function doesFractionExistForMeterReading(MeterReading $meterReading) : bool;
    public function isMeterLowerThanPreviousMonth(MeterReading $meterReading) : bool;
    public function isConsumptionWithinTolerance(MeterReading $meterReading) : bool;
    public function sortDataByMonths(Collection $collection) : Collection;
}
