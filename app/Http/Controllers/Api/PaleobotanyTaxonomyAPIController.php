<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\Paleontology\PaleobotanyTaxonomyAPIRequest;
use App\Models\Taxonomy;
use App\Repositories\PaleobotanyTaxonomyRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use Response;

/**
 * Class PaleobotanyTaxonomyAPIController
 * @package App\Http\Controllers\Api
 */
class PaleobotanyTaxonomyAPIController extends AppBaseController
{
    /** @var  PaleobotanyTaxonomyRepository */
    private $paleobotanyTaxonomyRepository;

    public function __construct(PaleobotanyTaxonomyRepository $taxonomyRepo)
    {
        $this->paleobotanyTaxonomyRepository = $taxonomyRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/paleobotany_taxonomies",
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
     * @throws Exception
     */
    public function index(Request $request)
    {
        $taxonomies = $this->paleobotanyTaxonomyRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $this->getRelationFields()
        );

        return $this->sendResponse($taxonomies->toArray(), 'Paleobotany Taxonomies retrieved successfully');
    }

    /**
     * @return array
     */
    private function getRelationFields(): array
    {
        return ['family', 'genus', 'species.authors'];
    }

    /**
     * @param PaleobotanyTaxonomyAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/paleobotany_taxonomies",
     *      summary="Store a newly created Taxonomy in storage",
     *      tags={"Taxonomy"},
     *      description="Store Taxonomy",
     *      produces={"application/json"},
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
     *          name="infra_specific_id",
     *          in="body",
     *          description="Taxonomy that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Taxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="order_id",
     *          in="body",
     *          description="Taxonomy that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Taxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="family_id",
     *          in="body",
     *          description="Taxonomy that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Taxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="Taxonomy that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Taxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="species_auth",
     *          in="body",
     *          required=true,
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
     * @throws ValidationException
     */
    public function store(PaleobotanyTaxonomyAPIRequest $request)
    {

        $taxonomy = $this->paleobotanyTaxonomyRepository->create($request);

        return $this->sendResponse($taxonomy->toArray(), 'Paleobotany Taxonomy saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/paleobotany_taxonomies/{id}",
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
        $taxonomy = $this->paleobotanyTaxonomyRepository->find($id, $this->getRelationFields());

        if ($taxonomy === null) {
            return $this->sendError('Paleobotany Taxonomy not found');
        }

        return $this->sendResponse($taxonomy->toArray(), 'Paleobotany Taxonomy retrieved successfully');
    }

    /**
     * @param int $id
     * @param PaleobotanyTaxonomyAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/paleobotany_taxonomies/{id}",
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
     *          name="infra_specific_id",
     *          in="body",
     *          description="Taxonomy that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Taxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="order_id",
     *          in="body",
     *          description="Taxonomy that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Taxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="family_id",
     *          in="body",
     *          description="Taxonomy that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Taxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="Taxonomy that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Taxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="species_auth",
     *          in="body",
     *          required=true,
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
     * @throws ValidationException
     */
    public function update(PaleobotanyTaxonomyAPIRequest $request, $id)
    {
        /** @var Taxonomy $taxonomy */
        $taxonomy = $this->paleobotanyTaxonomyRepository->find($id);

        if ($taxonomy === null) {
            return $this->sendError('Paleobotany Taxonomy not found');
        }

        $taxonomy = $this->paleobotanyTaxonomyRepository->update($request, $id);

        return $this->sendResponse($taxonomy->toArray(), 'Paleobotany Taxonomy updated successfully');
    }

    /**
     * @param int $id
     * @param null $delete
     * @return Response
     *
     * @throws Exception
     * @SWG\Delete(
     *      path="/paleobotany_taxonomies/{id}",
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
     */
    public function destroy($id, $delete = null)
    {
        /** @var Taxonomy $taxonomy */
        $taxonomy = $this->paleobotanyTaxonomyRepository->find($id);

        if ($taxonomy === null) {
            return $this->sendError('Paleobotany Taxonomy not found');
        }
//
//        if (empty($delete)) {
//            $taxonomy = $taxonomy->loadCount(['flora', 'nonflower', 'herbarium', 'medicinalPlant', 'seedCollection', 'botanical', 'palebotany', 'chromosome', 'cryobank']);
//            return $this->sendResponse($taxonomy, 'Paleobotany Taxonomy retrieved successfully');
//        }

        if ($delete == 'delete') {
            $taxonomy->delete();
        }

        return $this->sendResponse($id, 'Paleobotany Taxonomy deleted successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/paleobotany_taxonomies/all",
     *      summary="get all Taxonomies Grouped By ",
     *      tags={"Taxonomy"},
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
     *                  @SWG\Items(ref="#/definitions/Taxonomy")
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
        $taxonomies = $this->paleobotanyTaxonomyRepository->getByGroup($request, $this->getRelationFields());

        return $this->sendResponse($taxonomies->toArray(), 'Paleobotany Taxonomies retrieved successfully');
    }

    public function excel(Request $request)
    {
        $taxonomies = $this->paleobotanyTaxonomyRepository->all(
            [],
            null,
            null,
            $this->getRelationFields()
        );
        return Excel::create('ExportTaxonomyList-' . date('Y-m-d-H-i-s'), function ($excel) use ($taxonomies) {

            $excel->sheet('Taxonomy', function ($sheet) use ($taxonomies) {

                $sheet->loadView('exports.taxonomies', compact('taxonomies'));

            });

        })->export('xls');
    }
}
