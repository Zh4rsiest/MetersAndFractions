<?php

namespace Tests\Unit\MeterReadings;

use App\Models\Fraction;
use App\Models\MeterReading;
use App\Repositories\FractionWriteRepository;
use App\Repositories\MeterReadingReadRepository;
use Illuminate\Support\Collection;
use Tests\Helpers\FractionsHelper;
use Tests\Helpers\MeterReadingHelper;
use Tests\TestCase;

class MeterReadingReadRepositoryTest extends TestCase
{
    private MeterReadingReadRepository $meterReadingReadRepository;

    private array $dataForACustomer = MeterReadingHelper::MeterReadingsForACustomer;

    protected function setUp(): void
    {
        parent::setUp();
        $this->meterReadingReadRepository = new MeterReadingReadRepository();
    }

    public function testConvertToMeterReadingCollection()
    {
        $meterReadings = $this->meterReadingReadRepository->convertToMeterReadingCollection($this->dataForACustomer);
        $this->assertInstanceOf(Collection::class, $meterReadings);

        foreach ($meterReadings as $meterReading) {
            $this->assertInstanceOf(MeterReading::class, $meterReading);
        }
    }

    public function testDoesProfileExistForFraction()
    {
        // Assertion – profile doesn't exist
        $meterReading = MeterReading::factory()->create($this->dataForACustomer['JAN']);
        $this->assertFalse($this->meterReadingReadRepository->doesFractionExistForMeterReading($meterReading));
        // Next assertion – profile exists
        Fraction::factory()->create(FractionsHelper::fractionsForACustomer['JAN']);
        $this->assertTrue($this->meterReadingReadRepository->doesFractionExistForMeterReading($meterReading));

    }

    public function testSortDataByMonths()
    {
        $meterReadings = MeterReadingHelper::getConvertedMeterRatings();
        $sortedCollection = $this->meterReadingReadRepository->sortDataByMonths($meterReadings);

        for ($i = 0; $i < $sortedCollection->count(); $i++) {
            $this->assertEquals($i + 1, $sortedCollection[$i]['month']);
        }
    }

    public function testIsMeterLowerThanPreviousMonth()
    {
        $previousMeterReadingData = $this->dataForACustomer['FEB'];
        $currentMeterReadingData = $this->dataForACustomer['MAR'];

        MeterReading::factory()->create($previousMeterReadingData);

        $meterReading = MeterReading::factory()->create($currentMeterReadingData);
        // Next assertion – fraction is higher
        $this->assertFalse($this->meterReadingReadRepository->isMeterLowerThanPreviousMonth($meterReading));
        // Next assertion – fraction is same
        $meterReading->meter_reading = $this->dataForACustomer['FEB']['meter_reading'];
        $meterReading->save();

        $this->assertFalse($this->meterReadingReadRepository->isMeterLowerThanPreviousMonth($meterReading));
        // Next assertion – fraction is lower
        $meterReading->meter_reading = $this->dataForACustomer['FEB']['meter_reading'] - 1;
        $meterReading->save();

        $this->assertTrue($this->meterReadingReadRepository->isMeterLowerThanPreviousMonth($meterReading));
    }

    public function testIsConsumptionWithinTolerance()
    {
        $meterReadings = [];
        // Populate DB with a profile's yearly Fractions and MeterReadings
        $fractions = FractionsHelper::fractionsForACustomer;
        foreach ($fractions as $fraction) {
            Fraction::factory()->create($fraction);
        }

        foreach ($this->dataForACustomer as $meterReading) {
            $meterReadings[] = MeterReading::factory()->create($meterReading);
        }

        $this->meterReadingReadRepository->sortDataByMonths(collect($meterReadings));
        // // Assertion – All values are within tolerance
        // foreach ($meterReadings as $meterReading) {
        //     $this->assertTrue($this->meterReadingReadRepository->isConsumptionWithinTolerance($meterReading));
        // }
        // Next Assertion – Feb consumption is not within tolerance
        $meterReadingFeb = MeterReading::where('month', 2)->first();
        $meterReadingFeb->update(['meter_reading' => 20]);

        $this->assertFalse($this->meterReadingReadRepository->isConsumptionWithinTolerance($meterReadingFeb));
    }
}
