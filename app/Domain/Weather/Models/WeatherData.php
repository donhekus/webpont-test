<?php

namespace App\Domain\Weather\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class WeatherData
 * @package App\Domain\Weather\Models
 *
 * @property int    $id
 * @property Carbon $timestamp
 * @property string $name
 * @property float  $latitude
 * @property float  $longitude
 * @property float  $temperature
 * @property int    $pressure
 * @property int    $humidity
 * @property float  $min_temperature
 * @property float  $max_temperature
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class WeatherData extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'timestamp' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'timestamp',
        'name',
        'latitude',
        'longitude',
        'temperature',
        'pressure',
        'humidity',
        'min_temperature',
        'max_temperature',
    ];
}
