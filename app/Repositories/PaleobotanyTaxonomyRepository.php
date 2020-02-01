<?php

namespace App\Repositories;

use App\Models\ActorHub;
use App\Models\PaleobotanyGeneral;
use App\Models\PaleobotanyGeneralHub;
use App\Models\PaleobotanyTaxonomy;
use Carbon\Carbon;
use Illuminate\Container\Container as Application;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * Class PaleobotanyTaxonomyRepository
 * @package App\Repositories
 * @version August 13, 2019, 6:12 am UTC
 */
class PaleobotanyTaxonomyRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [

    ];

    /**
     * @var PaleobotanyGeneralRepository
     */
    private $generalRepo;

    public function __construct(Application $app, PaleobotanyGeneralRepository $generalRepo)
    {
        parent::__construct($app);
        $this->generalRepo = $generalRepo;
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

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PaleobotanyTaxonomy::class;
    }

    public function create($request)
    {
        $exist = $this->taxonomyExistWhenCreate($request);
        if ($exist) {
            throw ValidationException::withMessages([
                'name' => 'Paleobotany Taxonomy Already Exists!'
            ]);
        }
        $input = $this->setPaleobotanyTaxonomyData($request);

        $taxonomy = parent::create($this->setPrimaryData($input));
        $this->createHub($taxonomy->id, 'samples', $input['samples']);
        $this->createDivisions($taxonomy, $input['divisions']);

        return $taxonomy;

    }

    /**
     * @param $request
     * @return bool
     */
    private function taxonomyExistWhenCreate($request): bool
    {
        return PaleobotanyTaxonomy::where([
            'family_id' => $request['family_id'],
            'genus_id' => $request['genus_id'],
            'species_id' => $request->filled('species_id') && is_numeric($request['species_id']) ? $request['species_id'] : null,
        ])->exists();

    }

    /**
     * @param $request
     * @return Request
     */
    private function setPaleobotanyTaxonomyData($request)
    {

        $this->specieAuthor($request);
        return $request;
    }

    /**
     * @param $request
     * @return mixed
     */
    private function specieAuthor($request)
    {
        $species_authors = $request->filled('species_auth') ? collect($request->get('species_auth'))->filter()->all() : [];

        ActorHub::where(['actorable_id' => $request->get('species_id'), 'actorable_type' => PaleobotanyGeneral::class])
            ->whereNotIn('actor_id', $species_authors)
            ->delete();
        if (!empty($species_authors) && count($species_authors)) {
            foreach ($species_authors as $item) {
                ActorHub::firstOrCreate([
                    'actor_id' => $item,
                    'actorable_type' => PaleobotanyGeneral::class,
                    'actorable_id' => $request->get('species_id'),
                ]);
            }
        }
    }

    /**
     * @param Request $input
     * @return array
     */
    public function setPrimaryData(Request $input): array
    {
        return [
            'family_id' => $input['family_id'] ?? null,
            'genus_id' => $input['genus_id'],
            'species_id' => $input['species_id'],
            'infra_specific_id' => $input->filled('infra_specific_id') ? $input['infra_specific_id'] : null,
            'order_id' => $input->filled('order_id') ? $input['order_id'] : null,
            'type_status_id' => $input->filled('type_status_id') ? $input['type_status_id'] : null,
            'name' => $input->filled('name') ? $input['name'] : null,
        ];
    }

    public function createDivisions($taxonomy, $divisions)
    {

        $divisions = collect($divisions)->filter()->all();
        $taxonomy->divisions()
            ->whereNotIn('paleobotany_general_id', collect($divisions)->pluck('id'))
            ->get()->each(function ($query) {
                $query->pivot->update(['deleted_at' => Carbon::now()]);
            });

        if (!empty($divisions) && count($divisions)) {
            foreach ($divisions as $division) {
                PaleobotanyGeneralHub::updateOrCreate(
                    [
                        'modelable_type' => PaleobotanyTaxonomy::class,
                        'modelable_id' => $taxonomy->id,
                        'paleobotany_general_id' => $division['id']
                    ],
                    [
                        'value' => $division['value']
                    ]
                );
            }
        }

    }

    public function update($request, $id)
    {
        $exist = $this->taxonomyExistWhenUpdate($request, $id);

        if ($exist) {
            throw ValidationException::withMessages([
                'name' => 'Paleobotany Taxonomy Already Exists!'
            ]);
        }
        $input = $this->setPaleobotanyTaxonomyData($request);

        $taxonomy = parent::update($this->setPrimaryData($input), $id);

        $this->createHub($taxonomy->id, 'samples', $input['samples']);
        $this->createDivisions($taxonomy, $input['divisions']);

        return $taxonomy;
    }

    /**
     * @param $request
     * @param $id
     * @return bool
     */
    private function taxonomyExistWhenUpdate($input, $id): bool
    {
        return PaleobotanyTaxonomy::where([
            'family_id' => $input['family_id'] ?? null,
            'genus_id' => $input['genus_id'],
            'species_id' => $input['species_id'],
            'infra_specific_id' => $input->filled('infra_specific_id') ? $input['infra_specific_id'] : null,
            'order_id' => $input->filled('order_id') ? $input['order_id'] : null,
            'name' => $input->filled('name') ? $input['name'] : null,
        ])->where('id', '!=', $id)->exists();

    }

    public function getByGroup($request, $relations)
    {
        return $this->allQuery($request->all())->when($request->groupby, function ($query) use ($request) {
            return $query->whereNotNull($request->groupby)->groupBy($request->groupby);
        })
            ->with($relations)
            ->latest()
            ->get();
    }
}
