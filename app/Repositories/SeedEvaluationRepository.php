<?php

namespace App\Repositories;

use App\Models\SeedCollection;
use App\Models\SeedGeneralCollection;
use App\Models\SeedLength;
use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;

/**
 * Class SeedEvaluationRepository
 * @package App\Repositories
 * @version October 12, 2019, 11:34 am UTC
 */
class SeedEvaluationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [

    ];
    /**
     * @var ProjectRepository
     */
    private $projectRepo;

    public function __construct(Application $app, ProjectRepository $projectRepo)
    {
        parent::__construct($app);

        $this->projectRepo = $projectRepo;
    }

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    public function create($input)
    {
        $input = $this->createOrUpdateProject($input);
        return parent::create(Arr::except($input, ['project']));
    }

    /**
     * @param $input
     * @return mixed
     * @throws ValidationException
     */
    private function createOrUpdateProject($input)
    {
        $input['project_id'] = !empty($input['project_id']) ?
            $this->projectRepo->update($input['project'], $input['project_id'])->id :
            $this->projectRepo->create($input['project'])->id;
        return $input;
    }

    /**
     * @param $input
     * @param $id
     * @return Builder|Builder[]|Collection|Model
     * @throws ValidationException
     */
    public function storeTest($input, $id)
    {
        return parent::update($input, $id);
    }

    public function update($input, $id)
    {
        $input = $this->createOrUpdateProject($input);
        return parent::update(Arr::except($input, ['project']), $id);
    }


    public function storeRadicals($input, $seed_collection)
    {
        $this->storePivot($input['radicals'], $seed_collection->id, 1);
    }

    private function storePivot($input, $id, $type_id)
    {
        SeedLength::where('seed_collection_id', $id)
            ->whereNotIn('id', collect($input)->pluck('id')->all())
            ->where('type_id', $type_id)
            ->delete();

        if (!empty($input) && count($input)) {
            foreach ($input as $item) {
                if (!empty($item['id'])) {
                    SeedGeneralCollection::find($item['id'])
                        ->update([
                            'value' => $item['value'],
                        ]);
                } else {
                    SeedGeneralCollection::create([
                        'seed_collection_id' => $id,
                        'type_id' => $type_id,
                        'value' => $item['value'],
                    ]);
                }
            }
        }
    }

    public function storeShoots($input, $seed_collection)
    {
        $this->storePivot($input['shoots'], $seed_collection->id, 2);
    }

    public function storeLengths($input, $seed_collection)
    {
        $this->storePivot($input['lengths'], $seed_collection->id, 3);
    }

    public function storeWidths($input, $seed_collection)
    {
        $this->storePivot($input['widths'], $seed_collection->id, 4);
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SeedCollection::class;
    }

    public function storeMedia($input, $model): void
    {
        $media_input = [
            'media_type' => $input['media_type'] ?? 2,
        ];
        //store media
        if (request()->hasFile('file')) {
            $media_record = $model->addMedia(request()->file('file'))->toMediaCollection('images');
            $media_record->update($media_input);
        }
    }
}
