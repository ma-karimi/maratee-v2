<?php

use App\Models\General;
use App\Models\Propagation;
use Illuminate\Database\Seeder;

class OriginalPropagationTableSeeder extends Seeder
{


    public $propagations = [
        ['fa' => 'بذر', 'en' => 'Seed'],
        ['fa' => 'قلمه', 'en' => 'Cutting'],
        ['fa' => 'پیوند', 'en' => 'Graft'],
        ['fa' => 'تجدید حیات طبیعی', 'en' => 'Natural regeneration'],
        ['fa' => 'پاجوش', 'en' => 'Root sucker'],
        ['fa' => 'جوانه زدن', 'en' => 'Collar sprout'],

    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach ($this->getPropagations() as $type) {
            Propagation::create(
                ['method' => ['fa'=>$type['fa'], 'en'=>$type['en']]]
            );
        }

    }

    /**
     * @return array
     */
    public function getPropagations(): array
    {
        return $this->propagations;
    }

}
