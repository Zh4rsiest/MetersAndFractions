<?php

namespace App\Repositories;

use App\Http\Requests\FractionRequest;
use App\Interfaces\MeterReadingReadServiceInterface;
use App\Models\Fraction;
use App\Models\MeterReading;
use Illuminate\Support\Collection;

class MeterReadingReadRepository implements MeterReadingReadServiceInterface
{
    /**
     * Returns a single MeterReading
     *
     * @param int $id
     * @return MeterReading
     */
    public function find(int $id): MeterReading
    {
        return MeterReading::find($id);
    }

    /**
     * Returns a Collection of MeterReading models with each element
     * of $meterReadings being a model
     *
     * @param array $array
     * @return Collection
     */
    public function convertToMeterReadingCollection(array $meterReadings) : Collection
    {
        $meterReadingsModels = [];

        foreach ($meterReadings as $meterReading) {
            $meterReadingsModels[] = new MeterReading($meterReading);
        }

        return collect($meterReadingsModels);
    }

    /**
     * Returns that data for $meterReading's profile exists
     *
     * @param MeterReading $meterReading
     * @return bool
     */
    public function doesFractionExistForMeterReading(MeterReading $meterReading) : bool
    {
        $fraction = Fraction::where('profile', $meterReading->profile)
            ->where('month', $meterReading->month)
            ->first();

        return $fraction != null;
    }

    /**
     * Sorts a MeterReading collection by their month's name
     *
     * @param array $array
     * @return array
     */
    public function sortDataByMonths(Collection $collection) : Collection
    {
        return $collection->sortBy('month')->values();
    }

    /**
     * Checks if the meter is lower than the one before it
     *
     * @param FractionRequest $request
     * @return bool
     */
    public function isMeterLowerThanPreviousMonth(MeterReading $meterReading) : bool
    {
        $previousMeterReading = $this->getPreviousMeterReading($meterReading);

        if (!$previousMeterReading)
            return false;

        if ($previousMeterReading->meter_reading > $meterReading->meter_reading)
            return true;

        return false;
    }

    /**
     * Checks if consumption is within MeterReading::METER_TOLERANCE range
     *
     * @param MeterReading $meterReading
     * @return bool
     */
    public function isConsumptionWithinTolerance(MeterReading $meterReading) : bool
    {
        $previousMeterReading = $this->getPreviousMeterReading($meterReading);
        // Assuming January's consumption can not be calculated
        if (!$previousMeterReading)
            return true;
        // Assuming check that it exists has been done earlier
        $currentFraction = Fraction::profileMonth($meterReading->profile, $meterReading->month)->first();
        $totalConsumption = MeterReading::totalConsumptionForProfile($meterReading->profile)->first()->meter_reading;
        $consumption = $meterReading->meter_reading - $previousMeterReading->meter_reading;
        $fractionConsumption = $totalConsumption * $currentFraction->fraction;
        $low = $fractionConsumption - $fractionConsumption * MeterReading::METER_TOLERANCE;
        $high = $fractionConsumption + $fractionConsumption * MeterReading::METER_TOLERANCE;

        return $consumption >= $low && $consumption <= $high;
    }

    /**
     * Returns the previous month's MeterReading or null if there's none
     *
     * @param MeterReading $meterReading
     * @return MeterReading|null
     */
    private function getPreviousMeterReading(MeterReading $meterReading) : MeterReading|null
    {
        return MeterReading::previousMonth($meterReading->profile, $meterReading->month)->first();
    }
}
