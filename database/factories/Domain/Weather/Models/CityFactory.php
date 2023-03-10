<?php

namespace database\factories\Domain\Weather\Models;

use App\Domain\Weather\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends Factory<City>
 */
class CityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<Model|City>
     */
    protected $model = City::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'      => $this->faker->city,
            'latitude'  => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
        ];
    }
}
