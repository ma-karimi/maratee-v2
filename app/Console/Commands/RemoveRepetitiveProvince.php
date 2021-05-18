<?php

namespace App\Console\Commands;

use App\Models\Location;
use App\Models\Province;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

/**
 * Class RemoveRepetitiveProvince
 * @package App\Console\Commands
 *
 * @author Faeze Eghlima
 */
class RemoveRepetitiveProvince extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'RemoveRepetitiveProvince';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command find repetitive province and remove them';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     * This function get repetitive province and delete them and replace that province has minimum id in location and city
     * @return mixed
     */
    public function handle()
    {
        $provinces = DB::table('provinces')
                            ->select('name_en', (DB::raw('COUNT(name_en), group_concat(id), min(id)')))
                            ->groupBy('name_en')
                            ->havingRaw('COUNT(name_en) > 1')
                            ->get();

        foreach ($provinces as $province)
        {
            $provincIdies  = explode(",", $province->{"group_concat(id)"});

            DB::table('locations')->whereIn('province_id', $provincIdies)->update(['province_id' => $province->{"min(id)"}]);
            DB::table('cities')->whereIn('province_id', $provincIdies)->update(['province_id' => $province->{"min(id)"}]);

            if (($key = array_search($province->{"min(id)"}, $provincIdies)) !== false)
            {
                unset($provincIdies[$key]);
            }

            DB::table('provinces')->whereIn('id', $provincIdies)->delete();
        }
    }
}
