<?php

namespace App\Models\Relations;

use App\Models\Location;


trait LocationRelations
{

    public function locations()
    {
        return $this->morphToMany(Location::class, 'locationable', 'location_hubs')
            ->whereNull('location_hubs.deleted_at')
            ->withTimestamps();
    }
}
