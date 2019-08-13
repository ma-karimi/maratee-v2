<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Taxonomy;
use App\Repositories\TaxonomyRepository;

trait MakeTaxonomyTrait
{
    /**
     * Create fake instance of Taxonomy and save it in database
     *
     * @param array $taxonomyFields
     * @return Taxonomy
     */
    public function makeTaxonomy($taxonomyFields = [])
    {
        /** @var TaxonomyRepository $taxonomyRepo */
        $taxonomyRepo = \App::make(TaxonomyRepository::class);
        $theme = $this->fakeTaxonomyData($taxonomyFields);
        return $taxonomyRepo->create($theme);
    }

    /**
     * Get fake instance of Taxonomy
     *
     * @param array $taxonomyFields
     * @return Taxonomy
     */
    public function fakeTaxonomy($taxonomyFields = [])
    {
        return new Taxonomy($this->fakeTaxonomyData($taxonomyFields));
    }

    /**
     * Get fake data of Taxonomy
     *
     * @param array $taxonomyFields
     * @return array
     */
    public function fakeTaxonomyData($taxonomyFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $taxonomyFields);
    }
}
