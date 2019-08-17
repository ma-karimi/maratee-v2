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
    public $origins = [
        ['fa' => 'جنگل', 'en' => 'Forest'],
        ['fa' => 'مناطق بیابانی', 'en' => 'Rangeland'],
        ['fa' => 'مرتع', 'en' => 'Desert'],

    ];
    public $habitats = [
        ['name' => ['fa' => 'بستر گیاه- گلسنگ', 'en' => 'Substrate of Lichen'], 'type' => 'habitat',
            'children' => [
                ['name' => ['fa' => 'درخت', 'en' => 'Tree'], 'type' => 'ecology'],
                ['name' => ['fa' => 'چوب', 'en' => 'Wood'], 'type' => 'ecology'],
                ['name' => ['fa' => 'سنگ', 'en' => 'Stone'], 'type' => 'ecology'],
                ['name' => ['fa' => 'صخره', 'en' => 'Rock'], 'type' => 'ecology'],
                ['name' => ['fa' => 'خاک', 'en' => 'Soil'], 'type' => 'ecology'],
                ['name' => ['fa' => 'خزه', 'en' => 'Moss'], 'type' => 'ecology'],
                ['name' => ['fa' => 'ابنیه', 'en' => 'Building'], 'type' => 'ecology'],
            ]
        ],
        ['name' => ['fa' => 'بستر گیاه- خزه', 'en' => 'Substrate of Moss'], 'type' => 'habitat',
            'children' => [
                ['name' => ['fa' => 'درخت', 'en' => 'Tree'], 'type' => 'ecology'],
                ['name' => ['fa' => 'خاک', 'en' => 'Soil'], 'type' => 'ecology'],
            ]
        ],
        ['name' => ['fa' => 'زیستگاه جلبک- دیاتومه', 'en' => 'Substrate of Diatom'], 'type' => 'habitat',
            'children' => [
                ['name' => ['fa' => 'اب شیرین', 'en' => 'Sweet water'], 'type' => 'ecology'],
                ['name' => ['fa' => 'اب شور', 'en' => 'Salty water'], 'type' => 'ecology'],
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
                ['name' => ['fa'=>$type['fa'], 'en'=>$type['en']], 'description' => make_json('qqqq'), 'type' => 'phytogeography']
            );
        }
        foreach ($this->getOrigins() as $type) {
            General::create(
                ['name' => ['fa'=>$type['fa'], 'en'=>$type['en']], 'description' => make_json('qqqq'), 'type' => 'origin']
            );
        }
        foreach ($this->getHabitats() as $type) {
            $general = General::create(
                ['name' => $type['name'], 'description' => make_json('qqqq'), 'type' => $type['type']]
            );
            foreach ($type['children'] as $chid){
                General::create(
                    ['name' => $chid['name'], 'description' => make_json('qqqq'), 'type' => $chid['type'], 'parent_id'=>$general->id]
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
}
