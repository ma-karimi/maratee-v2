<?php

namespace App\Repositories;

use App\Models\ActorHub;
use App\Models\General;
use App\Models\Taxonomy;
use Illuminate\Container\Container as Application;
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
     * @var GeneralRepository
     */
    private $generalRepo;

    public function __construct(Application $app, GeneralRepository $generalRepo)
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
        $input = $this->setTaxonomyData($request);

        return parent::create($this->setPrimaryData($input));
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
            'species_id' => $request->filled('species_id') && is_numeric($request['species_id']) ? $request['species_id'] : null,
            'subspecies_id' => $request->filled('subspecies_id') && is_numeric($request['subspecies_id']) ? $request['subspecies_id'] : null,
            'variety_id' => $request->filled('variety_id') && is_numeric($request['variety_id']) ? $request['variety_id'] : null
        ])->exists();

    }

    /**
     * @param $request
     * @return Request
     */
    private function setTaxonomyData($request)
    {
        $request = $this->family($request);
        $request = $this->genus($request);
        $request = $this->species($request);
        $request = $this->subspecies($request);
        $request = $this->variety($request);

        $this->specieAuthor($request);
        $this->subSpecieAuthor($request);
        $this->varietyAuthor($request);
        return $request;
    }

    /**
     * @param $request
     * @return mixed
     */
    private function family($request)
    {
        if (!is_numeric($request->get('family_id'))) {
            $request['family_id'] = $this->generalRepo->model->firstOrCreate(['name' => $request['family_id'], 'type' => 'family'])->id;
        }
        return $request;
    }

    /**
     * @param $request
     * @return mixed
     */
    private function genus($request)
    {
        if (!is_numeric($request->get('genus_id'))) {
            $request['genus_id'] = $this->generalRepo->model->firstOrCreate(['name' => $request['genus_id'], 'type' => 'genus'])->id;
        }
        return $request;
    }

    /**
     * @param $request
     * @return mixed
     */
    private function species($request)
    {
        if ($request->filled('species_id') && !is_numeric($request->get('species_id'))) {
            $specie = $this->generalRepo->model->firstOrCreate(['name' => $request['species_id'], 'type' => 'species']);
            $request['species_id'] = $specie->id;
        }
        return $request;
    }

    /**
     * @param $request
     * @return mixed
     */
    private function subspecies($request)
    {
        if ($request->filled('subspecies_id') && !is_numeric($request->get('subspecies_id'))) {
            $sub_specie = $this->generalRepo->model->firstOrCreate(['name' => $request['subspecies_id'], 'type' => 'sub_species']);
            $request['subspecies_id'] = $sub_specie->id;
        }
        return $request;
    }

    /**
     * @param $request
     * @return mixed
     */
    private function variety($request)
    {
        if ($request->filled('variety_id') && !is_numeric($request->get('variety_id'))) {
            $variety = $this->generalRepo->model->firstOrCreate(['name' => $request['variety_id'], 'type' => 'variety']);
            $request['variety_id'] = $variety->id;

        }
        return $request;
    }

    /**
     * @param $request
     * @return mixed
     */
    private function specieAuthor($request)
    {
        $species_authors = $request->filled('species_auth') ? $request->get('species_auth') : [];

        ActorHub::where(['actorable_id' => $request->get('species_id'), 'actorable_type' => General::class])
            ->whereNotIn('actor_id', $species_authors)
            ->delete();
        if (!empty($species_authors) && count($species_authors)) {
            foreach ($species_authors as $item) {
                ActorHub::firstOrCreate([
                    'actor_id' => $item,
                    'actorable_type' => General::class,
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
        ActorHub::where(['actorable_id' => $request->get('subspecies_id'), 'actorable_type' => General::class])
            ->whereNotIn('actor_id', $subspecies_authors)
            ->delete();
        if (!empty($subspecies_authors) && count($subspecies_authors)) {
            foreach ($subspecies_authors as $item) {
                ActorHub::firstOrCreate([
                    'actor_id' => $item,
                    'actorable_type' => General::class,
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
        ActorHub::where(['actorable_id' => $request->get('variety_id'), 'actorable_type' => General::class])
            ->whereNotIn('actor_id', $variety_authors)
            ->delete();
        if (!empty($variety_authors) && count($variety_authors)) {
            foreach ($variety_authors as $item) {
                ActorHub::firstOrCreate([
                    'actor_id' => $item,
                    'actorable_type' => General::class,
                    'actorable_id' => $request->get('variety_id'),
                ]);
            }
        }


    }

    public function update($request, $id)
    {
        $exist = $this->taxonomyExistWhenUpdate($request, $id);

        if ($exist) {
            throw ValidationException::withMessages([
                'name' => 'Taxonomy Already Exists!'
            ]);
        }
        $input = $this->setTaxonomyData($request);

        return parent::update($this->setPrimaryData($input), $id);
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
            'species_id' => $request->filled('species_id') && is_numeric($request['species_id']) ? $request['species_id'] : null,
            'subspecies_id' => $request->filled('subspecies_id') && is_numeric($request['subspecies_id']) ? $request['subspecies_id'] : null,
            'variety_id' => $request->filled('variety_id') && is_numeric($request['variety_id']) ? $request['variety_id'] : null
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
            'type_id' => $input['type_id'],
            'non_native' => $input['non_native'] ?? 0,
            'name' => $input->filled('name') ? $input['name'] : null,
        ];
    }
}
