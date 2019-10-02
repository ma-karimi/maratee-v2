<?php


namespace App\Services\Store;


use App\Models\Location;
use League\Geotools\Coordinate\Coordinate;

abstract class BaseStore
{

    protected static $model = null;
    private $data = [];

    public static function store(array $data)
    {
        $service = new static();
        $service->data = $data;
        $location = static::$model::where($service->whereData())->first();
        if ($location instanceof static::$model) {
            return $location;
        }
        return static::$model::create($service->data());
    }

    private function whereData(): array
    {
        $conditions = [];
        foreach ($this->data as $key => $value)
            $conditions[] = [$key, $value];
        return $conditions;
    }

    protected abstract function data(): array;

    public function __get($name)
    {
        return $this->data[$name] ?? null;
    }

    /**
     * @param $input
     * @return mixed
     */
    private function firstLocation($input)
    {
        $coordinate_string = implode(', ', [$input['point'][0], $input['point'][1]]);
        $coordinate = new Coordinate($coordinate_string);
        $p = new \Grimzy\LaravelMysqlSpatial\Types\Point($coordinate->getLatitude(), $coordinate->getLongitude());
        return Location::where('address->fa', $input['address']['fa'])
            ->where('address->en', $input['address']['en'])
            ->when(!empty($input['region_name']['fa']), function ($query) use ($input) {
                return $query->where('region_name->fa', $input['region_name']['fa']);
            })
            ->where('region_name->en', $input['region_name']['en'])
            ->where('city_id', $input['city_id'])
            ->where('village_id', $input['village_id'])
            ->where('min_altitude', $input['min_altitude'])
            ->where('max_altitude', $input['max_altitude'])
            ->equals('point', $p)
            ->first();
    }
}
