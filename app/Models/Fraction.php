<?php

namespace App\Models;

use App\Casts\ToMonth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fraction extends Model
{
    use HasFactory;

    protected $table = 'fractions';

    protected $fillable = [
        'month',
        'profile',
        'fraction'
    ];

    public $timestamps = false;

    protected $casts = [
        'month' => ToMonth::class
    ];

    /**
     * Returns the previous month's Meter Reading for the same profile
     *
     * @param Builder $query
     * @param string $profile Profile of MeterReading
     * @param int $month Month to start from
     * @return Builder
     */
    public function scopeProfileMonth(Builder $query, string $profile, int $month)
    {
        return $query->where('profile', $profile)
            ->where('month', 'like', $month);
    }
}
