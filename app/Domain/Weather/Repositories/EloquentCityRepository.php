<?php

namespace App\Domain\Weather\Repositories;

use App\Domain\Core\Repositories\AbstractEloquentModelRepository;
use App\Domain\Weather\Models\City;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use JetBrains\PhpStorm\Pure;

/**
 * Class EloquentCityRepository
 * @package App\Domain\Weather\Repositories
 *
 * @method City create(array $data)
 * @method City update(City $city, array $data)
 * @method bool delete(City $city)
 * @method Collection<City> all()
 * @method Collection<City>|LengthAwarePaginator<City> filter(array $filters, bool $paginated)
 * @method City|null findByFields(array $where)
 * @method Collection<City> getByFields(array $where)
 */
class EloquentCityRepository extends AbstractEloquentModelRepository
{
    /**
     * @param City $city
     */
    #[Pure] public function __construct(City $city)
    {
        parent::__construct($city);
    }
}
