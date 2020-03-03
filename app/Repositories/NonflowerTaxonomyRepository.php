<?php

namespace App\Repositories;

use App\Models\ActorHub;
use App\Models\NonflowerGeneral;
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
                'name' => 'NonflowerTaxonomy Already Exists!'
            ]);
        }
        $input = $this->setNonflowerTaxonomyData($request);

        return parent::create($this->setPrimaryData($input));
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
            'species_id' => $request->filled('species_id') && is_numeric($request['species_id']) ? $request['species_id'] : null,
            'subspecies_id' => $request->filled('subspecies_id') && is_numeric($request['subspecies_id']) ? $request['subspecies_id'] : null,
            'variety_id' => $request->filled('variety_id') && is_numeric($request['variety_id']) ? $request['variety_id'] : null
        ])->exists();

    }

    /**
     * @param $request
     * @return Request
     */
    private function setNonflowerTaxonomyData($request)
    {
        $this->specieAuthor($request);
        $this->subSpecieAuthor($request);
        $this->varietyAuthor($request);
        return $request;
    }


    /**
     * @param $request
     * @return mixed
     */
    private function specieAuthor($request)
    {
        $species_authors = $request->filled('species_auth') ? $request->get('species_auth') : [];

        ActorHub::where(['actorable_id' => $request->get('species_id'), 'actorable_type' => NonflowerGeneral::class])
            ->whereNotIn('actor_id', $species_authors)
            ->delete();
        if (!empty($species_authors) && count($species_authors)) {
            foreach ($species_authors as $item) {
                ActorHub::firstOrCreate([
                    'actor_id' => $item,
                    'actorable_type' => NonflowerGeneral::class,
                    'actorable_id' => $request->get('species_id'),
                ]);
            }
        }
    }

    /**
     * @param $request
     * @return mixed
     */
    private function subSpecieAuthor($request)
    {
        $subspecies_authors = $request->filled('subspecies_auth') ? $request->get('subspecies_auth') : [];
        ActorHub::where(['actorable_id' => $request->get('subspecies_id'), 'actorable_type' => NonflowerGeneral::class])
            ->whereNotIn('actor_id', $subspecies_authors)
            ->delete();
        if (!empty($subspecies_authors) && count($subspecies_authors)) {
            foreach ($subspecies_authors as $item) {
                ActorHub::firstOrCreate([
                    'actor_id' => $item,
                    'actorable_type' => NonflowerGeneral::class,
                    'actorable_id' => $request->get('subspecies_id'),
                ]);
            }
        }
    }

    /**
     * @param $request
     */
    private function varietyAuthor($request): void
    {
        $variety_authors = $request->filled('variety_auth') ? $request->get('variety_auth') : [];
        ActorHub::where(['actorable_id' => $request->get('variety_id'), 'actorable_type' => NonflowerGeneral::class])
            ->whereNotIn('actor_id', $variety_authors)
            ->delete();
        if (!empty($variety_authors) && count($variety_authors)) {
            foreach ($variety_authors as $item) {
                ActorHub::firstOrCreate([
                    'actor_id' => $item,
                    'actorable_type' => NonflowerGeneral::class,
                    'actorable_id' => $request->get('variety_id'),
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
                'name' => 'NonflowerTaxonomy Already Exists!'
            ]);
        }
        $input = $this->setNonflowerTaxonomyData($request);

        return parent::update($this->setPrimaryData($input), $id);
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
            'species_id' => $request->filled('species_id') && is_numeric($request['species_id']) ? $request['species_id'] : null,
            'subspecies_id' => $request->filled('subspecies_id') && is_numeric($request['subspecies_id']) ? $request['subspecies_id'] : null,
            'variety_id' => $request->filled('variety_id') && is_numeric($request['variety_id']) ? $request['variety_id'] : null
        ])->where('id', '!=', $id)->exists();

    }

    public function getByGroup($request, $relations)
    {
        return $this->allQuery($request->all())->when($request->groupby, function ($query) use ($request) {
            return $query->groupBy($request->groupby);
        })
            ->with($relations)
            ->latest()
            ->get();
    }
}
