<?php

namespace App\Http\Controllers;

use App\Interfaces\MeterReadingReadServiceInterface;
use App\Interfaces\MeterReadingWriteServiceInterface;
use App\LogMessages\MeterReadingLogMessages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MeterReadingController extends Controller
{
    public function __construct(
        private MeterReadingReadServiceInterface $meterReadingReadRepository,
        private MeterReadingWriteServiceInterface $meterReadingWriteRepository
    ) { }

    public function store(Request $request) {
        $unsortedMeterReadings = $this->meterReadingReadRepository->convertToMeterReadingCollection($request->toArray());
        $meterReadings = $this->meterReadingReadRepository->sortDataByMonths($unsortedMeterReadings);

        foreach ($meterReadings as $meterReading) {
            if (!$this->meterReadingReadRepository->doesFractionExistForMeterReading($meterReading)) {
                Log::error(MeterReadingLogMessages::profileDataDoesntExistForMeterReading($meterReading));
                continue;
            }

            if ($this->meterReadingReadRepository->isMeterLowerThanPreviousMonth($meterReading)) {
                Log::error(MeterReadingLogMessages::meterReadingIsLowerThanPreviousMonths($meterReading));
                continue;
            }

            $this->meterReadingWriteRepository->insert($meterReading->toArray());
        }
        // Due to time constraint, I'm sacrificing some performance
        foreach ($meterReadings as $meterReading) {
            if ($this->meterReadingReadRepository->isConsumptionWithinTolerance($meterReading)) {
                continue;
            }

            Log::error(MeterReadingLogMessages::consumptionIsNotWithinTolerance($meterReading));
            $meterReading->delete();
        }
    }

    public function delete($id) {
        $this->meterReadingWriteRepository->delete($id);
    }

    public function update($id, Request $request) {
        return $this->meterReadingWriteRepository->update($id, $request->toArray())->toJson();
    }

    public function find($id) {
        return $this->meterReadingReadRepository->find($id)->toJson();
    }

    public function getConsumption(mixed $month) {
        // TODO:
    }
}
