<?php

namespace App\Domain\Weather\Controllers;

use App\Domain\Weather\Requests\CityRequest;
use App\Domain\Weather\Resources\WeatherResource;
use App\Domain\Weather\Services\WeatherDataService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class OrderController
 * @package App\Domain\Finances\Controllers
 */
class WeatherController extends Controller
{
    /**
     * @var WeatherDataService
     */
    private WeatherDataService $weatherDataService;

    /**
     * @param WeatherDataService $weatherDataService
     */
    public function __construct(WeatherDataService $weatherDataService)
    {
        $this->weatherDataService = $weatherDataService;
    }

    /**
     * @return AnonymousResourceCollection<WeatherResource>
     */
    public function getAll(): AnonymousResourceCollection
    {
        return $this->weatherDataService->getAll();
    }

    /**
     * @param CityRequest $request
     * @return AnonymousResourceCollection
     */
    public function getByCity(CityRequest $request): AnonymousResourceCollection
    {
        return $this->weatherDataService->getByCity($request->validated('name'));
    }
}
