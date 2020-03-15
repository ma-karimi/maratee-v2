<?php


namespace App\Imports;

use App\Models\ActionHub;
use App\Models\Actor;
use App\Models\ActorHub;
use App\Models\GeologyAge;
use App\Models\Locality;
use App\Models\Location;
use App\Models\Paleontology;
use App\Models\Province;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class PaleobotanyImport implements OnEachRow, WithHeadingRow
{


    private CONST ACTION = [
        'detect' => 1, 'collect' => 2
    ];

    public function onRow(Row $row)
    {
        ini_set('max_execution_time', 9000);
//        ini_set('memory_limit', '2000M');
        $row = $row->toArray();

        if (!empty($row)) {

            $row = $this->createLocation($row);
            $row = $this->storeEra($row);
            $row = $this->storeStage($row);
            $row = $this->storeEpoch($row);
            $row = $this->storePeriod($row);

            $model = Paleontology::create(Arr::only($row, $this->data()));
            $this->storeCollect($row, $model);
            $this->storeLocality($row, $model);
            $this->log('Paleobotany:' . $model->id);
        }

    }

    /**
     * @param $row
     * @return
     */
    private function createLocation($row)
    {
        $row['location_id'] = null;
        if (!empty($row['province'])) {
            $province = Province::where('name_en', Str::ucfirst($row['province']))->first();


            $row['province_id'] = $province->id;
            $location = Location::create([
                'province_id' => $row['province_id'],
                'village' => $row['village'] ?? null,
                'region_name' => $row['region_name'] ?? null,
            ]);
            $row['location_id'] = $location->id;
        }

        return $row;

    }


    private function storeEra($row)
    {
        $row['geology_age_era_id'] = null;
        if (!empty($row['era'])) {
            $row['geology_age_era_id'] = GeologyAge::firstOrCreate(['name' => Str::lower($row['era']), 'type_id' => 1])->id;
        }

        return $row;
    }

    private function storeStage($row)
    {
        $row['geology_age_stage_id'] = null;
        if (!empty($row['stage'])) {
            $row['geology_age_stage_id'] = GeologyAge::firstOrCreate(['name' => Str::lower($row['stage']), 'type_id' => 4])->id;
        }

        return $row;
    }

    private function storeEpoch($row)
    {
        $row['geology_age_epoch_id'] = null;
        if (!empty($row['epoch'])) {
            $row['geology_age_epoch_id'] = GeologyAge::firstOrCreate(['name' => Str::lower($row['epoch']), 'type_id' => 3])->id;
        }

        return $row;
    }

    private function storePeriod($row)
    {
        $row['geology_age_period_id'] = null;
        if (!empty($row['period'])) {
            $row['geology_age_period_id'] = GeologyAge::firstOrCreate(['name' => Str::lower($row['period']), 'type_id' => 2])->id;
        }

        return $row;
    }

    /**
     * @return array
     */
    private function data(): array
    {
        return [
            'specimen_no',
            'catalog_no',
            'geology_age_era_id',
            'geology_age_period_id',
            'geology_age_epoch_id',
            'geology_age_stage_id',
            'pieces',
            'color',
            'element',
        ];
    }

    private function storeCollect($row, $model)
    {
        $collect_id = ActionHub::create($this->actionHubData(self::ACTION['collect'], $model->id, $row['collecting_date'] ?? null))->id;

        if (!empty($row['collectors'])) {
            $collectors = explode(',', $row['collectors']);
            if (!empty($collectors) && count($collectors)) {
                foreach ($collectors as $collector) {
                    $collector_id = Actor::firstOrCreate(['name' => trim($collector)])->id;
                    ActorHub::create($this->actorHubData($collect_id, $collector_id));
                }
            }
        }
    }

    private function actionHubData($action_id, $model_id, $date): array
    {
        return [
            'action_id' => $action_id,
            'actionable_type' => Paleontology::class,
            'actionable_id' => $model_id,
            'date' => $date
        ];
    }

    private function actorHubData($action_id, $actor_id): array
    {
        return [
            'actorable_type' => ActionHub::class,
            'actorable_id' => $action_id,
            'actor_id' => $actor_id,
        ];
    }

    private function storeLocality($row, $model)
    {
        if (strlen($row['lng']) && strlen($row['lat'])) {
            $row['dms'] = 'Lat: ' . $row['lat'] . ',' . 'Lng: ' . $row['lng'];
        }
        Locality::create([
            'formation' => $row['formation'] ?? null,
            'layer' => $row['layer'] ?? null,
            'location_id' => $row['location_id'],
            'paleontology_id' => $model->id,
            'description' => $row['dms'] ?? null
        ]);
    }

    private function log(string $message)
    {
        echo "$message\n";
    }

    public function headingRow(): int
    {
        return 2;
    }

}
