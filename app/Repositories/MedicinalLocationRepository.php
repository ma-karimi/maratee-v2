<?php

namespace App\Repositories;

use App\Models\{ActionHub, Location, MedicinalLocation, MedicinalLocationConstituent};
use Exception;
use Illuminate\Container\Container as Application;
use Illuminate\Support\Arr;

/**
 * Class MedicinalLocationRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:22 am UTC
 */
class MedicinalLocationRepository extends BaseRepository
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
    private $articleRepo;
    /**
     * @var ActionHub
     */
    private $actionHubRepo;
    /**
     * @var MedicinalLocationConstituent
     */
    private $medicinalLocationConstituentRepo;
    /**
     * @var ActionHub
     */
    private $actionHub;


    /**
     * MedicinalLocationRepository constructor.
     * @param Application $app
     * @param ArticleRepository $articleRepository
     * @param ActionHub $actionHub
     * @param ActionHubRepository $actionHubRepo
     * @param Location $location_model
     * @param MedicinalLocationConstituent $medicinalLocationConstituentRepo
     * @throws Exception
     */
    public function __construct(Application $app, ArticleRepository $articleRepository, ActionHub $actionHub, ActionHubRepository $actionHubRepo, Location $location_model, MedicinalLocationConstituent $medicinalLocationConstituentRepo)
    {
        parent::__construct($app);
        $this->location_model = $location_model;
        $this->articleRepo = $articleRepository;
        $this->actionHubRepo = $actionHubRepo;
        $this->medicinalLocationConstituentRepo = $medicinalLocationConstituentRepo;
        $this->actionHub = $actionHub;
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
        return MedicinalLocation::class;
    }

    public function create($input)
    {

        $input['location_id'] = $this->createLocation($input)->id;

        $model = parent::create(Arr::only($input, $this->medicinalLocationData()));
        $this->storeMetabolites($input, $model);
//        $this->storeDetermine($input, $model->id);
//        $this->storeCollect($input, $model->id);

        return $model;
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
            'village' => $input['village'] ?? null,
            'min_altitude' => $input['min_altitude'] ?? null,
            'max_altitude' => $input['max_altitude'] ?? null,
            'point' => $input['point'] ?? null,
            'description' => $input['geographical_description'] ?? null,
        ];
    }

    /**
     * @return array
     */
    private function medicinalLocationData(): array
    {
        return ['location_id', 'treatment_id', 'efficiency', 'studied_sample', 'presence_in_country', 'phenology_id', 'method_distillation_id', 'method_extraction_id', 'method_analyse_id',
//            'herbarium_number', deleted by comment dr.sefidkon
            'collecting_year',
            'taxonomy_id', 'code'];
    }

    private function storeMetabolites($input, $medicinal_location)
    {
        $metabolites = request()->filled('metabolites') ? $input['metabolites'] : [];
        $this->createHub($medicinal_location->id, 'secondaryMetabolites', $metabolites);
    }

    public function storeConstituent($input, $medicinal_location_id)
    {
        $constituents = json_decode($input['constituents']);

        $cons_collection = [];
        foreach ($constituents as $constituent) {
            $cons_collection[] = $constituent->constituent_type->id;
        }

        $this->medicinalLocationConstituentRepo
            ->where('medicinal_location_id', $medicinal_location_id)
            ->whereNotIn('constituent_type_id', $cons_collection)
            ->delete();

        foreach ($constituents as $item) {
            $this->medicinalLocationConstituentRepo
                ->updateOrCreate(
                    [
                        'constituent_type_id' => $item->constituent_type->id,
                        'medicinal_location_id' => $medicinal_location_id
                    ],
                    [
                        'value' => $item->value
                    ]
                );
        }
    }

    public function update($input, $id)
    {

        $input['location_id'] = $this->updateLocation($input)->id;

        $model = parent::update(Arr::only($input, $this->medicinalLocationData()), $id);
        $this->storeMetabolites($input, $model);
//        $this->storeDetermine($input, $model->id);
//        $this->storeCollect($input, $model->id);
        return $model;
    }

    /**
     * @param $input
     * @return object
     */
    private function updateLocation($input)
    {
        $location_input = $this->locationData($input);
        if (request()->filled('location_id')) {
            return $this->location_model->find($input['location_id'])->fill($location_input)->save();
        }

        return $this->location_model->create($location_input);
    }

    public function storeReference(array $input, $id)
    {
        $article_id = $this->storeArticle($input, !empty($input['article_id']) ? $input['article_id'] : null)->id ?? null;
        $this->storeArticleAuthors($input, $article_id);
        return parent::update(['article_id' => $article_id], $id);
    }

    private function storeArticle(array $input, $article_id = null)
    {
        $data = [
            'title' => $input['title'],
            'year' => $input['year'] ?? null,
            'journal_id' => $input['journal_id'] ?? null,
            'page_no' => $input['page_no'] ?? null
        ];
        if ($article_id) {
            return $this->articleRepo->update($data, $article_id);
        }
        return $this->articleRepo->create($data);
    }

    /**
     * @param array $input
     * @param $article_id
     * @return mixed
     */
    private function storeArticleAuthors(array $input, $article_id)
    {
        $authors = request()->filled('authors') ? $input['authors'] : [];
        $this->articleRepo->createHub($article_id, 'actors', $authors);
    }

    /**
     * @param $input
     * @param $medicinal_location_id
     * @deprecated
     */
    private function storeCollect($input, $medicinal_location_id)
    {

        $action_hub = $this->actionHub->updateOrCreate(
            [
                'action_id' => 2,
                'actionable_type' => MedicinalLocation::class,
                'actionable_id' => $medicinal_location_id
            ],
            [
                'date' => $input['date'] ?? null
            ]);
        $collectors = request()->filled('collectors') ? explode(',', $input['collectors']) : [];
        $this->actionHubRepo->createHub($action_hub->id, 'actors', $collectors);
    }

}
