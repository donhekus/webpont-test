<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weather_data', function (Blueprint $table) {
            $table->id();
            $table->timestamp('timestamp');
            $table->string('name');
            $table->float('latitude');
            $table->float('longitude');
            $table->float('temperature');
            $table->integer('pressure');
            $table->integer('humidity');
            $table->float('min_temperature');
            $table->float('max_temperature');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weather_data');
    }
};
