<?php

namespace App\Repositories;

use App\Models\ActorHub;
use App\Models\Article;
use App\Models\Chromosome;
use Illuminate\Container\Container as Application;
use Illuminate\Support\Arr;

/**
 * Class ChromosomeRepository
 * @package App\Repositories
 * @version July 14, 2019, 10:59 am UTC
 */
class ChromosomeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [

    ];
    /**
     * @var ActorHub
     */
    private $actorHub;
    /**
     * @var LocationRepository
     */
    private $locationRepo;
    /**
     * @var ArticleRepository
     */
    private $articleRepo;

    public function __construct(Application $app, ActorHub $actorHub, LocationRepository $locationRepo, ArticleRepository $articleRepo)
    {
        parent::__construct($app);
        $this->actorHub = $actorHub;
        $this->locationRepo = $locationRepo;
        $this->articleRepo = $articleRepo;
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
        return Chromosome::class;
    }

    public function create($input)
    {
        $input = $this->createOrUpdateChromosomeData($input);

        return parent::create($this->chromosomeData($input->all()));
    }

    /**
     * @param $input
     * @return mixed
     */
    private function createOrUpdateChromosomeData($input)
    {
        $article = $this->storeArticle($input->all(), $input->filled('article_id') ? $input['article_id'] : null);
        $location = $this->storeLocation($input->all(), $input->filled('location_id') ? $input['location_id'] : null);
        $input['location_id'] = $location->id;
        $input['article_id'] = $article ? $article->id : null;
        return $input;
    }

    private function storeArticle($input, $article_id = null)
    {
        $data = Arr::only($input, [
            'title', 'year', 'journal_name', 'page_no'
        ]);
        $article = null;
        if (Arr::exists($input, 'title')) {
            if ($article_id) {
                $article = $this->articleRepo->update($data, $article_id);
            } else {
                $article = $this->articleRepo->create($data);
            }
            $authors = request()->filled('authors') ? request()->get('authors') : [];
            $this->actorHub->where(['actorable_id' => $article->id, 'actorable_type' => Article::class])
                ->whereNotIn('actor_id', $authors)
                ->delete();
            if (!empty($authors) && count($authors)) {
                foreach ($authors as $item) {
                    $this->actorHub->firstOrCreate([
                        'actor_id' => $item,
                        'actorable_type' => Article::class,
                        'actorable_id' => $article->id,
                    ]);
                }
            }
        }
        return $article;

    }

    private function storeLocation($input, $location_id = null)
    {
        $data = Arr::only($input, [
            'village', 'city_id', 'province_id', 'address_en', 'region_name', 'address_fa'
        ]);

        if ($location_id) {
            return $this->locationRepo->update($data, $location_id);
        }
        return $this->locationRepo->create($data);

    }

    private function chromosomeData($input)
    {
        return Arr::only($input, [
            'general_class_id', 'taxonomy_id', 'article_id', 'n_no', 'n2_no', 'v_number', 'location_id', 'description'
        ]);
    }

    public function update($input, $id)
    {
        $input = $this->createOrUpdateChromosomeData($input);
        return parent::update($this->chromosomeData($input->all()), $id);
    }
}
