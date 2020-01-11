<?php

namespace App\Observers;


use App\Models\SeedExchange;
use App\Models\SeedGeneral;
use App\Models\SeedWeight;
use Illuminate\Support\Facades\Log;

class SeedExchangeObserver
{


    /**
     * Handle the protection "deleted" event.
     *
     * @param SeedExchange $seedExchange
     * @return void
     */
    public function deleting(SeedExchange $seedExchange)
    {
        // weight has changed
        $new_weight = $seedExchange->weight;
        $old_weight = $seedExchange->getOriginal('weight');

        $new_collection_id = $seedExchange->collection_id;
        $old_collection_id = $seedExchange->getOriginal('collection_id');

        $new_specimen_type_id = $seedExchange->specimen_type_id;
        $old_specimen_type_id = $seedExchange->getOriginal('specimen_type_id');

        $new_seed_collection_id = $seedExchange->seed_collection_id;
        $old_seed_collection_id = $seedExchange->getOriginal('seed_collection_id');

        $new_specimen_type = SeedGeneral::withTrashed()->find($new_specimen_type_id)->name;
        if ($old_specimen_type_id) {
            $old_specimen_type = SeedGeneral::withTrashed()->find($old_specimen_type_id)->name;
        }


        if ($old_specimen_type_id) {
            Log::info([
                'new_weight' => $new_weight,
                'old_weight' => $old_weight,
                'new_collection_id' => $new_collection_id,
                'old_collection_id' => $old_collection_id,
                'new_specimen_type_id' => $new_specimen_type_id,
                'old_specimen_type_id' => $old_specimen_type_id,
                'new_seed_collection_id' => $new_seed_collection_id,
                'old_seed_collection_id' => $old_seed_collection_id,
                'new_specimen_type' => $new_specimen_type,
                'old_specimen_type' => $old_specimen_type,
            ]);


                SeedWeight::byCollection($old_collection_id)
                    ->bySeedCollection($old_seed_collection_id)
                    ->increment("total_${old_specimen_type}_weight", $old_weight);
        }
    }

    public function saving(SeedExchange $seedExchange)
    {
        $old_weight = $old_collection_id = $old_specimen_type_id = $old_accession_code = null;

//        if ($seedExchange->isDirty('weight') || $seedExchange->isDirty('collection_id') || $seedExchange->isDirty('specimen_type_id') || $seedExchange->isDirty('accession_code')) {
        // weight has changed
        $new_weight = $seedExchange->weight;
        $old_weight = $seedExchange->getOriginal('weight');

        $new_collection_id = $seedExchange->collection_id;
        $old_collection_id = $seedExchange->getOriginal('collection_id');

        $new_specimen_type_id = $seedExchange->specimen_type_id;
        $old_specimen_type_id = $seedExchange->getOriginal('specimen_type_id');

        $new_seed_collection_id = $seedExchange->seed_collection_id;
        $old_seed_collection_id = $seedExchange->getOriginal('seed_collection_id');

        $new_specimen_type = SeedGeneral::withTrashed()->find($new_specimen_type_id)->name;
        if ($old_specimen_type_id) {
            $old_specimen_type = SeedGeneral::withTrashed()->find($old_specimen_type_id)->name;
        }


        if ($old_specimen_type_id) {
            Log::info([
                'new_weight' => $new_weight,
                'old_weight' => $old_weight,
                'new_collection_id' => $new_collection_id,
                'old_collection_id' => $old_collection_id,
                'new_specimen_type_id' => $new_specimen_type_id,
                'old_specimen_type_id' => $old_specimen_type_id,
                'new_seed_collection_id' => $new_seed_collection_id,
                'old_seed_collection_id' => $old_seed_collection_id,
                'new_specimen_type' => $new_specimen_type,
                'old_specimen_type' => $old_specimen_type,
            ]);
            SeedWeight::byCollection($old_collection_id)
                ->bySeedCollection($old_seed_collection_id)
                ->increment("total_${old_specimen_type}_weight", $old_weight);

        }
        SeedWeight::byCollection($new_collection_id)
            ->bySeedCollection($new_seed_collection_id)
            ->decrement("total_${new_specimen_type}_weight", $new_weight);
//        }

//        if ($seedExchange->isDirty('collection_id')) {
//            // collection has changed
//            $new_collection_id = $seedExchange->collection_id;
//            $old_collection_id = $seedExchange->getOriginal('collection_id');
//
//        }
//
//        if ($seedExchange->isDirty('specimen_type_id')) {
//            // specimen_type has changed
//            $new_specimen_type_id = $seedExchange->specimen_type_id;
//            $old_specimen_type_id = $seedExchange->getOriginal('specimen_type_id');
//
//        }


    }
}
