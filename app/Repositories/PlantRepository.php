<?php

namespace App\Repositories;

use App\Models\Plant;
use App\Models\Taxonomy;
use Illuminate\Container\Container as Application;

/**
 * Class PlantRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:25 am UTC
 */
class PlantRepository extends BaseRepository
{

    private $taxonomyRepository;
    private $classificationRepository;

    /**
     * PlantRepository constructor.
     * @param Application $app
     * @param TaxonomyRepository $taxonomyRepository
     * @throws \Exception
     */
    public function __construct(Application $app, TaxonomyRepository $taxonomyRepository, ClassificationRepository $classificationRepository)
    {
        parent::__construct($app);
        $this->taxonomyRepository = $taxonomyRepository;
        $this->classificationRepository = $classificationRepository;
    }

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'is_flowering' => [
            'scope' => 'ofFloweringHerbariums'
        ]
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
        return Plant::class;
    }

    /**
     * @param array $input
     * @return \Illuminate\Database\Eloquent\Model|void
     */
    public function create($input)
    {
        [$taxonomy_input, $taxonomy_record] = $this->findTaxonomy($input);
        $input['taxonomy_id']=$taxonomy_record->id??$this->taxonomyRepository->create($taxonomy_input)->id;
        $input = collect($input)->forget(collect($taxonomy_input)->keys()->toArray());

        [$classification_input, $classification_record] = $this->findClassification($input);
        $input = collect($input)->forget(collect($classification_input)->keys()->toArray());
        $input['classification_id']= $classification_record->id??$this->classificationRepository->create($taxonomy_input)->id;

       return parent::create($input->toArray());
    }

    /**
     * @param array $input
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|void
     */
    public function update($input,$id)
    {
        [$taxonomy_input, $taxonomy_record] = $this->findTaxonomy($input);
        $input['taxonomy_id']=$taxonomy_record->id??$this->taxonomyRepository->create($taxonomy_input)->id;
        $input = collect($input)->forget(collect($taxonomy_input)->keys()->toArray());

        [$classification_input, $classification_record] = $this->findClassification($input);
        $input = collect($input)->forget(collect($classification_input)->keys()->toArray());
        $input['classification_id']= $classification_record->id??$this->classificationRepository->create($taxonomy_input)->id;

       return parent::update($input->toArray(), $id);
    }

    /**
     * @param $input
     * @return array
     */
    public function findTaxonomy($input): array
    {
        $taxonomy_input = [
            'family_id' => $input['family_id'],
            'genus_id' => $input['genus_id'] ?? null,
            'species_id' => $input['species_id'] ?? null,
            'subspecies_id' => $input['subspecies_id'] ?? null,
            'variety_id' => $input['variety_id'] ?? null
        ];
        $taxonomy_record = $this->taxonomyRepository->getByCriteria($taxonomy_input)->first();
        return array($taxonomy_input, $taxonomy_record);
    }

    /**
     * @param $input
     * @return array
     */
    public function findClassification($input): array
    {
        $classification_input = [
            'flowering_id' => $input['flowering_id'],
            'sperm_id' => $input['sperm_id'] ?? null,
            'cotyledon_id' => $input['cotyledon_id'] ?? null,
        ];
        $classification_record = $this->classificationRepository->getByCriteria($classification_input)->first();
        return array($classification_input, $classification_record);
    }

}
