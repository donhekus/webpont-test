<?php

namespace App\Domain\Weather\Services;

use App\Domain\Weather\Repositories\EloquentCityRepository;
use App\Domain\Weather\Repositories\EloquentWeatherDataRepository;
use App\Domain\Weather\Resources\CityResource;
use App\Domain\Weather\Resources\WeatherResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class WeatherDataService
 * @package App\Domain\Weather\Services
 */
class WeatherDataService
{
    /**
     * @var EloquentWeatherDataRepository
     */
    private EloquentWeatherDataRepository $weatherDataRepository;
    /**
     * @var EloquentCityRepository
     */
    private EloquentCityRepository $cityRepository;

    /**
     * @param EloquentWeatherDataRepository $weatherDataRepository
     * @param EloquentCityRepository        $cityRepository
     */
    public function __construct(
        EloquentWeatherDataRepository $weatherDataRepository,
        EloquentCityRepository        $cityRepository
    ) {
        $this->weatherDataRepository = $weatherDataRepository;
        $this->cityRepository = $cityRepository;
    }

    /**
     * @return AnonymousResourceCollection<WeatherResource>
     */
    public function getAll(): AnonymousResourceCollection
    {
        return WeatherResource::collection($this->weatherDataRepository->all());
    }

    /**
     * @param string $name
     * @return AnonymousResourceCollection<WeatherResource>
     */
    public function getByCity(string $name): AnonymousResourceCollection
    {
        $city = $this->cityRepository->findByFields(['name' => $name]);

        return WeatherResource::collection($this->weatherDataRepository->getLatestByLatLon($city->latitude, $city->longitude));
    }
}
