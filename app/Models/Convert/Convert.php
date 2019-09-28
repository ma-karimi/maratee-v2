<?php

namespace App\Models\Convert;


use App\Models\ActionHub;
use App\Models\Location;
use App\Models\PlantHerbarium;
use App\Models\Taxonomy;

class Convert extends BaseModel
{
    protected $table = 'converts';
    protected $casts = ['collect_actors_id' => 'json', 'detect_actors_id' => 'json'];

    public function taxonomy()
    {
        return Taxonomy::find($this->attributes['taxonomy_id'])->first();
    }

    public function location()
    {
        return Location::find($this->attributes['location_id'])->first();
    }

    public function collectHub()
    {
        return ActionHub::find($this->attributes['collect_actionHub_id']);
    }

    public function detectHub()
    {
        return ActionHub::find($this->attributes['detect_actionHub_id']);
    }

    public function plantHerbarium()
    {
        return PlantHerbarium::find($this->attributes['plant_herbarium_id']);
    }
}
