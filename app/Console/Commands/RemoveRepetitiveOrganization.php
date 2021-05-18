<?php


namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

/**
 * Class RemoveRepetitiveOrganization
 * @package App\Console\Commands
 *
 * @author Faeze Eghlima
 */
class RemoveRepetitiveOrganization extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'RemoveRepetitiveOrganization';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command find repetitive organization and remove them';

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
     * This function get repetitive organization and delete them and replace that organization has minimum id in transaction table
     * @return mixed
     */
    public function handle()
    {
        $organizations = DB::table('organizations')
            ->select('name_en', (DB::raw('COUNT(name_en), group_concat(id), min(id)')))
            ->groupBy('name_en')
            ->havingRaw('COUNT(name_en) > 1')
            ->get();

        foreach ($organizations as $organization)
        {
            $organizationIdies  = explode(",", $organization->{"group_concat(id)"});

            DB::table('transactions')->whereIn('organization_id', $organizationIdies)->update(['organization_id' => $organization->{"min(id)"}]);
            DB::table('herbariums')->whereIn('organization_id', $organizationIdies)->update(['organization_id' => $organization->{"min(id)"}]);
            DB::table('seed_collections')->whereIn('organization_id', $organizationIdies)->update(['organization_id' => $organization->{"min(id)"}]);
            DB::table('seed_morphologies')->whereIn('organization_id', $organizationIdies)->update(['organization_id' => $organization->{"min(id)"}]);
            DB::table('seed_exchanges')->whereIn('organization_id', $organizationIdies)->update(['organization_id' => $organization->{"min(id)"}]);

            if (($key = array_search($organization->{"min(id)"}, $organizationIdies)) !== false)
            {
                unset($organizationIdies[$key]);
            }

            DB::table('organizations')->whereIn('id', $organizationIdies)->delete();
        }
    }
}
