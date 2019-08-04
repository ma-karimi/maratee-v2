<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BotanicalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $plant_family_name = $this->herbarium->plant->generalFamily->name ?? null;
        $plant_genus_name = $this->herbarium->plant->generalGenus->name ?? null;
        $plant_specie_name = $this->herbarium->plant->generalSpecie->name ?? null;
        $plant_sub_specie_name = $this->herbarium->plant->generalSubSpecie->name ?? null;
        $plant_variety_name = $this->herbarium->plant->generalVariety->name ?? null;
        return [
            'id'=>$this->id,
            'herbarium_id' => $this->herbarium->id,
            'scientific_name' => [
                'plant_family' => $plant_family_name,
                'plant_family_authors' => $this->herbarium->plant->generalFamily->authors ?? null,
                'plant_genus' => $plant_genus_name,
                'plant_genus_authors' => $this->herbarium->plant->generalGenus->authors ?? null,
                'plant_specie' => $plant_specie_name,
                'plant_specie_authors' => $this->herbarium->plant->generalSpecie->authors ?? null,
                'plant_sub_specie' => $plant_sub_specie_name,
                'plant_sub_specie_authors' => $this->herbarium->plant->generalSubSpecie->authors ?? null,
                'plant_variety' => $plant_variety_name,
                'plant_variety_authors' => $this->herbarium->plant->generalVariety->authors ?? null,
            ],
            'family' => $this->herbarium->plant->generalFamily->name,
            'local_name' => $this->herbarium->plant->domestic_name,
            'phytogeography_origin' => $this->herbarium->generalPhytogeography->name,
            'habitat' => 'NOT IMPLEMENT',
            'ecology' => 'NOT IMPLEMENT',
            'plant_type' => $this->herbarium->generalType->name,
            'growth' => 'NOT IMPLEMENT',
            'protection' => $this->herbarium->protection->name,
            'height' => $this->height,
            'part' => 'NOT IMPLEMENT',
            'usage' => 'NOT IMPLEMENT',
            'application' => 'NOT IMPLEMENT',
            'industry' => 'NOT IMPLEMENT',
            'flower_color' => $this->flower_color,
            'fruit_color' => $this->fruit_color,
            'leaf_color' => $this->leaf_color,
            'entrance_form' => EntryHubResource::collection($this->entryHubs),
            'seed_germination' => $this->sprout,
            'propagation_methods' => BotanicalReproductionResource::collection($this->botanicalReproductions),
            'planting_date' => $this->planting,
            'cutting_rooting_percentage' => $this->scion_rooting_per,
            'treatment' => $this->treatment,
            'growth_rate' => $this->growth_rate,
            'first_flowering' => $this->first_flowering,
            'first_period' => $this->flowering_interval,
            'first_seeding' => $this->first_seeding,
            'seed_production' => $this->seed_production,
            'seed_rate' => $this->seed_value,
            'winter_tolerance' => $this->season_resistance['winter'] ?? null,
            'summer_tolerance' => $this->season_resistance['summer'] ?? null,
            'irrigation_method' => $this->irrigation->pluck('type'),
            'summer_irrigation' => $this->botanicalIrrigations->pluck('seasonal_feature.summer'),
            'spring_irrigation' => $this->botanicalIrrigations->pluck('seasonal_feature.spring'),
            'autumn_irrigation' => $this->botanicalIrrigations->pluck('seasonal_feature.autumn'),
            'water_requirement' => $this->botanicalIrrigations->pluck('requirement'),
            'appropriate_irrigation_time' => $this->botanicalIrrigations->pluck('daytime'),
            'sensitivity' => $this->sensitivity,
            'sensitivity_description' => $this->sensitivity_description,
            'year' => $this->year,
            'media' => $this->herbarium->medias->pluck('name'),
            'comments' => $this->notes,
            'planting_action' => $this->planting_actions->pluck('name'),
            'initial_soil' => $this->soil_from->pluck('type'),
            'initial_lighting' => $this->lighting_from->pluck('type'),
            'initial_place_type' => $this->botanicalGardenActions->pluck('initial_place_type'),
            'initial_condition' => $this->botanicalGardenActions->pluck('initial_place_condition'),
            'transfer_date' => $this->botanicalGardenActions->pluck('date'),
            'destination_soil' =>  $this->soil_to->pluck('type'),
            'destination_lighting' =>  $this->lighting_to->pluck('type'),
            'destination_place_type' => $this->botanicalGardenActions->pluck('destination_place_type'),
            'destination_condition' => $this->botanicalGardenActions->pluck('destination_place_condition'),
            'botanical_treatment' => $this->botanicalGardenActions->pluck('treatment'),
        ];
    }
}
