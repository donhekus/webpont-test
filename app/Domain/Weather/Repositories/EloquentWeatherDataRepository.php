<?php

namespace App\Domain\Weather\Repositories;

use App\Domain\Core\Repositories\AbstractEloquentModelRepository;
use App\Domain\Weather\Models\WeatherData;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use JetBrains\PhpStorm\Pure;

/**
 * Class EloquentWeatherDataRepository
 * @package App\Domain\Weather\Repositories
 *
 * @method WeatherData create(array $data)
 * @method WeatherData update(WeatherData $weatherData, array $data)
 * @method bool delete(WeatherData $weatherData)
 * @method Collection<WeatherData> all()
 * @method Collection<WeatherData>|LengthAwarePaginator<WeatherData> filter(array $filters, bool $paginated)
 * @method WeatherData|null findByFields(array $where)
 * @method Collection<WeatherData> getByFields(array $where)
 */
class EloquentWeatherDataRepository extends AbstractEloquentModelRepository
{
    /**
     * @param WeatherData $weatherData
     */
    #[Pure] public function __construct(WeatherData $weatherData)
    {
        parent::__construct($weatherData);
    }

    /**
     * @param float $lat
     * @param float $lon
     * @return Collection<WeatherData>
     */
    public function getLatestByLatLon(float $lat, float $lon): Collection
    {
        return $this->model->newQuery()
            ->where('latitude', $lat)
            ->where('longitude', $lon)
            ->whereDate('timestamp', '>', Carbon::now()->subDay())
            ->get();
    }
}
