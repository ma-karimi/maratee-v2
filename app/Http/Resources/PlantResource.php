<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */

    public function toArray($request)
    {
        $plant_family_name = $this->generalFamily->name ?? null;
        $plant_genus_name = $this->generalGenus->name ?? null;
        $plant_specie_name = $this->generalSpecie->name ?? null;
        $plant_sub_specie_name = $this->generalSubSpecie->name ?? null;
        $plant_variety_name = $this->generalVariety->name ?? null;

        return [
            'herbarium'=>HerbariumResource::collection($this->whenLoaded('herbariums')),
            'local_name' => $this->name['fa'] ?? null,
            'plant_sperm' => $this->generalSperm->name ?? null,
            'plant_cotyledon' => $this->generalCotyledon->name ?? null,
            'plant_family' => $plant_family_name,
            'plant_family_actors' => $this->generalFamily->actors ?? null,
            'plant_genus' => $plant_genus_name,
            'plant_genus_actors' => $this->generalGenus->actors ?? null,
            'plant_specie' => $plant_specie_name,
            'plant_specie_actors' => $this->generalSpecie->actors ?? null,
            'plant_sub_specie' => $plant_sub_specie_name,
            'plant_sub_specie_actors' => $this->generalSubSpecie->actors ?? null,
            'plant_variety' => $plant_variety_name,
            'plant_variety_actors' => $this->generalVariety->actors ?? null,
            //scientific_name_must_collect_from_up
            'plant_actors' => AuthorResource::collection($this->actors),
            'plant_collecting_country' => $this->location->city->province->country->name,
            'plant_collecting_province' => $this->location->city->province->name,
            'plant_collecting_city' => $this->location->city->name,
            'plant_collecting_address' => $this->location->address ?? null,
            'plant_collecting_village' => $this->location->village->name ?? null,
            'plant_collecting_region' => $this->location->region_name,
            'plant_collecting_altitude' => $this->location->altitude,
            'plant_collecting_latitude' => $this->location->point->getLat(),
            'plant_collecting_longitude' => $this->location->point->getLng(),
        ];
    }
}
