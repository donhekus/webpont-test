<?php

namespace App\Domain\Weather\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class WeatherServiceProvider
 * @package App\Domain\Weather\Providers
 */
class WeatherServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->loadRoutesFrom(base_path() . '/app/Domain/Weather/Routes/api.php');
        $this->loadMigrationsFrom(base_path() . '/app/Domain/Weather/Migrations/');
    }
}
