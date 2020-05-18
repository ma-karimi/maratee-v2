<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\NonflowerTaxonomyAPIRequest;
use App\Models\NonflowerTaxonomy;
use App\Repositories\NonflowerTaxonomyRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Response;

/**
 * Class NonflowerTaxonomyController
 * @package App\Http\Controllers\Api
 */
class NonflowerTaxonomyAPIController extends AppBaseController
{
    /** @var  NonflowerTaxonomyRepository */
    private $taxonomyRepository;

    public function __construct(NonflowerTaxonomyRepository $taxonomyRepo)
    {
        $this->taxonomyRepository = $taxonomyRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/nonflower_taxonomies",
     *      tags={"NonflowerTaxonomy"},
     *      description="Get all Taxonomies",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/NonflowerTaxonomy")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     * @throws Exception
     */
    public function index(Request $request)
    {
        $taxonomies = $this->taxonomyRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $this->taxonomyRepository->getRelationFields()
        );

        $keys = [
            ['name' => 'family', 'title' => 'Family', 'value' => false],
            ['name' => 'genus', 'title' => 'Genus', 'value' => false],
            ['name' => 'species', 'title' => 'Species', 'value' => false],
            ['name' => 'subspecies', 'title' => 'SubSpecies', 'value' => false],
            ['name' => 'variety', 'title' => 'Variety', 'value' => false],
            ['name' => 'scientific', 'title' => 'Scientific', 'value' => false],
            ['name' => 'local_name', 'title' => 'Local Name', 'value' => false],
        ];
        return $this->sendResponse(compact('taxonomies', 'keys'), 'Nonflower Taxonomies retrieved successfully');
    }

    /**
     * @param NonflowerTaxonomyAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/nonflower_taxonomies",
     *      summary="Store a newly created NonflowerTaxonomy in storage",
     *      tags={"NonflowerTaxonomy"},
     *      description="Store NonflowerTaxonomy",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="genus_id",
     *          in="body",
     *          description="NonflowerTaxonomy that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/NonflowerTaxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="species_id",
     *          in="body",
     *          description="NonflowerTaxonomy that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/NonflowerTaxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="subspecies_id",
     *          in="body",
     *          description="NonflowerTaxonomy that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/NonflowerTaxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="variety_id",
     *          in="body",
     *          description="NonflowerTaxonomy that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/NonflowerTaxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="family_id",
     *          in="body",
     *          description="NonflowerTaxonomy that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/NonflowerTaxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="NonflowerTaxonomy that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/NonflowerTaxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="species_auth",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/NonflowerTaxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="subspecies_auth",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/NonflowerTaxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="variety_auth",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/NonflowerTaxonomy")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/NonflowerTaxonomy"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     * @throws ValidationException
     */
    public function store(NonflowerTaxonomyAPIRequest $request)
    {

        $taxonomy = $this->taxonomyRepository->create($request);

        return $this->sendResponse($taxonomy->toArray(), 'NonflowerTaxonomy saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/nonflower_taxonomies/{id}",
     *      summary="Display the specified NonflowerTaxonomy",
     *      tags={"NonflowerTaxonomy"},
     *      description="Get NonflowerTaxonomy",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of NonflowerTaxonomy",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/NonflowerTaxonomy"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var NonflowerTaxonomy $taxonomy */
        $taxonomy = $this->taxonomyRepository->find($id, $this->taxonomyRepository->getRelationFields());

        if ($taxonomy === null) {
            return $this->sendError('NonflowerTaxonomy not found');
        }

        return $this->sendResponse($taxonomy->toArray(), 'NonflowerTaxonomy retrieved successfully');
    }

    /**
     * @param int $id
     * @param NonflowerTaxonomyAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/nonflower_taxonomies/{id}",
     *      summary="Update the specified NonflowerTaxonomy in storage",
     *      tags={"NonflowerTaxonomy"},
     *      description="Update NonflowerTaxonomy",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of NonflowerTaxonomy",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="genus_id",
     *          in="body",
     *          description="NonflowerTaxonomy that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/NonflowerTaxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="species_id",
     *          in="body",
     *          description="NonflowerTaxonomy that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/NonflowerTaxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="subspecies_id",
     *          in="body",
     *          description="NonflowerTaxonomy that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/NonflowerTaxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="variety_id",
     *          in="body",
     *          description="NonflowerTaxonomy that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/NonflowerTaxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="family_id",
     *          in="body",
     *          description="NonflowerTaxonomy that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/NonflowerTaxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="NonflowerTaxonomy that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/NonflowerTaxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="species_auth",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/NonflowerTaxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="subspecies_auth",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/NonflowerTaxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="variety_auth",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/NonflowerTaxonomy")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/NonflowerTaxonomy"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     * @throws ValidationException
     */
    public function update(NonflowerTaxonomyAPIRequest $request, $id)
    {
        /** @var NonflowerTaxonomy $taxonomy */
        $taxonomy = $this->taxonomyRepository->find($id);

        if ($taxonomy === null) {
            return $this->sendError('NonflowerTaxonomy not found');
        }

        $taxonomy = $this->taxonomyRepository->update($request, $id);

        return $this->sendResponse($taxonomy->toArray(), 'NonflowerTaxonomy updated successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/nonflower_taxonomies/all",
     *      summary="get all Taxonomies Grouped By ",
     *      tags={"NonflowerTaxonomy"},
     *      description="get all Taxonomies Grouped By ",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="relation",
     *          in="query",
     *          required=false,
     *          type="array",
     *          @SWG\Items(type="string")
     *      ),
     *      @SWG\Parameter(
     *          name="groupby",
     *          in="query",
     *          required=false,
     *          type="string"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/NonflowerTaxonomy")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     * @throws Exception
     */
    public function all(Request $request)
    {
        $taxonomies = $this->taxonomyRepository->getByGroup($request, $this->taxonomyRepository->getRelationFields());

        return $this->sendResponse($taxonomies->toArray(), 'Nonflower Taxonomies retrieved successfully');
    }
}
