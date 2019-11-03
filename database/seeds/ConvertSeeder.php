<?php

use App\Models\Country;
use Illuminate\Database\Seeder;
use App\Models\Convert\Treeleaf;
use App\Services\ConvertService;

class ConvertSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @param int $start
     * @param null $limit
     * @return string
     */
    public static function run($start = 0, $limit = null)
    {
        Country::create([
            'name_en'=> 'Iran', 'name_fa' => 'ایران'
        ]);
        Treeleaf::where('id',  3771)
            ->when($limit, function ($query) use ($limit) {
                return $query->limit($limit);
            })
            ->get()->each(function ($treeLeaf) {
                (new ConvertService($treeLeaf))->handle();
            });

        return 'done';
    }
}
