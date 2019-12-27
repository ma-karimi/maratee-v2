<?php

use App\Models\SeedGeneral;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OriginalSeedGeneralTableSeeder extends Seeder
{

    public $landforms = ['Mountain',
        'Hill',
        'plateaus',
        'Piedmont plain',
        'River alluvial plain',
        'Lowland',
        'Floodplain',
        'Colluvial alluvial fan',
        'Gravelly alluvial fan',
        'Mixed or complex land',
        'Miscellaneous lands'
    ];
    public $slope_aspects = ['N',
        'N-E',
        'E',
        'S-E',
        'S',
        'S-W',
        'W',
        'N-W'
    ];
    public $soil_depths = ['Non soil',
        'Less than plowing depth',
        'Plowing depth (20-30 cm)',
        'Deep plowing (more than 50 cm)',
        'Deep'

    ];
    public $soil_textures = ['Very light', 'Light', 'Medium', 'Very heavy'

    ];
    public $drainages = ['Very Poor', 'Moderately well', 'Well', 'Excessively'

    ];
    public $salinities = ['Non saline',
        'Low salinity',
        'Medium salinity',
        'High salinity',
        'Very high salinity'
    ];
    public $soil_limes = ['Slightly effervescent',
        'Strongly effervescent',
        'Violently effervescent'

    ];
    public $soil_erosions = ['Wind', 'Sheet', 'Rill', 'Gully', 'Mass'];
    public $pollination_types = ['Direct', 'Indirect'];
    public $pollination_agents = ['Water', 'Insects', 'Animals', 'Wind'];
    public $fruit_types = ['Berry', 'Drupe', 'Follicle', 'Pod', 'Silic', 'Loculicidal', 'Achene', 'Samara', 'Caryopsis', 'Accessory fruit', 'Multiple fruit'];
    public $collected_from = ['Plant', 'Ground'];
    public $life_forms = ['Annual', 'Biennials', 'Polycarpic  perennial', 'Monocarpic prennial'];
    public $growth_forms = ['Tree', 'Shrub', 'Subshrub', 'Herbaceous'];
    public $mother_healths = ['Healthy', 'Unhealthy'];
    public $consumptions = ['Forage', 'Food', 'Medicinal', 'Other'];
    public $used_parts = ['Leaf', 'Stem', 'Flower', 'Fruit', 'Seed', 'Root', 'Tuber', 'Rhizome', 'Secondary plant products'];
    public $specimen_types = ['Entrance seed technology test', 'Seed in Active Collection', 'Fruit in Active Collection', 'Seed in Base Collection', 'Fruit in Base Collection', 'Seed in Duplicate Collection', 'Fruit in Duplicate Collection', 'Regenerated seed in Active Collection', 'Regenerated fruit in Active Collection', 'Regenerated seed in Base Collection', 'Regenerated fruit in Base Collection', 'Regenerated seed in Duplicate Collection', 'Regenerated  fruit in Duplicate Collection'
    ];

    /**da
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->landforms as $item) {
            SeedGeneral::create([
                'name' => Str::ucfirst($item),
                'type_id' => 2
            ]);
        }
        foreach ($this->slope_aspects as $item) {
            SeedGeneral::create([
                'name' => Str::ucfirst($item),
                'type_id' => 3
            ]);
        }
        foreach ($this->soil_depths as $item) {
            SeedGeneral::create([
                'name' => Str::ucfirst($item),
                'type_id' => 4
            ]);
        }
        foreach ($this->soil_textures as $item) {
            SeedGeneral::create([
                'name' => Str::ucfirst($item),
                'type_id' => 5
            ]);
        }
        foreach ($this->drainages as $item) {
            SeedGeneral::create([
                'name' => Str::ucfirst($item),
                'type_id' => 6
            ]);
        }
        foreach ($this->salinities as $item) {
            SeedGeneral::create([
                'name' => Str::ucfirst($item),
                'type_id' => 7
            ]);
        }
        foreach ($this->soil_limes as $item) {
            SeedGeneral::create([
                'name' => Str::ucfirst($item),
                'type_id' => 8
            ]);
        }
        foreach ($this->soil_erosions as $item) {
            SeedGeneral::create([
                'name' => Str::ucfirst($item),
                'type_id' => 9
            ]);
        }
        foreach ($this->pollination_types as $item) {
            SeedGeneral::create([
                'name' => Str::ucfirst($item),
                'type_id' => 10
            ]);
        }
        foreach ($this->pollination_agents as $item) {
            SeedGeneral::create([
                'name' => Str::ucfirst($item),
                'type_id' => 11
            ]);
        }
        foreach ($this->fruit_types as $item) {
            SeedGeneral::create([
                'name' => Str::ucfirst($item),
                'type_id' => 12
            ]);
        }
        foreach ($this->collected_from as $item) {
            SeedGeneral::create([
                'name' => Str::ucfirst($item),
                'type_id' => 13
            ]);
        }
        foreach ($this->life_forms as $item) {
            SeedGeneral::create([
                'name' => Str::ucfirst($item),
                'type_id' => 14
            ]);
        }
        foreach ($this->growth_forms as $item) {
            SeedGeneral::create([
                'name' => Str::ucfirst($item),
                'type_id' => 15
            ]);
        }
        foreach ($this->growth_forms as $item) {
            SeedGeneral::create([
                'name' => Str::ucfirst($item),
                'type_id' => 15
            ]);
        }
        foreach ($this->mother_healths as $item) {
            SeedGeneral::create([
                'name' => Str::ucfirst($item),
                'type_id' => 16
            ]);
        }
        foreach ($this->consumptions as $item) {
            SeedGeneral::create([
                'name' => Str::ucfirst($item),
                'type_id' => 17
            ]);
        }
        foreach ($this->used_parts as $item) {
            SeedGeneral::create([
                'name' => Str::ucfirst($item),
                'type_id' => 18
            ]);
        }
        foreach ($this->specimen_types as $item) {
            SeedGeneral::create([
                'name' => Str::ucfirst($item),
                'type_id' => 1
            ]);
        }
    }
}
