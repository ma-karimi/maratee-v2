<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Paleontology\PaleontologyAPIRequest;
use App\Http\Requests\Api\Paleontology\PaleontologyGeologyRemarkAPIRequest;
use App\Http\Requests\Api\Paleontology\PaleontologyInformationAPIRequest;
use App\Http\Requests\Api\Paleontology\PaleontologyLocalityAPIRequest;
use App\Models\Paleontology;
use App\Repositories\PaleontologyRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PaleontologyController
 * @package App\Http\Controllers\Api
 */

class PaleontologyAPIController extends AppBaseController
{
    /** @var  PaleontologyRepository */
    private $paleontologyRepository;

    public function __construct(PaleontologyRepository $paleontologyRepo)
    {
        $this->paleontologyRepository = $paleontologyRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/paleontologies",
     *      summary="Get a listing of the Paleontologies.",
     *      tags={"Paleontology"},
     *      description="Get all Paleontologies",
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
     *                  @SWG\Items(ref="#/definitions/Paleontology")
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
        $paleontologies = $this->paleontologyRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $this->fieldRelations()
        );

        return $this->sendResponse($paleontologies->toArray(), 'Paleontologies retrieved successfully');
    }

    /**
     * @param PaleontologyAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/paleontologies",
     *      summary="Store a newly created Paleontology in storage",
     *      tags={"Paleontology"},
     *      description="Store Paleontology",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="catalog_no",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
     *      ),
     *      @SWG\Parameter(
     *          name="specimen_no",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
     *      ),
     *      @SWG\Parameter(
     *          name="field_no",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
     *      ),
     *      @SWG\Parameter(
     *          name="field_no",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
     *      ),
     *      @SWG\Parameter(
     *          name="barcode_no",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
     *      ),
     *      @SWG\Parameter(
     *          name="taxonomy_id",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
     *      ),
     *      @SWG\Parameter(
     *          name="location_in_collection",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
     *      ),
     *      @SWG\Parameter(
     *          name="general_order_id",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
     *      ),
     *      @SWG\Parameter(
     *          name="general_plant_type_id",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
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
     *                  ref="#/definitions/Paleontology"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(PaleontologyAPIRequest $request)
    {

        $paleontology = $this->paleontologyRepository->create($request);

        return $this->sendResponse($paleontology->toArray(), 'Paleontology saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/paleontologies/{id}",
     *      summary="Display the specified Paleontology",
     *      tags={"Paleontology"},
     *      description="Get Paleontology",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Paleontology",
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
     *                  ref="#/definitions/Paleontology"
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
        /** @var Paleontology $paleontology */
        $paleontology = $this->paleontologyRepository->find($id, $this->fieldRelations());

        if (empty($paleontology)) {
            return $this->sendError('Paleontology not found');
        }

        return $this->sendResponse($paleontology->toArray(), 'Paleontology retrieved successfully');
    }

    /**
     * @param int $id
     * @param PaleontologyAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/paleontologies/{id}",
     *      summary="Update the specified Paleontology in storage",
     *      tags={"Paleontology"},
     *      description="Update Paleontology",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Paleontology",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="catalog_no",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
     *      ),
     *      @SWG\Parameter(
     *          name="specimen_no",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
     *      ),
     *      @SWG\Parameter(
     *          name="field_no",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
     *      ),
     *      @SWG\Parameter(
     *          name="field_no",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
     *      ),
     *      @SWG\Parameter(
     *          name="barcode_no",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
     *      ),
     *      @SWG\Parameter(
     *          name="taxonomy_id",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
     *      ),
     *      @SWG\Parameter(
     *          name="location_in_collection",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
     *      ),
     *      @SWG\Parameter(
     *          name="general_order_id",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
     *      ),
     *      @SWG\Parameter(
     *          name="general_plant_type_id",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
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
     *                  ref="#/definitions/Paleontology"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, PaleontologyAPIRequest $request)
    {

        /** @var Paleontology $paleontology */
        $paleontology = $this->paleontologyRepository->find($id);

        if (empty($paleontology)) {
            return $this->sendError('Paleontology not found');
        }

        $paleontology = $this->paleontologyRepository->update($request, $id);

        return $this->sendResponse($paleontology->toArray(), 'Paleontology updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/paleontologies/{id}",
     *      summary="Remove the specified Paleontology from storage",
     *      tags={"Paleontology"},
     *      description="Delete Paleontology",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Paleontology",
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
    public function destroy($id)
    {
        /** @var Paleontology $paleontology */
        $paleontology = $this->paleontologyRepository->find($id);

        if (empty($paleontology)) {
            return $this->sendError('Paleontology not found');
        }

        $paleontology->delete();

        return $this->sendResponse($id, 'Paleontology deleted successfully');
    }

    private function fieldRelations(){
        return ['taxonomy', 'generalClass', 'generalOrder', 'geologyAgePeriod', 'geologyAgeStage', 'geologyAgeEpoch', 'geologyAgeEra', 'generalPlantType', 'locality.location', 'maps', 'collect', 'determine', 'media'];
    }


    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Post(
     *      path="/paleontologies/{id}/media",
     *      tags={"Paleontology"},
     *      description="Store Paleontology Media",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Plant",
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
    public function media($id)
    {
        $plant = $this->paleontologyRepository->find($id, []);

        if (empty($plant)) {
            return $this->sendError('Paleontology not found');
        }

        $this->paleontologyRepository->storeMedia(\request()->all(), $plant);

        return $this->sendResponse($id, 'Paleontology Media Stored successfully');
    }

    /**
     * @param int $id
     * @param PaleontologyLocalityAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/paleontologies/{id}/locality",
     *      summary="Update the specified Paleontology in storage",
     *      tags={"Paleontology"},
     *      description="Update Paleontology",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Paleontology",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="location_id",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
     *      ),
     *      @SWG\Parameter(
     *          name="paleontology_id",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
     *      ),
     *      @SWG\Parameter(
     *          name="formation",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
     *      ),
     *      @SWG\Parameter(
     *          name="layer",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
     *      ),
     *      @SWG\Parameter(
     *          name="stratigraphy",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
     *      ),
     *      @SWG\Parameter(
     *          name="lithology",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
     *      ),
     *      @SWG\Parameter(
     *          name="fauna",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
     *      ),
     *      @SWG\Parameter(
     *          name="locality_description",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
     *      ),
     *      @SWG\Parameter(
     *          name="village",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
     *      ),
     *      @SWG\Parameter(
     *          name="city_id",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
     *      ),
     *      @SWG\Parameter(
     *          name="province_id",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
     *      ),
     *      @SWG\Parameter(
     *          name="address_en",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
     *      ),
     *      @SWG\Parameter(
     *          name="region_name",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
     *      ),
     *      @SWG\Parameter(
     *          name="address_fa",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
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
     *                  ref="#/definitions/Paleontology"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function locality($id, PaleontologyLocalityAPIRequest $request)
    {

        /** @var Paleontology $paleontology */
        $paleontology = $this->paleontologyRepository->find($id);

        if ($paleontology === null) {
            return $this->sendError('Paleontology not found');
        }

        $paleontology = $this->paleontologyRepository->update($request, $id);

        return $this->sendResponse($paleontology->toArray(), 'Paleontology Locality updated successfully');
    }


    /**
     * @param int $id
     * @param PaleontologyGeologyRemarkAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/paleontologies/{id}/geology-remark",
     *      summary="Update the specified Paleontology in storage",
     *      tags={"Paleontology"},
     *      description="Update Paleontology",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Paleontology",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="geology_age_era_id",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
     *      ),
     *      @SWG\Parameter(
     *          name="geology_age_epoch_id",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
     *      ),
     *      @SWG\Parameter(
     *          name="geology_age_period_id",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
     *      ),
     *      @SWG\Parameter(
     *          name="geology_age_stage_id",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
     *      ),
     *      @SWG\Parameter(
     *          name="last_update",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
     *      ),
     *      @SWG\Parameter(
     *          name="access_code",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
     *      ),
     *      @SWG\Parameter(
     *          name="update_frequency",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
     *      ),
     *      @SWG\Parameter(
     *          name="additional_info",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
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
     *                  ref="#/definitions/Paleontology"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function geologyAndRemark($id, PaleontologyGeologyRemarkAPIRequest $request)
    {

        /** @var Paleontology $paleontology */
        $paleontology = $this->paleontologyRepository->find($id);

        if ($paleontology === null) {
            return $this->sendError('Paleontology not found');
        }

        $paleontology = $this->paleontologyRepository->storeGeologyAndRemark($request, $id);

        return $this->sendResponse($paleontology->toArray(), 'Paleontology Geology updated successfully');
    }
    /**
     * @param int $id
     * @param PaleontologyInformationAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/paleontologies/{id}/information",
     *      summary="Update the specified Paleontology in storage",
     *      tags={"Paleontology"},
     *      description="Update Paleontology",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Paleontology",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="preservation",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
     *      ),
     *      @SWG\Parameter(
     *          name="pieces",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
     *      ),
     *      @SWG\Parameter(
     *          name="color",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
     *      ),
     *      @SWG\Parameter(
     *          name="element",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
     *      ),
     *      @SWG\Parameter(
     *          name="treatment_history",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
     *      ),
     *      @SWG\Parameter(
     *          name="determines",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
     *      ),
     *      @SWG\Parameter(
     *          name="identify_date",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
     *      ),
     *      @SWG\Parameter(
     *          name="collectors",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
     *      ),
     *      @SWG\Parameter(
     *          name="collecting_date",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
     *      ),
     *      @SWG\Parameter(
     *          name="field_notes",
     *          in="body",
     *          description="Paleontology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Paleontology")
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
     *                  ref="#/definitions/Paleontology"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function information($id, PaleontologyInformationAPIRequest $request)
    {

        /** @var Paleontology $paleontology */
        $paleontology = $this->paleontologyRepository->find($id);

        if ($paleontology === null) {
            return $this->sendError('Paleontology not found');
        }

        $paleontology = $this->paleontologyRepository->storeOtherData($request, $id);

        return $this->sendResponse($paleontology->toArray(), 'Paleontology Information updated successfully');
    }
}
