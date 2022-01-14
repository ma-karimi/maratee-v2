<?php

namespace App\Models;

use App\Models\Contracts\BaseModel;

class SeedMorphologyField extends BaseModel
{
    const Location = [
        "country" => '',
        "provincestate" => '',
        "region" => '',
        "city" => '',
        "villageroad_no_or_name" => '',
        "latitude_degree" => '',
        "latitude_minute" => '',
        "latitude_second" => '',
        "longitude_degree" => '',
        "longitude_minute" => '',
        "longitude_second" => '',
        "altitude_m" => '',
        "gps_used" => false,
        "gps_datum" => '',
    ];
    public static $rules = [
        'name' => 'required|string',
    ];
    protected $casts = ['location' => 'json'];

    public function __construct(array $attributes = array())
    {
        $this->setRawAttributes(
            array(
                'location' => json_encode(self::Location, JSON_THROW_ON_ERROR),
            ), true
        );
        parent::__construct($attributes);
    }
}
