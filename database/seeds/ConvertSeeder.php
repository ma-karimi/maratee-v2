<?php

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
     * @return void
     */
    public function run($start = 0, $limit = null)
    {

        Treeleaf::where('id', '>', $start)
            ->when($limit, function ($query) use ($limit) {
                return $query->limit($limit);
            })
            ->get()->each(function ($treeLeaf) {
                (new ConvertService($treeLeaf))->handle();
            });
    }
}
