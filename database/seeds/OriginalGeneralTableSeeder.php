<?php

use App\Models\General;
use Illuminate\Database\Seeder;

class OriginalGeneralTableSeeder extends Seeder
{


    public $phytogeographies = [
        ['fa' => 'ایرانو توران', 'en' => 'Irano-Turanian'],
        ['fa' => 'هیرکانی', 'en' => 'Hyrcanian'],
        ['fa' => 'صحارا سندی', 'en' => 'Sahara-sandia'],
        ['fa' => 'مدیترانه ای', 'en' => 'Mediterranean'],

    ];
    public $habitats = [
        ['fa' => 'جنگل', 'en' => 'Forest'],
        ['fa' => 'مناطق بیابانی', 'en' => 'Rangeland'],
        ['fa' => 'تپه های شنی', 'en' => 'Sandy hills'],
        ['fa' => 'مرتع', 'en' => 'Desert'],

    ];
    public $origins = [
        ['en' => 'Endemic'],
        ['en' => 'Native'],
        ['en' => 'Cultivated'],
        ['en' => 'Commercial imports']

    ];
    public $substrates = [
        ['name' => ['fa' => 'بستر گیاه- گلسنگ', 'en' => 'lichen'], 'type' => 'lichen',
            'children' => [
                ['name' => ['fa' => 'درخت', 'en' => 'Tree'], 'type' => 'substrate'],
                ['name' => ['fa' => 'چوب', 'en' => 'Wood'], 'type' => 'substrate'],
                ['name' => ['fa' => 'سنگ', 'en' => 'Stone'], 'type' => 'substrate'],
                ['name' => ['fa' => 'صخره', 'en' => 'Rock'], 'type' => 'substrate'],
                ['name' => ['fa' => 'خاک', 'en' => 'Soil'], 'type' => 'substrate'],
                ['name' => ['fa' => 'خزه', 'en' => 'Moss'], 'type' => 'substrate'],
                ['name' => ['fa' => 'ابنیه', 'en' => 'Building'], 'type' => 'substrate'],
            ]
        ],
        ['name' => ['fa' => 'بستر گیاه- خزه', 'en' => 'Moss'], 'type' => 'moss',
            'children' => [
                ['name' => ['fa' => 'درخت', 'en' => 'Tree'], 'type' => 'substrate'],
                ['name' => ['fa' => 'خاک', 'en' => 'Soil'], 'type' => 'substrate'],
            ]
        ],
        ['name' => ['fa' => 'زیستگاه جلبک- دیاتومه', 'en' => 'Diatom'], 'type' => 'diatom',
            'children' => [
                ['name' => ['fa' => 'اب شیرین', 'en' => 'Sweet water'], 'type' => 'substrate'],
                ['name' => ['fa' => 'اب شور', 'en' => 'Salty water'], 'type' => 'substrate'],
            ]
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach ($this->getPhytogeographies() as $type) {
            General::create(
                ['name' => ['fa'=>$type['fa'], 'en'=>$type['en']], 'type' => 'phytogeography']
            );
        }
        foreach ($this->getOrigins() as $type) {
            General::create(
                ['name' => $type, 'type' => 'origin']
            );
        }
        foreach ($this->getHabitats() as $type) {
            General::create(
                ['name' => $type, 'type' => 'habitat']
            );
        }
        foreach ($this->getSubstrates() as $type) {
            $general = General::create(
                ['name' => $type['name'], 'type' => $type['type']]
            );
            foreach ($type['children'] as $chid){
                General::create(
                    ['name' => $chid['name'], 'type' => $chid['type'], 'parent_id'=>$general->id]
                );
            }
        }

    }

    /**
     * @return array
     */
    public function getPhytogeographies(): array
    {
        return $this->phytogeographies;
    }

    /**
     * @return array
     */
    public function getOrigins(): array
    {
        return $this->origins;
    }

    /**
     * @return array
     */
    public function getHabitats(): array
    {
        return $this->habitats;
    }

    /**
     * @return array
     */
    public function getSubstrates(): array
    {
        return $this->substrates;
    }
}
