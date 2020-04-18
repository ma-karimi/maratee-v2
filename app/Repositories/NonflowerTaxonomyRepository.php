<?php

namespace App\Repositories;

use App\Models\NonflowerTaxonomy;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * Class NonflowerTaxonomyRepository
 * @package App\Repositories
 * @version August 13, 2019, 6:12 am UTC
 */
class NonflowerTaxonomyRepository extends BaseRepository
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
        return NonflowerTaxonomy::class;
    }

    public function create($request)
    {
        $exist = $this->taxonomyExistWhenCreate($request);
        if ($exist) {
            throw ValidationException::withMessages([
                'name' => 'Taxonomy Already Exists!'
            ]);
        }

        return parent::create($this->setPrimaryData($request));
    }

    /**
     * @param $request
     * @return bool
     */
    private function taxonomyExistWhenCreate($request): bool
    {
        return NonflowerTaxonomy::where([
            'family_id' => $request['family_id'],
            'genus_id' => $request['genus_id'],
            'species_id' => $request->filled('species_id') ? $request['species_id'] : null,
            'subspecies_id' => $request->filled('subspecies_id') ? $request['subspecies_id'] : null,
            'variety_id' => $request->filled('variety_id') ? $request['variety_id'] : null
        ])->exists();

    }

    /**
     * @param Request $input
     * @return array
     */
    public function setPrimaryData(Request $input): array
    {
        return [
            'family_id' => $input['family_id'],
            'genus_id' => $input['genus_id'],
            'species_id' => $input->filled('species_id') ? $input['species_id'] : null,
            'subspecies_id' => $input->filled('subspecies_id') ? $input['subspecies_id'] : null,
            'variety_id' => $input->filled('variety_id') ? $input['variety_id'] : null,
            'name' => $input->filled('name') ? $input['name'] : null,
        ];
    }

    public function update($request, $id)
    {
        $exist = $this->taxonomyExistWhenUpdate($request, $id);

        if ($exist) {
            throw ValidationException::withMessages([
                'name' => 'Taxonomy Already Exists!'
            ]);
        }

        return parent::update($this->setPrimaryData($request), $id);
    }

    /**
     * @param $request
     * @param $id
     * @return bool
     */
    private function taxonomyExistWhenUpdate($request, $id): bool
    {
        return NonflowerTaxonomy::where([
            'family_id' => $request['family_id'],
            'genus_id' => $request['genus_id'],
            'species_id' => $request->filled('species_id') ? $request['species_id'] : null,
            'subspecies_id' => $request->filled('subspecies_id') ? $request['subspecies_id'] : null,
            'variety_id' => $request->filled('variety_id') ? $request['variety_id'] : null
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

    /**
     * @return array
     */
    public function getRelationFields(): array
    {
        return ['family', 'genus', 'species.authors', 'subspecies.authors', 'variety.authors'];
    }
}
