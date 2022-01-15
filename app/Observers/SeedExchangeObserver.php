<?php

namespace App\Observers;


use App\Models\SeedExchange;
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
        $seedWeight = SeedWeight::find($seedExchange->seed_weight_id);
        Log::info($seedWeight);
        $seedWeight->increment($seedExchange->type, $seedExchange->exchanged_weight);
        Log::info([$seedExchange->type, $seedExchange->exchanged_weight]);
    }

}
