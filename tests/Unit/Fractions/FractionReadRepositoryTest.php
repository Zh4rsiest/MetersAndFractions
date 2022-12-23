<?php

namespace Tests\Unit\Fractions;

use App\Repositories\FractionReadRepository;
use Tests\Helpers\FractionsHelper;
use Tests\TestCase;

class FractionReadRepositoryTest extends TestCase
{
    private FractionReadRepository $fractionReadRepository;

    private array $dataForACustomer = FractionsHelper::fractionsForACustomer;

    protected function setUp(): void
    {
        parent::setUp();
        $this->fractionReadRepository = new FractionReadRepository();
    }

    public function testAreSumOfFractionsEqualOne()
    {
        $this->assertTrue($this->fractionReadRepository->areSumOfFractionsEqualOne($this->dataForACustomer));
        // Next assertion – data is not equal to 1
        $modifiedCustomerData = $this->dataForACustomer;
        $modifiedCustomerData['FEB']['fraction'] = 0;
        $this->assertFalse($this->fractionReadRepository->areSumOfFractionsEqualOne($modifiedCustomerData));
    }
}
