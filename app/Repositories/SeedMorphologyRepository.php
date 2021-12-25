<?php

namespace App\Repositories;

use App\Models\MorphologyVariable;
use App\Models\SeedMorphology;
use App\Models\SeedMorphologyField;
use Illuminate\Support\Arr;

/**
 * Class SeedMorphologyRepository
 * @package App\Repositories
 * @version October 20, 2019, 8:47 am UTC
 */
class SeedMorphologyRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [

    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SeedMorphology::class;
    }

    public function storeQuantitatives($input, $morphology)
    {
        $this->storeVariables($input, $morphology, 'quantitatives');
    }

    /**
     * @param $input
     * @param $morphology
     * @param $type
     */
    public function storeVariables($input, $morphology, $relation): void
    {

        $morphology->$relation()
            ->whereNotIn('seed_general_id', collect($input)->pluck('seed_general_id')->all())
            ->get()
            ->each(function ($query) {
                $query->pivot->update(['deleted_at' => \Carbon\Carbon::now()]);
            });

        if (!empty($input) && count($input)) {
            foreach ($input as $item) {
                MorphologyVariable::updateOrCreate(
                    [
                        'seed_morphology_id' => $morphology->id,
                        'seed_general_id' => $item['seed_general_id']
                    ],
                    [
                        'value' => $item['value']
                    ]
                );
            }
        }
    }

    public function storeQualititatives($input, $morphology)
    {
        $this->storeVariables($input, $morphology, 'qualititatives');
    }

    public function storeMedia(array $input, SeedMorphology $seedMorphology)
    {
        $media_input = [
            'media_type' => $input['media_type'] ?? 2,
        ];
        if (request()->hasFile('file')) {
            $media_record = $seedMorphology->addMedia(request()->file('file'))->toMediaCollection('media');
            $media_record->update($media_input);
        }
    }

    /**
     * @param array $input
     * @param $seedMorphology
     * @return mixed
     * @deprecated
     */
    public function storeField(array $input, $seedMorphology)
    {

        if (request()->filled('id')) {
            SeedMorphologyField::find($input['id'])->update(Arr::except($input, ['id']));
        } else {
            SeedMorphologyField::create($input);
        }
        return $seedMorphology;
    }

    public function getRelationFields()
    {
        return ['qualititatives:seed_generals.id,seed_generals.name,seed_generals.type_id', 'field', 'seedCollection:id,accession_code,taxonomy_id', 'specimenType', 'collection', 'organization', 'media'];
    }
}
