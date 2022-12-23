<?php

namespace App\Models;

use App\Casts\ToMonth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeterReading extends Model
{
    use HasFactory;

    public const METER_TOLERANCE = 0.25;

    protected $table = 'meter_readings';

    protected $fillable = [
        'meter_id',
        'profile',
        'month',
        'meter_reading'
    ];

    protected $casts = [
        'month' => ToMonth::class,
        // 'meter_reading' => 'int'
    ];

    public $timestamps = false;

    /**
     * Scope for previous month's Meter Reading for the same profile
     *
     * @param Builder $query
     * @param string $profile Profile of MeterReading
     * @param int $month Month to start from
     * @return Builder
     */
    public function scopePreviousMonth(Builder $query, string $profile, int $month) : Builder
    {
        return $query->where('profile', $profile)
            ->where('month', '<', $month)
            ->orderBy('month', 'DESC');
    }

    /**
     * Returns sum of meter readings in a year for $profile
     *
     * @param Builder $query
     * @param string $profile Profile of MeterReadings
     * @return Builder
     */
    public function scopeTotalConsumptionForProfile(Builder $query, string $profile) : Builder
    {
        // $meterReadings = $this->where('profile', $profile)
        //     ->pluck('meter_reading')
        //     ->toArray();
        //
        // return array_sum($meterReadings);
        return $query->where('profile', $profile)
            ->where('month', 12);
    }
}
