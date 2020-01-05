<?php

namespace App\Http\Controllers\Api;

use App\Exports\TaxonomyExport;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\TaxonomyAPIRequest;
use App\Models\Taxonomy;
use App\Repositories\TaxonomyRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
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
        $taxonomies = $this->taxonomyRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $this->getRelationFields()
        );

        return $this->sendResponse($taxonomies->toArray(), 'Taxonomies retrieved successfully');
    }

    /**
     * @return array
     */
    private function getRelationFields(): array
    {
        return ['family', 'genus', 'species.authors', 'subspecies.authors', 'variety.authors'];
    }

    /**
     * @param TaxonomyAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/taxonomies",
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
     *      @SWG\Parameter(
     *          name="subspecies_auth",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Taxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="variety_auth",
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
    public function store(TaxonomyAPIRequest $request)
    {

        $taxonomy = $this->taxonomyRepository->create($request);

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
        $taxonomy = $this->taxonomyRepository->find($id, $this->getRelationFields());

        if ($taxonomy === null) {
            return $this->sendError('Taxonomy not found');
        }

        return $this->sendResponse($taxonomy->toArray(), 'Taxonomy retrieved successfully');
    }

    /**
     * @param int $id
     * @param TaxonomyAPIRequest $request
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
     *      @SWG\Parameter(
     *          name="subspecies_auth",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Taxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="variety_auth",
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
    public function update(TaxonomyAPIRequest $request, $id)
    {
        /** @var Taxonomy $taxonomy */
        $taxonomy = $this->taxonomyRepository->find($id);

        if ($taxonomy === null) {
            return $this->sendError('Taxonomy not found');
        }

        $taxonomy = $this->taxonomyRepository->update($request, $id);

        return $this->sendResponse($taxonomy->toArray(), 'Taxonomy updated successfully');
    }

    /**
     * @param int $id
     * @param null $delete
     * @return Response
     *
     * @throws Exception
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
     */
    public function destroy($id, $delete = null)
    {
        /** @var Taxonomy $taxonomy */
        $taxonomy = $this->taxonomyRepository->find($id);

        if ($taxonomy === null) {
            return $this->sendError('Taxonomy not found');
        }

        if (empty($delete)) {
            $taxonomy->loadCount(['flora', 'nonflower', 'herbarium', 'medicinalPlant', 'seedCollection', 'botanical', 'palebotany', 'chromosome', 'cryobank']);
        }

        if ($delete == 'delete') {
            $taxonomy->delete();
        }

        return $this->sendResponse($id, 'Taxonomy deleted successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/taxonomies/all",
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
        $taxonomies = $this->taxonomyRepository->getByGroup($request, $this->getRelationFields());

        return $this->sendResponse($taxonomies->toArray(), 'Taxonomies retrieved successfully');
    }

    public function excel(Request $request)
    {
        $taxonomies = $this->taxonomyRepository->all(
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
