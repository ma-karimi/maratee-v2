<?php

namespace App\Repositories;

use App\Models\ActorHub;
use App\Models\PaleontologyCitation;
use Illuminate\Container\Container as Application;
use Illuminate\Support\Arr;

/**
 * Class PaleontologyCitationRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:27 am UTC
 */
class PaleontologyCitationRepository extends BaseRepository
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
     * PaleontologyCitationRepository constructor.
     * @param Application $app
     * @param ActorHub $actorHub
     * @throws \Exception
     */
    public function __construct(Application $app, ActorHub $actorHub)
    {
        parent::__construct($app);
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
        return PaleontologyCitation::class;
    }

    public function create($input)
    {
        $citation = parent::create(Arr::except($input, 'authors'));

        $this->setAuthors($citation);

        return $citation;
    }

    public function update($input, $id)
    {
        $citation = parent::update(Arr::except($input, 'authors'), $id);

        $this->setAuthors($citation);

        return $citation;
    }

    /**
     * @param $citation
     */
    private function setAuthors($citation)
    {
        $authors = request()->filled('authors') ? request()->get('authors') : [];
        $this->actorHub->where([
            'actorable_id' => $citation->id,
            'actorable_type' => PaleontologyCitation::class
        ])
            ->whereNotIn('actor_id', $authors)
            ->delete();
        if (!empty($authors) && count($authors)) {
            foreach ($authors as $item) {
                $this->actorHub->firstOrCreate([
                    'actor_id' => $item,
                    'actorable_type' => PaleontologyCitation::class,
                    'actorable_id' => $citation->id,
                ]);
            }
        }
    }
}
