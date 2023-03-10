<?php

namespace App\Domain\Weather\Console;

use App\Domain\Weather\Repositories\EloquentCityRepository;
use App\Domain\Weather\Repositories\EloquentWeatherDataRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

/**
 * Class GetWeatherData
 * @package App\Domain\Weather\Console
 */
class GetWeatherData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:weather_data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        parent::__construct();
        $this->weatherDataRepository = $weatherDataRepository;
        $this->cityRepository = $cityRepository;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $cities = $this->cityRepository->all();

        foreach ($cities as $city) {
            $response = Http::get(
                'https://api.openweathermap.org/data/2.5/weather?lat=' . $city->latitude . '&lon=' . $city->longitude . '&appid='
                . env('OPEN_WEATHER_API_KEY') . '&units=metric'
            );

            $data = $response->json();

            $this->weatherDataRepository->create(
                [
                    'timestamp'       => $data['dt'],
                    'name'            => $data['name'],
                    'latitude'        => $city->latitude,
                    'longitude'       => $city->longitude,
                    'temperature'     => $data['main']['temp'],
                    'pressure'        => $data['main']['pressure'],
                    'humidity'        => $data['main']['humidity'],
                    'min_temperature' => $data['main']['temp_min'],
                    'max_temperature' => $data['main']['temp_max'],
                ]
            );
        }

        return Command::SUCCESS;
    }
}
