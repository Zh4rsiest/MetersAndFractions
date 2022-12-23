<?php

namespace Tests\Helpers;

use App\Repositories\MeterReadingReadRepository;
use Illuminate\Support\Collection;

class MeterReadingHelper
{
    public const MeterReadingsForACustomer = [
        'JUL' => [
            'meter_id'      => '0001',
            'month'         => 'JUL',
            'profile'       => 'A',
            'meter_reading' => 61
        ],
        'FEB' => [
            'meter_id'      => '0001',
            'month'         => 'FEB',
            'profile'       => 'A',
            'meter_reading' => 32
        ],
        'MAR' => [
            'meter_id'      => '0001',
            'month'         => 'MAR',
            'profile'       => 'A',
            'meter_reading' => 45
        ],
        'APR' => [
            'meter_id'      => '0001',
            'month'         => 'APR',
            'profile'       => 'A',
            'meter_reading' => 53
        ],
        'JAN' => [
            'meter_id'      => '0001',
            'month'         => 'JAN',
            'profile'       => 'A',
            'meter_reading' => 15
        ],
        'MAY' => [
            'meter_id'      => '0001',
            'month'         => 'MAY',
            'profile'       => 'A',
            'meter_reading' => 61
        ],
        'JUN' => [
            'meter_id'      => '0001',
            'month'         => 'JUN',
            'profile'       => 'A',
            'meter_reading' => 61
        ],
        'DEC' => [
            'meter_id'      => '0001',
            'month'         => 'DEC',
            'profile'       => 'A',
            'meter_reading' => 100
        ],
        'SEP' => [
            'meter_id'      => '0001',
            'month'         => 'SEP',
            'profile'       => 'A',
            'meter_reading' => 66
        ],
        'OCT' => [
            'meter_id'      => '0001',
            'month'         => 'OCT',
            'profile'       => 'A',
            'meter_reading' => 75
        ],
        'NOV' => [
            'meter_id'      => '0001',
            'month'         => 'NOV',
            'profile'       => 'A',
            'meter_reading' => 85
        ],

        'AUG' => [
            'meter_id'      => '0001',
            'month'         => 'AUG',
            'profile'       => 'A',
            'meter_reading' => 62
        ],
    ];

    public static function getConvertedMeterRatings() : Collection
    {
        return (new MeterReadingReadRepository())->convertToMeterReadingCollection(self::MeterReadingsForACustomer);
    }
}
