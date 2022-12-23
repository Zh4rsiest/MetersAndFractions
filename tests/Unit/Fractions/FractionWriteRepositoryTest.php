<?php

namespace Tests\Unit\Fractions;

use App\Models\Fraction;
use App\Repositories\FractionWriteRepository;
use Tests\Helpers\FractionsHelper;
use Tests\TestCase;

class FractionWriteRepositoryTest extends TestCase
{
    private FractionWriteRepository $fractionWriteRepository;

    private array $dataForACustomer = FractionsHelper::fractionsForACustomer;

    protected function setUp(): void
    {
        parent::setUp();
        $this->fractionWriteRepository = new FractionWriteRepository();
    }

    public function testInsertFraction()
    {
        $fractionJan = $this->dataForACustomer['JAN'];
        $insertedFraction = $this->fractionWriteRepository->insert($fractionJan);
        $fractionJan = Fraction::find($insertedFraction->id);

        $this->assertNotNull($fractionJan);
    }

    public function testInsertFractionBulk()
    {
        $fractionsToInsert = [
            $this->dataForACustomer['JAN'],
            $this->dataForACustomer['FEB'],
            $this->dataForACustomer['MAR']
        ];

        $insertedFractions = $this->fractionWriteRepository->insertMultiple($fractionsToInsert);

        foreach ($insertedFractions as $fraction) {
            $fractionInDb = Fraction::find($fraction->id);
            $this->assertNotNull($fractionInDb);
        }
    }
}
