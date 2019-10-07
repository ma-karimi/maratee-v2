<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateTaxonomyAPIRequest;
use App\Http\Requests\Api\UpdateTaxonomyAPIRequest;
use App\Models\ScientificView;
use App\Models\Taxonomy;
use App\Repositories\TaxonomyRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\DB;
use Response;

/**
 * Class TaxonomyController
 * @package App\Http\Controllers\Api
 */

class TaxonomyAPIController extends AppBaseController
{
    /** @var  TaxonomyRepository */
    private $taxonomyRepository;

    public function __construct(TaxonomyRepository $taxonomyRepo)
    {
        $this->taxonomyRepository = $taxonomyRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/taxonomies",
     *      summary="Get a listing of the Taxonomies.",
     *      tags={"Taxonomy"},
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
     *                  @SWG\Items(ref="#/definitions/Taxonomy")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     * @throws \Exception
     */
    public function index(Request $request)
    {
        $taxonomies = $this->taxonomyRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($taxonomies->toArray(), 'Taxonomies retrieved successfully');
    }

    /**
     * @param CreateTaxonomyAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/taxonomies",
     *      summary="Store a newly created Taxonomy in storage",
     *      tags={"Taxonomy"},
     *      description="Store Taxonomy",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="plant_id",
     *          in="body",
     *          description="Taxonomy that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Taxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="genus_id",
     *          in="body",
     *          description="Taxonomy that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Taxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="species_id",
     *          in="body",
     *          description="Taxonomy that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Taxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="subspecies_id",
     *          in="body",
     *          description="Taxonomy that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Taxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="variety_id",
     *          in="body",
     *          description="Taxonomy that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Taxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="family_id",
     *          in="body",
     *          description="Taxonomy that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Taxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="type_description",
     *          in="body",
     *          description="Taxonomy that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Taxonomy")
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
     *                  ref="#/definitions/Taxonomy"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTaxonomyAPIRequest $request)
    {
        $input = $request->all();

        $taxonomy = $this->taxonomyRepository->create($input);

        return $this->sendResponse($taxonomy->toArray(), 'Taxonomy saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/taxonomies/{id}",
     *      summary="Display the specified Taxonomy",
     *      tags={"Taxonomy"},
     *      description="Get Taxonomy",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Taxonomy",
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
     *                  ref="#/definitions/Taxonomy"
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
        /** @var Taxonomy $taxonomy */
        $taxonomy = $this->taxonomyRepository->find($id);

        if (empty($taxonomy)) {
            return $this->sendError('Taxonomy not found');
        }

        return $this->sendResponse($taxonomy->toArray(), 'Taxonomy retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateTaxonomyAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/taxonomies/{id}",
     *      summary="Update the specified Taxonomy in storage",
     *      tags={"Taxonomy"},
     *      description="Update Taxonomy",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Taxonomy",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="plant_id",
     *          in="body",
     *          description="Taxonomy that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Taxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="genus_id",
     *          in="body",
     *          description="Taxonomy that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Taxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="species_id",
     *          in="body",
     *          description="Taxonomy that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Taxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="subspecies_id",
     *          in="body",
     *          description="Taxonomy that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Taxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="variety_id",
     *          in="body",
     *          description="Taxonomy that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Taxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="family_id",
     *          in="body",
     *          description="Taxonomy that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Taxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="type_description",
     *          in="body",
     *          description="Taxonomy that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Taxonomy")
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
     *                  ref="#/definitions/Taxonomy"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTaxonomyAPIRequest $request)
    {
        $input = $request->all();

        /** @var Taxonomy $taxonomy */
        $taxonomy = $this->taxonomyRepository->find($id);

        if ($taxonomy === null) {
            return $this->sendError('Taxonomy not found');
        }

        $taxonomy = $this->taxonomyRepository->update($input, $id);

        return $this->sendResponse($taxonomy->toArray(), 'Taxonomy updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/taxonomies/{id}",
     *      summary="Remove the specified Taxonomy from storage",
     *      tags={"Taxonomy"},
     *      description="Delete Taxonomy",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Taxonomy",
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
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var Taxonomy $taxonomy */
        $taxonomy = $this->taxonomyRepository->find($id);

        if ($taxonomy === null) {
            return $this->sendError('Taxonomy not found');
        }

        $taxonomy->delete();

        return $this->sendResponse($id, 'Taxonomy deleted successfully');
    }
}
