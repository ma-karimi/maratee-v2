<?php

namespace App\Repositories;

use App\Models\Taxonomy;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * Class TaxonomyRepository
 * @package App\Repositories
 * @version August 13, 2019, 6:12 am UTC
 */
class TaxonomyRepository extends BaseRepository
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
        return Taxonomy::class;
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
        return Taxonomy::where([
            'family_id' => $request['family_id'],
            'genus_id' => $request['genus_id'],
            'type_id' => $request['type_id'],
            'species_id' => $request->filled('species_id') ? $request['species_id'] : null,
            'subspecies_id' => $request->filled('subspecies_id') ? $request['subspecies_id'] : null,
            'variety_id' => $request->filled('variety_id') ? $request['variety_id'] : null,
            'species_authors' => $request->filled('species_authors') ? $request['species_authors'] : null,
            'subspecies_authors' => $request->filled('subspecies_authors') ? $request['subspecies_authors'] : null,
            'variety_authors' => $request->filled('variety_authors') ? $request['variety_authors'] : null,
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
            'non_native' => $input['non_native'] ?? 0,
            'name' => $input->filled('name') ? $input['name'] : null,
            'species_authors' => $input->filled('species_authors') ? $input['species_authors'] : null,
            'subspecies_authors' => $input->filled('subspecies_authors') ? $input['subspecies_authors'] : null,
            'variety_authors' => $input->filled('variety_authors') ? $input['variety_authors'] : null,
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
        return Taxonomy::where([
            'family_id' => $request['family_id'],
            'genus_id' => $request['genus_id'],
            'species_id' => $request->filled('species_id') ? $request['species_id'] : null,
            'subspecies_id' => $request->filled('subspecies_id') ? $request['subspecies_id'] : null,
            'variety_id' => $request->filled('variety_id') ? $request['variety_id'] : null,
            'species_authors' => $request->filled('species_authors') ? $request['species_authors'] : null,
            'subspecies_authors' => $request->filled('subspecies_authors') ? $request['subspecies_authors'] : null,
            'variety_authors' => $request->filled('variety_authors') ? $request['variety_authors'] : null,
        ])->where('id', '!=', $id)->exists();

    }

    public function getByGroup($request, $relations)
    {
        return $this->allQuery($request->all())->when($request->groupby, function ($query) use ($request) {
            return $query->whereNotNull($request->groupby)->groupBy($request->groupby);
        })
            ->filtered()
            ->with($relations)
            ->latest()
            ->get();
    }

    /**
     * @return array
     */
    public function getRelationFields(): array
    {
        return ['family', 'genus', 'species', 'subspecies', 'variety', 'audtits'];
    }
}
