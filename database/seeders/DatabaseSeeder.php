<?php

namespace Database\Seeders;

use App\Domain\Weather\Models\City;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        City::factory(20)->create();
    }
}
