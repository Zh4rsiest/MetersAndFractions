<?php

namespace App\LogMessages;

use App\Models\MeterReading;

class MeterReadingLogMessages
{
    public static function profileDataDoesntExistForMeterReading(MeterReading $meterReading) : string
    {
        return 'Meter reading data for profile ' . $meterReading->profile . ', month ' . $meterReading->month . ' has been rejected due to following reason: Profile data doesn\'t exist';
    }

    public static function meterReadingIsLowerThanPreviousMonths(MeterReading $meterReading) : string
    {
        return 'Meter reading data for profile ' . $meterReading->profile . ', month ' . $meterReading->month . ' has been rejected due to following reason: Meter reading is lower than previous month\'s';
    }

    public static function consumptionIsNotWithinTolerance(MeterReading $meterReading) : string
    {
        return 'Meter reading data for profile ' . $meterReading->profile . ', month ' . $meterReading->month . ' has been rejected due to following reason: Consumption is higher than the tolerance range';
    }
}
