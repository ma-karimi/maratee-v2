<?php

namespace App\Repositories;

use App\Models\PaleobotanyGeneralHub;
use App\Models\PaleobotanyTaxonomy;
use Carbon\Carbon;
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
                'genus_id' => 'Paleobotany Taxonomy Already Exists!',
                'species_id' => 'Paleobotany Taxonomy Already Exists!'
            ]);
        }

        $taxonomy = parent::create($this->setPrimaryData($request));

        $this->createHub($taxonomy->id, 'samples', \request()->filled('samples') ? $request['samples'] : []);
        $this->createHub($taxonomy->id, 'divisions', \request()->filled('divisions') ? $request['divisions'] : []);

        return $taxonomy;

    }

    /**
     * @param $request
     * @return bool
     */
    private function taxonomyExistWhenCreate($request): bool
    {
        return PaleobotanyTaxonomy::where([
            'genus_id' => $request['genus_id'],
            'species_id' => $request->filled('species_id') ? $request['species_id'] : null,
            'infra_specific_id' => $request->filled('infra_specific_id') ? $request['infra_specific_id'] : null,
            'family_id' => $request->filled('family_id') ? $request['family_id'] : null,
            'order_id' => $request->filled('order_id') ? $request['order_id'] : null,
            'type_status_id' => $request->filled('type_status_id') ? $request['type_status_id'] : null,
            'species_authors' => $request->filled('species_authors') ? $request['species_authors'] : null
        ])->exists();

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
            'species_authors' => $input->filled('species_authors') ? $input['species_authors'] : null,
        ];
    }

    /**
     * @param $taxonomy
     * @param $divisions
     * @deprecated
     */
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
                'genus_id' => 'Paleobotany Taxonomy Already Exists!',
                'species_id' => 'Paleobotany Taxonomy Already Exists!'
            ]);
        }

        $taxonomy = parent::update($this->setPrimaryData($request), $id);
        $this->createHub($taxonomy->id, 'divisions', \request()->filled('divisions') ? $request['divisions'] : []);
        $this->createHub($taxonomy->id, 'samples', \request()->filled('samples') ? $request['samples'] : []);

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
            'species_authors' => $input->filled('species_authors') ? $input['species_authors'] : null,
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
