<?php

use App\Models\SeedGeneral;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OriginalBotanicalGeneralTableSeeder extends Seeder
{

    public const USAGE = [1 => 'medicinal', 2 => 'ground cover', 3 => 'hedge', 4 => 'ornamental', 5 => 'industrial'];
    public const VALUE = [1 => 'Shape', 2 => 'Bark', 3 => 'leaves', 4 => 'autumn color', 5 => 'flower'];
    public const PROPAGATION = [1 => 'seed', 2 => 'cutting', 3 => 'graft', 4 => 'natural regeneration', 5 => 'root sucker', 6 => 'collar sprout'];

    public const PLANT_CONDITION = [1 => 'full sun', 2 => 'light shade', 3 => 'moderate shade', 4 => 'deep shade', 5 => 'greenhouse', 6 => 'fancing N', 7 => 'fancing W', 8 => 'fancing S', 9 => 'fancing E'];

    public const CYCLE = [1 => 'evergreen', 2 => 'deciduous', 3 => 'semi deciduous', 4 => 'annual climber', 5 => 'perennial climber', 6 => 'annual herb', 7 => 'biennial herb', 8 => 'perennial herb', 9 => 'bulb', 10 => 'tuber', 11 => 'rhizome', 12 => 'water plant'];
    public const COLOR = 'white-cream-yellow-orange-pink-red-purple-lilac-blue-green-brown-black-blue green-yellowish-silvery-grey-variegated-glossy';

    public const GROWTH_RATES = [1 => 'very low', 2 => 'low', 3 => 'moderate', 4 => 'fast', 5 => 'very fast'];
    public const SEED_RATE = [1 => 'low', 2 => 'moderate', 3 => 'good', 4 => 'bumper'];
    public const WINTER_TOLERANCE = [1 => 'good', 2 => 'moderate', 3 => 'sensitive', 4 => 'protection', 5 => 'not surviving', 6 => 'minimum temperature'];
    public const SUMMER_TOLERANCE = [1 => 'good', 2 => 'moderate', 3 => 'sensitive', 4 => 'protection', 5 => 'not surviving'];

    public const ENTRANCE_TO_GARDEN = [1 => 'seedling', 2 => 'plant', 3 => 'bulb', 4 => 'bulbil', 5 => 'tuber', 6 => 'rhizome', 7 => 'softwood cutting', 8 => 'hardwood cutting', 9 => 'root cutting', 10 => 'graft-division', 11 => 'meristem', 12 => 'spore'];
    public const SOIL = [1 => 'neutral', 2 => 'alkaline', 3 => 'acid', 4 => 'indifferent'];
    public const WOODEN = [1 => 'Tree', 2 => 'Shrub'];
    public const SEED_GERMINATION = [1 => 'good', 2 => 'moderate', 3 => 'low', 4 => 'none'];
    public const SOIL_TYPE = 'clay soil-loam-fine sand-coarse sand-gravel-shale-salt-gypsum-forest soil-peat-compost-manure-bone powder';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::CYCLE as $index => $item) {
            \App\Models\BotanicalGeneral::create([
                'type_id' => 5,
                'name' => $item
            ]);
        }

        foreach (self::USAGE as $index => $item) {
            \App\Models\BotanicalGeneral::create([
                'type_id' => 2,
                'name' => $item
            ]);
        }

        foreach (self::PLANT_CONDITION as $index => $item) {
            \App\Models\BotanicalGeneral::create([
                'type_id' => 4,
                'name' => $item
            ]);
        }

        foreach (self::PROPAGATION as $index => $item) {
            \App\Models\BotanicalGeneral::create([
                'type_id' => 3,
                'name' => $item
            ]);
        }

        foreach (self::VALUE as $index => $item) {
            \App\Models\BotanicalGeneral::create([
                'type_id' => 1,
                'name' => $item
            ]);
        }


        foreach (explode('-', self::COLOR) as $index => $item) {
            \App\Models\BotanicalGeneral::create([
                'type_id' => 6,
                'name' => $item
            ]);
        }
        foreach (self::GROWTH_RATES as $index => $item) {
            \App\Models\BotanicalGeneral::create([
                'type_id' => 8,
                'name' => $item
            ]);
        }
        foreach (self::SEED_RATE as $index => $item) {
            \App\Models\BotanicalGeneral::create([
                'type_id' => 9,
                'name' => $item
            ]);
        }
        foreach (self::WINTER_TOLERANCE as $index => $item) {
            \App\Models\BotanicalGeneral::create([
                'type_id' => 10,
                'name' => $item
            ]);
        }
        foreach (self::SUMMER_TOLERANCE as $index => $item) {
            \App\Models\BotanicalGeneral::create([
                'type_id' => 11,
                'name' => $item
            ]);
        }
        foreach (self::ENTRANCE_TO_GARDEN as $index => $item) {
            \App\Models\BotanicalGeneral::create([
                'type_id' => 12,
                'name' => $item
            ]);
        }
        foreach (self::SOIL as $index => $item) {
            \App\Models\BotanicalGeneral::create([
                'type_id' => 13,
                'name' => $item
            ]);
        }
        foreach (self::WOODEN as $index => $item) {
            \App\Models\BotanicalGeneral::create([
                'type_id' => 14,
                'name' => $item
            ]);
        }
        foreach (self::SEED_GERMINATION as $index => $item) {
            \App\Models\BotanicalGeneral::create([
                'type_id' => 15,
                'name' => $item
            ]);
        }

        foreach (explode('-', self::SOIL_TYPE) as $item) {
            \App\Models\BotanicalGeneral::firstOrCreate([
                'type_id' => 17,
                'name' => $item
            ]);
        }
    }
}
