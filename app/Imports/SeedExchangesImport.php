<?php


namespace App\Imports;

use App\Models\SeedExchange;
use App\Models\SeedGeneral;
use App\Models\SeedWeight;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class SeedExchangesImport implements OnEachRow, WithHeadingRow
{


    public function onRow(Row $row)
    {
//        ini_set('max_execution_time', 9000);
//        ini_set('memory_limit', '2000M');
        $row = $row->toArray();
        foreach (array_keys($this->keys()) as $key) {
            throw_if(!in_array($key, array_keys($row)), new Exception("{$key} column is required"));
        }
        throw_if(empty($row['accession_code']), new Exception('Accession code fields are required'));
        throw_if(empty($row['accession_code']) || empty($row['specimen_typecollection_name']), new Exception('accession_code and collection fields are required'));
        if (!empty($row) && !empty($row['accession_code']) && !empty($row['specimen_typecollection_name'])) {
            $row = $this->storeCollection($row);
            $row = collect($row)->filter()->all();
            $model = SeedExchange::create($this->data($row));
            $this->log('SeedExchangeWeight:' . $model->id);
        }
    }

    private function keys()
    {
        return [
            "accession_code" => null,
            "regeneration_and_evaluation_code" => null,
            "name_of_organization" => null,
            "name_of_departmentgroup" => null,
            "city" => null,
            "phone" => null,
            "fax" => null,
            "email_address" => null,
            "project_title" => null,
            "research_title" => null,
            "project_leader" => null,
            "research_leader" => null,
            "project_no" => null,
            "research_no" => null,
            "specimen_typecollection_name" => null,
            "seedfruit_weight" => null,
            "exchanged_weight" => null,
            "delivery_date_year" => null,
            "delivery_date_month" => null,
            "delivery_date_day" => null,
            "recepiant_name" => null,
            "recepiant_phone" => null,
            "request_no" => null,

        ];
    }

    private function storeCollection($row)
    {
        $row['collection_id'] = null;
        if (!empty($row['specimen_typecollection_name'])) {
            $row['collection_id'] = SeedGeneral::firstOrCreate(['name' => $row['specimen_typecollection_name'], 'type_id' => 19])->id;
        }

        $row['specimen_type_id'] = null;
        if (!empty($row['specimen_type_id'])) {
            $row['specimen_type_id'] = SeedGeneral::firstOrCreate(['name' => $row['specimen_type_id'], 'type_id' => 1])->id;
        }
        $seedGeneralCollection = SeedGeneral::firstWhere(['name' => Arr::get(SeedExchange::SPECIMEN_TYPE_COLLECTION_NAME, $row['specimen_typecollection_name']), 'type_id' => 28]);
        $seedWeight = SeedWeight::firstWhere(['accession_code' => $row['accession_code'], 'collection_id' => $seedGeneralCollection->id]);
        $row['seed_weight_id'] = $seedWeight->id;
        $row['seedfruit_weight'] = Str::contains($row['specimen_typecollection_name'], 'seed') ? $seedWeight->total_seed_weight : $seedWeight->total_fruit_weight;

        return $row;
    }

    private function data(array $row)
    {
        $organization = [
            'name_en' => $row['name_of_organization'] ?? '',
            'city' => $row['city'] ?? '',
            'phone' => $row['phone'] ?? '',
            'fax' => $row['fax'] ?? '',
            'email' => $row['email'] ?? '',
            'department_name' => $row['name_of_departmentgroup'] ?? ''
        ];
        return [
            'accession_code' => $row['accession_code'],
            'collection_id' => $row['collection_id'],
            'regeneration_code' => $row['regeneration_code'] ?? null,
            'seed_weight_id' => $row['seed_weight_id'] ?? null,
            'project_id' => $row['project_id'] ?? null,
            'department_name' => $row['department_name'] ?? null,
            'project_title' => $row['project_title'] ?? null,
            'seedfruit_weight' => $row['seedfruit_weight'] ?? null,
            'exchanged_weight' => $row['exchanged_weight'] ?? null,
            'delivery_date_year' => !empty($row['delivery_date_year']) ? $row['delivery_date_year'] : null,
            'delivery_date_month' => !empty($row['delivery_date_month']) ? $row['delivery_date_month'] : null,
            'delivery_date_day' => !empty($row['delivery_date_day']) ? $row['delivery_date_day'] : null,
            'research_title' => !empty($row['research_title']) ? "{$row['research_title']}" : null,
            'project_leader_name' => !empty($row['project_leader_name']) ? "{$row['project_leader_name']}" : null,
            'research_leader_name' => !empty($row['research_leader_name']) ? "{$row['research_leader_name']}" : null,
            'project_no' => !empty($row['project_no']) ? "{$row['project_no']}" : null,
            'research_no' => !empty($row['research_no']) ? "{$row['research_no']}" : null,
            'specimen_type_id' => !empty($row['specimen_type_id']) ? "{$row['specimen_type_id']}" : null,
            'weight' => !empty($row['weight']) ? "{$row['weight']}" : null,
            'recipient_name' => $row['recipient_name'] ?? null,
            'request_no' => $row['request_no'] ?? null,
            'description' => $row['description'] ?? null,
            'organization' => $organization

        ];
    }

    private function log(string $message)
    {
        echo "$message\n";
    }

}
