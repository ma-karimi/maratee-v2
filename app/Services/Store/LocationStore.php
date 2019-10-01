<?php


namespace App\Services\Store;


use App\Models\City;
use App\Models\Country;
use App\Models\Location;
use App\Models\Province;
use App\Models\Village;

class LocationStore extends BaseStore
{

    protected static $model = Location::class;

    protected function data(): array
    {
        $data = [
            'city_id' => City::firstOrCreate($this->cityData())->id,
            'village_id' => Village::firstOrCreate($this->villageData())->id,
            'address' => $this->address,
            'min_altitude' => $this->min_altitude,
            'max_altitude' => $this->max_altitude,
        ];
        if ($this->hasPoint())
            $data['point'] = $this->pointData();
        return $data;
    }

    private function villageData(): array
    {
        return [
            'name' => json_encode($this->village),
        ];
    }

    private function cityData(): array
    {
        return [
            'name' => json_encode($this->city),
            'province_id' => Province::firstOrCreate($this->provinceData())->id,
        ];
    }

    private function provinceData(): array
    {
        return [
            'name' => json_encode($this->province),
            'country_id' => Country::firstOrCreate($this->countryData())->id,
        ];
    }

    private function countryData(): array
    {
        return [
            'name' => json_encode($this->country),
        ];
    }

    private function pointData(): array
    {
        return [
            $this->lat, $this->long
        ];
    }

    private function hasPoint(): bool
    {
        return !empty($this->lat) && !empty($this->long);
    }

}
