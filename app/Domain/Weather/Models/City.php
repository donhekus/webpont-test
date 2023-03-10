<?php

namespace App\Domain\Weather\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class City
 * @package App\Domain\Weather\Models
 *
 * @property int    $id
 * @property string $name
 * @property float  $latitude
 * @property float  $longitude
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class City extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'latitude',
        'longitude',
    ];
}
