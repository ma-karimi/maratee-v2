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

    private $location = [];

    protected function data(): array
    {
        $this->location['country'] = $this->getCountry();
        $this->location['province'] = $this->getProvince();
        $this->location['city'] = $this->getCity();
        $this->location['village'] = $this->getVillage();
        $data['city_id'] = $this->location['city']->id;
        $data['village'] = $this->location['village'];
        $data['address'] = $this->address;
        if($this->hasPoint())
            $data['point'] = $this->pointData();
        if(!empty($this->min_altitude))
            $data['min_altitude'] = $this->min_altitude;
        if(!empty($this->max_altitude))
            $data['max_altitude'] = $this->max_altitude;
        return $data;
    }

    private function getCountry(): Country
    {
        return $this->getModel(Country::class, $this->countryData());
    }

    private function countryData(): array
    {
        return [
            'name' => $this->country,
        ];
    }

    private function getProvince(): Province
    {
        return $this->getModel(Province::class, $this->provinceData());
    }

    private function provinceData(): array
    {
        return [
            'name' => $this->province,
            'country_id' => $this->location['country']->id,
        ];
    }

    private function getCity(): City
    {
        return $this->getModel(City::class, $this->cityData());
    }

    private function cityData(): array
    {
        return [
            'name' => $this->city,
            'province_id' => $this->location['province']->id,
        ];
    }

    private function getVillage(): Village
    {
        return $this->getModel(Village::class, $this->villageData());
    }

    private function villageData(): array
    {
        return [
            'name' => $this->village,
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
