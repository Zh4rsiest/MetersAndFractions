<?php

namespace Tests\Unit\MeterReadings;

use App\Models\MeterReading;
use App\Repositories\MeterReadingWriteRepository;
use Tests\Helpers\MeterReadingHelper;
use Tests\TestCase;

class MeterReadingWriteRepositoryTest extends TestCase
{
    private MeterReadingWriteRepository $meterReadingWriteRepository;

    private array $dataForACustomer = MeterReadingHelper::MeterReadingsForACustomer;

    protected function setUp(): void
    {
        parent::setUp();
        $this->meterReadingWriteRepository = new MeterReadingWriteRepository();
    }

    public function testInsert()
    {
        $meterReadingJan = $this->dataForACustomer['JAN'];
        $insertedFraction = $this->meterReadingWriteRepository->insert($meterReadingJan);
        $meterReadingJan = MeterReading::find($insertedFraction->id);

        $this->assertNotNull($meterReadingJan);
    }
}
