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
            'plant_family_authors' => $this->generalFamily->authors ?? null,
            'plant_genus' => $plant_genus_name,
            'plant_genus_authors' => $this->generalGenus->authors ?? null,
            'plant_specie' => $plant_specie_name,
            'plant_specie_authors' => $this->generalSpecie->authors ?? null,
            'plant_sub_specie' => $plant_sub_specie_name,
            'plant_sub_specie_authors' => $this->generalSubSpecie->authors ?? null,
            'plant_variety' => $plant_variety_name,
            'plant_variety_authors' => $this->generalVariety->authors ?? null,
            //scientific_name_must_collect_from_up
            'plant_authors' => AuthorResource::collection($this->authors),
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
