<?php


namespace App\Models\Relations;


trait LocationRelation
{

        public function locations()
        {
            return $this->morphToMany(LocationHub::class, 'locationable', 'location_hubs')
                ->whereNull('location_hubs.deleted_at')
                ->withTimestamps();
        }
}
