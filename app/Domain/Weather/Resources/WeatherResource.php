<?php

namespace App\Domain\Weather\Resources;

use App\Domain\Weather\Models\WeatherData;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

/**
 * Class WeatherResource
 * @package App\Domain\Weather\Resources
 * @mixin WeatherData
 */
class WeatherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array
    {
        return [
            'timestamp'       => $this->timestamp,
            'name'            => $this->name,
            'latitude'        => $this->latitude,
            'longitude'       => $this->longitude,
            'temperature'     => $this->temperature,
            'pressure'        => $this->pressure,
            'humidity'        => $this->humidity,
            'min_temperature' => $this->min_temperature,
            'max_temperature' => $this->max_temperature,
        ];
    }
}
