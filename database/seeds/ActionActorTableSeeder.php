<?php

use App\Models\ActorHub;
use Illuminate\Database\Seeder;

class ActionActorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ini_set('max_execution_time', 3000);
        ini_set('memory_limit', '2000M');
        \App\Models\Herbarium::all()->each(function ($query) {

            if (!empty($query->collect->date)) {
                $query->collection_date = $query->collect->date ?? null;
            }
            if (!empty($query->determine->date)) {
                $query->determine_date = $query->determine->date ?? null;
            }

            foreach (collect($query->determine->actors->pluck('id')->toArray())->filter()->all() as $item) {
                \App\Models\ActionActor::create([
                    'actorable_type' => \App\Models\Herbarium::class,
                    'actor_id'=>$item,
                    'actorable_id' => $query->id,
                    'type_id' => 1
                ]);
            }
            foreach (collect($query->collect->actors->pluck('id')->toArray())->filter()->all() as $item) {
                \App\Models\ActionActor::create([
                    'actorable_type' => \App\Models\Herbarium::class,
                    'actor_id'=>$item,
                    'actorable_id' => $query->id,
                    'type_id' => 2
                ]);
            }

            $query->save();
            echo "$query->id\n";

        });
        $actions = \App\Models\ActionHub::where('actionable_type', \App\Models\Herbarium::class)->get();

        ActorHub::where('actorable_type', \App\Models\ActionHub::class)->whereIn('actorable_id', $actions->pluck('id')->toArray())->delete();

        foreach ($actions as $index => $action) {
            $action->delete();
        }

    }
}
