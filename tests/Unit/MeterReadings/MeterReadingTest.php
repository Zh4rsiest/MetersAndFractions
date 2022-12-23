<?php

namespace Tests\Unit\MeterReadings;

use App\Models\MeterReading;
use Tests\Helpers\MeterReadingHelper;

class MeterReadingTest extends \Tests\TestCase
{
    private $dataForACustomer = MeterReadingHelper::MeterReadingsForACustomer;

    public function testGetTotalConsumptionForProfile()
    {
        foreach ($this->dataForACustomer as $meterReading)
        {
            MeterReading::factory()->create($meterReading);
        }

        $this->assertEquals(100, MeterReading::totalConsumptionForProfile($this->dataForACustomer['JAN']['profile'])->first()->meter_reading);
    }
}
