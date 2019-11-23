<?php

namespace App\Repositories;

use App\Models\ActionHub;
use App\Models\ActorHub;
use App\Models\Article;
use App\Models\Location;
use App\Models\MedicinalPlant;
use App\Models\MedicinalPlantConstituent;
use App\Models\MedicinalPlantProvince;
use Illuminate\Container\Container as Application;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

/**
 * Class MedicinalPlantRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:22 am UTC
 */
class MedicinalPlantRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [

    ];
    /**
     * @var Location
     */
    private $location_model;
    private $article_repo;
    /**
     * @var ActionHub
     */
    private $actionHubRepo;
    /**
     * @var ActorHub
     */
    private $actorHubRepo;
    /**
     * @var MedicinalPlantConstituent
     */
    private $medicinalPlantConstituentRepo;
    /**
     * @var MedicinalPlantProvince
     */
    private $medicinalPlantProvinceRepo;

    /**
     * MedicinalPlantRepository constructor.
     * @param Application $app
     * @param ArticleRepository $article_repository
     * @param ActionHub $actionHubRepo
     * @param ActorHub $actorHubRepo
     * @param Location $location_model
     * @param MedicinalPlantConstituent $medicinalPlantConstituentRepo
     * @param MedicinalPlantProvince $medicinalPlantProvinceRepo
     * @throws \Exception
     */
    public function __construct(Application $app, ArticleRepository $article_repository, ActionHub $actionHubRepo, ActorHub $actorHubRepo, Location $location_model, MedicinalPlantConstituent $medicinalPlantConstituentRepo, MedicinalPlantProvince $medicinalPlantProvinceRepo)
    {
        parent::__construct($app);
        $this->location_model = $location_model;
        $this->article_repo = $article_repository;
        $this->actionHubRepo = $actionHubRepo;
        $this->actorHubRepo = $actorHubRepo;
        $this->medicinalPlantConstituentRepo = $medicinalPlantConstituentRepo;
        $this->medicinalPlantProvinceRepo = $medicinalPlantProvinceRepo;
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
        return MedicinalPlant::class;
    }

    public function create($input)
    {
        $input['article_id'] = $this->createArticle($input)->id ?? null;
        $input['location_id'] = $this->createLocation($input)->id;
        $model = parent::create(Arr::except($input, $this->ArticleLocationLifeFormsData()));
        $this->storeDetermine($input, $model->id);
        $this->storeCollect($input, $model->id);
        $this->storeConstituent($input, $model->id);
        $this->storeProvinces($input, $model->id);
        return $this->storeLifeForm($input, $model);
    }

    /**
     * @param $input
     * @return mixed
     */
    private function createArticle($input)
    {
        $article = null;
        if (Arr::exists($input, 'title')) {
            $article = $this->article_repo->create([
                'title' => $input['title'],
                'year' => $input['year'] ?? null,
                'journal_name' => $input['journal_name'] ?? null,
                'page_no' => $input['page_no'] ?? null
            ]);
            //store authors

            $authors = request()->filled('authors') ? request()->get('authors') : [];
            ActorHub::where(['actorable_id' => $article->id, 'actorable_type' => Article::class])
                ->whereNotIn('actor_id', $authors)
                ->delete();
            if (!empty($authors) && count($authors)) {
                foreach ($authors as $item) {
                    ActorHub::firstOrCreate([
                        'actor_id' => $item,
                        'actorable_type' => Article::class,
                        'actorable_id' => $article->id,
                    ]);
                }
            }
        }
        return $article;
    }

    /**
     * @param $input
     * @return object
     */
    private function createLocation($input)
    {
        $location_input = $this->locationData($input);

        return $this->location_model->create($location_input);
    }

    /**
     * @param $input
     * @return array
     */
    private function locationData($input): array
    {
        return [
            'province_id' => $input['province_id'],
            'city_id' => $input['city_id'] ?? null,
            'region_name' => $input['region_name'] ?? null,
            'address_en' => $input['address_en'] ?? null,
            'address_fa' => $input['address_fa'] ?? null,
            'village_id' => $input['village_id'] ?? null,
            'min_altitude' => $input['min_altitude'] ?? null,
            'max_altitude' => $input['max_altitude'] ?? null,
            'point' => $input['point'] ?? null,
            'description' => $input['geographical_description'] ?? null,
        ];
    }

    /**
     * @return array
     */
    private function ArticleLocationLifeFormsData(): array
    {
        $article = [
            'title',
            'year',
            'journal_name',
            'page_no',
            'authors'
        ];
        return array_merge($article, ['date', 'collectors', 'determines', 'life_forms', 'address_en', 'address_fa', 'province_id', 'village_id', 'province_id', 'region_name', 'min_altitude', 'max_altitude', 'point', 'geographical_description', 'city_id', 'country_id', 'provinces', 'constituents']);
    }

    private function storeDetermine($input, $medicinal_plant_id)
    {
        $determines = is_array($input['determines']) ? $input['determines'] : explode(',', $input['determines']);

        $action_hub = $this->actionHubRepo->firstOrCreate([
            'action_id' => 1,
            'actionable_type' => MedicinalPlant::class,
            'actionable_id' => $medicinal_plant_id
        ]);

        $this->actorHubRepo
            ->where('actorable_id', $action_hub->id)
            ->where('actorable_type', ActionHub::class)
            ->whereNotIn('actor_id', $determines)
            ->delete();
        if (count($determines) && !empty($determines[0])) {
            foreach ($determines as $item) {
                $this->actorHubRepo->firstOrCreate([
                    'actorable_id' => $action_hub->id,
                    'actorable_type' => ActionHub::class,
                    'actor_id' => (int)$item,
                ]);
            }
        }
    }

    private function storeCollect($input, $medicinal_plant_id)
    {
        $collectors = is_array($input['collectors']) ? $input['collectors'] : explode(',', $input['collectors']);

        $action_hub = $this->actionHubRepo->updateOrCreate(
            [
                'action_id' => 2,
                'actionable_type' => MedicinalPlant::class,
                'actionable_id' => $medicinal_plant_id
            ],
            [
                'date' => $input['date'] ?? null
            ]);
        $this->actorHubRepo
            ->where('actorable_id', $action_hub->id)
            ->where('actorable_type', ActionHub::class)
            ->whereNotIn('actor_id', $collectors)
            ->delete();
        if (count($collectors) && !empty($collectors[0])) {
            foreach ($collectors as $item) {
                $this->actorHubRepo->firstOrCreate([
                    'actorable_id' => $action_hub->id,
                    'actorable_type' => ActionHub::class,
                    'actor_id' => (int)$item,
                ]);
            }
        }
    }

    private function storeConstituent($input, $medicinal_plant_id)
    {
        $constituents = json_decode($input['constituents']);

        Log::info($constituents);
//        $cons_collection = collect($constituents)->map(function ($query) {
//            return $query['constituent_type_id'];
//        });
//
//        $this->medicinalPlantConstituentRepo
//            ->where('medicinal_plant_id', $medicinal_plant_id)
//            ->whereNotIn('constituent_type_id', $cons_collection->all())
//            ->delete();

        $cons_collection = [];
        foreach ($constituents as $constituent){
            $cons_collection[] = $constituent->constituent_type->id;
        }

        $this->medicinalPlantConstituentRepo
            ->where('medicinal_plant_id', $medicinal_plant_id)
            ->whereNotIn('constituent_type_id', $cons_collection)
            ->delete();

        foreach ($constituents as $item) {
            $this->medicinalPlantConstituentRepo
                ->updateOrCreate(
                    [
                        'constituent_type_id' => $item->constituent_type->id,
                        'medicinal_plant_id' => $medicinal_plant_id
                    ],
                    [
                        'value' => $item->value
                    ]
                );
        }
    }

    private function storeProvinces($input, $medicinal_plant_id)
    {
        $provinces = is_array($input['provinces']) ? $input['provinces'] : explode(',', $input['provinces']);


        $this->medicinalPlantProvinceRepo
            ->where('medicinal_plant_id', $medicinal_plant_id)
            ->whereNotIn('province_id', $provinces)
            ->delete();
        if (count($provinces) && !empty($provinces[0])) {
            foreach ($provinces as $item) {
                $this->medicinalPlantProvinceRepo->firstOrCreate([
                    'medicinal_plant_id' => $medicinal_plant_id,
                    'province_id' => (int)$item,
                ]);
            }
        }
    }

    private function storeLifeForm($input, \Illuminate\Database\Eloquent\Model $model)
    {
        $model->cycle_id = $input['cycle_id'] ?? null;
        $model->wooden_id = $input['wooden_id'] ?? null;
        $model->herbaceous_id = $input['herbaceous_id'] ?? null;
        $model->save();
        return $model;
    }

    public function update($input, $id)
    {
        $this->updateLocation($input);
        $model = parent::update(Arr::except($input, $this->ArticleLocationLifeFormsData()), $id);
        $this->storeDetermine($input, $model->id);
        $this->storeCollect($input, $model->id);
        $this->storeConstituent($input, $model->id);
        $this->storeProvinces($input, $model->id);
        return $this->storeLifeForm($input, $model);
    }

    /**
     * @param $input
     * @return object
     */
    private function updateLocation($input)
    {
        $location_input = $this->locationData($input);

        return $this->location_model->find($input['location_id'])->update($location_input);
    }

}
