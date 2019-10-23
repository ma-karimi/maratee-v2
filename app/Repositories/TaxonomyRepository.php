<?php

namespace App\Repositories;

use App\Models\Actor;
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
    /**
     * @var Actor
     */
    private $actor;
    /**
     * @var ActorHub
     */
    private $actorHub;

    public function __construct(Application $app, GeneralRepository $generalRepo, Actor $actor, ActorHub $actorHub)
    {
        parent::__construct($app);

        $this->generalRepo = $generalRepo;
        $this->actor = $actor;
        $this->actorHub = $actorHub;
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
                'taxonomy' => 'Already Exists!'
            ]);
        }
        $request = $this->setTaxonomyData($request);

        return parent::create([
            'family_id' => $request['family_id'],
            'genus_id' => $request['genus_id'],
            'species_id' => $request->filled('species_id') ? $request['species_id'] : null,
            'subspecies_id' => $request->filled('subspecies_id') ? $request['subspecies_id'] : null,
            'variety_id' => $request->filled('variety_id') ? $request['variety_id'] : null,
            'name' => $request->filled('name') ? $request['name'] : null,
        ]);
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
        if ($request->filled(['species_id', 'species_auth'])) {
            if (!is_numeric($request->get('species_auth'))) {
                $actor = $this->actorFirstOrCreate($request['species_auth']);
                $this->actorHubFirstOrCreate($request['species_id'], $actor->id);
            } else {
                $this->actorHubFirstOrCreate($request['species_id'], $request['species_auth']);
            }
        }
    }

    /**
     * @param $name
     * @return mixed
     */
    private function actorFirstOrCreate($name)
    {
        return $this->actor->firstOrCreate(['name' => $name]);
    }

    /**
     * @param $general_id
     * @param $actor_id
     */
    private function actorHubFirstOrCreate($general_id, $actor_id): void
    {
        $old_actor_hub = $this->actorHub->where(['actorable_type' => General::class, 'actorable_id' => $general_id])->first();
        if ($old_actor_hub && (int)$old_actor_hub->actor_id !== (int)$actor_id) {
            $old_actor_hub->delete();
        }
        $this->actorHub->firstOrCreate(['actorable_type' => General::class, 'actorable_id' => $general_id, 'actor_id' => $actor_id]);
    }

    /**
     * @param $request
     * @return mixed
     */
    private function subSpecieAuthor($request)
    {
        if ($request->filled(['subspecies_id', 'subspecies_auth'])) {

            if (!is_numeric($request->get('subspecies_auth'))) {
                $actor = $this->actorFirstOrCreate($request['subspecies_auth']);
                $this->actorHubFirstOrCreate($request['subspecies_id'], $actor->id);
            } else {
                $this->actorHubFirstOrCreate($request['subspecies_id'], $request['species_auth']);
            }
        }
    }

    /**
     * @param $request
     */
    private function varietyAuthor($request): void
    {
        if ($request->filled(['variety_id', 'variety_auth'])) {

            if (!is_numeric($request->get('variety_auth'))) {
                $actor = $this->actorFirstOrCreate($request['variety_auth']);
                $this->actorHubFirstOrCreate($request['variety_id'], $actor->id);
            } else {
                $this->actorHubFirstOrCreate($request['variety_id'], $request['variety_auth']);
            }
        }
    }

    public function update($request, $id)
    {
        $exist = $this->taxonomyExistWhenUpdate($request, $id);

        if ($exist) {
            throw ValidationException::withMessages([
                'taxonomy' => 'Already Exists!'
            ]);
        }
        $request = $this->setTaxonomyData($request);

        return parent::update([
            'family_id' => $request['family_id'],
            'genus_id' => $request['genus_id'],
            'species_id' => $request->filled('species_id') ? $request['species_id'] : null,
            'subspecies_id' => $request->filled('subspecies_id') ? $request['subspecies_id'] : null,
            'variety_id' => $request->filled('variety_id') ? $request['variety_id'] : null,
            'name' => $request->filled('name') ? $request['name'] : null,
        ], $id);
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

    public function get($request)
    {
        return $this->allQuery($request->all())->when($request->groupby, function ($query) use ($request) {
            return $query->whereNotNull($request->groupby)->groupBy($request->groupby);
        })
            ->when($request->relations, function ($query) use ($request) {
                return $query->with($request->relations);
            })->get();
    }

    public function paginate($perPage, array $search = [], array $with_relations = null, $columns = ['*'])
    {
        $query = $this->allQuery($search);
        return $query->when($with_relations, function ($query, $with_relations) {
            return $query->with($with_relations);
        })
            ->when(\request('groupby'), function ($query) {
                return $query->whereNotNull(\request('groupby'))->groupBy(\request('groupby'));
            })
            ->paginate($perPage ?? 25, $columns);
    }
}
