<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\Seed\SeedCollectionClimateAPIRequest;
use App\Http\Requests\Api\Seed\SeedCollectionPlantAPIRequest;
use App\Http\Requests\Api\Seed\SeedCollectionProjectAPIRequest;
use App\Http\Requests\Api\Seed\SeedCollectionSoilAPIRequest;
use App\Http\Requests\Api\SeedCollectionAPIRequest;
use App\Models\SeedCollection;
use App\Repositories\SeedCollectionRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Response;

/**
 * Class SeedCollectionController
 * @package App\Http\Controllers\Api
 */
class SeedCollectionAPIController extends AppBaseController
{
    /** @var  SeedCollectionRepository */
    private $seedCollectionRepository;

    public function __construct(SeedCollectionRepository $seedCollectionRepo)
    {
        $this->seedCollectionRepository = $seedCollectionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/seed_collections",
     *      summary="Get a listing of the SeedCollections.",
     *      tags={"SeedCollection"},
     *      description="Get all SeedCollections",
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
     *                  @SWG\Items(ref="#/definitions/SeedCollection")
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
        $seedCollections = $this->seedCollectionRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $this->getRelationFields()
        );

        return $this->sendResponse($seedCollections->toArray(), 'Seed Collections retrieved successfully');
    }

    private function getRelationFields()
    {
        return ['location', 'organization.city', 'organization:id,name_en,city_id', 'landForm', 'taxonomy', 'project', 'collect', 'drainage', 'fruitType', 'habitat', 'usedPart', 'growthForm', 'lifeForm', 'consumption', 'motherHealth', 'pollinationAgent', 'pollinationType', 'collectedFrom', 'slopeAspect', 'soilDepth', 'soilErosion', 'soilLime', 'soilSalinity', 'soilTexture', 'specimenType', 'associatedSpecies', 'communityTypes', 'climates', 'media', 'floweringTime', 'harvestingTime'];
    }

    /**
     * @param SeedCollectionAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/seed_collections",
     *      summary="Store a newly created SeedCollection in storage",
     *      tags={"SeedCollection"},
     *      description="Store SeedCollection",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="taxonomy_id",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="location",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="organization_id",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="voucher_no",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="accession_code",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="encoded_code_by_collector",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="corrected_code_by_nrgb",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="dna",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
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
     *                  ref="#/definitions/SeedCollection"
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
    public function store(SeedCollectionAPIRequest $request)
    {
        $input = $request->all();

        $seedCollection = $this->seedCollectionRepository->create($input);

        return $this->sendResponse($seedCollection->toArray(), 'Seed Collection saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/seed_collections/{id}",
     *      summary="Display the specified SeedCollection",
     *      tags={"SeedCollection"},
     *      description="Get SeedCollection",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedCollection",
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
     *                  ref="#/definitions/SeedCollection"
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
        /** @var SeedCollection $seedCollection */
        $seedCollection = $this->seedCollectionRepository->find($id, $this->getRelationFields());

        if (empty($seedCollection)) {
            return $this->sendError('Seed Collection not found');
        }

        return $this->sendResponse($seedCollection->toArray(), 'Seed Collection retrieved successfully');
    }

    /**
     * @param int $id
     * @param SeedCollectionAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/seed_collections/{id}",
     *      summary="Update the specified SeedCollection in storage",
     *      tags={"SeedCollection"},
     *      description="Update SeedCollection",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedCollection",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="taxonomy_id",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="location",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="organization_id",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="voucher_no",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="accession_code",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="encoded_code_by_collector",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="corrected_code_by_nrgb",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="dna",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
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
     *                  ref="#/definitions/SeedCollection"
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
    public function update($id, SeedCollectionAPIRequest $request)
    {
        $input = $request->all();

        /** @var SeedCollection $seedCollection */
        $seedCollection = $this->seedCollectionRepository->find($id);

        if (empty($seedCollection)) {
            return $this->sendError('Seed Collection not found');
        }

        $seedCollection = $this->seedCollectionRepository->update($input, $id);

        return $this->sendResponse($seedCollection->toArray(), 'SeedCollection updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *     * @SWG\Delete(
     *      path="/seed_collections/{id}",
     *      summary="Remove the specified SeedCollection from storage",
     *      tags={"SeedCollection"},
     *      description="Delete SeedCollection",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedCollection",
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
     * @throws Exception
     */
    public function destroy($id)
    {
        /** @var SeedCollection $seedCollection */
        $seedCollection = $this->seedCollectionRepository->find($id);

        if (empty($seedCollection)) {
            return $this->sendError('Seed Collection not found');
        }

        $seedCollection->delete();

        return $this->sendResponse($id, 'Seed Collection deleted successfully');
    }

    /**
     * @param int $id
     * @param SeedCollectionPlantAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/seed_collections/{id}/plant",
     *      summary="Update the specified SeedCollection in storage",
     *      tags={"SeedCollection"},
     *      description="Update SeedCollection",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedCollection",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="plant_consumption_value_id",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="general_used_part_id",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="community_types",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="area_sampled",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="plants_sampled_no",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="approximate_area_of_plant",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="flowering_time_id",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="pollination_type_id",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="pollination_agent_id",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="fruit_type_id",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="date_harvesting_id",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="plant_height",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="plant_mother_health_id",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="how_to_use",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="other_details",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="special_advise",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
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
     *                  ref="#/definitions/SeedCollection"
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
    public function storePlant($id, SeedCollectionPlantAPIRequest $request)
    {
        $input = $request->all();

        /** @var SeedCollection $seedCollection */
        $seedCollection = $this->seedCollectionRepository->find($id);

        if (empty($seedCollection)) {
            return $this->sendError('Seed Collection not found');
        }

        $seedCollection = $this->seedCollectionRepository->storePlantFlowering($input, $id);

        return $this->sendResponse($seedCollection->toArray(), 'SeedCollection updated successfully');
    }

    /**
     * @param int $id
     * @param SeedCollectionSoilAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/seed_collections/{id}/soil",
     *      summary="Update the specified SeedCollection in storage",
     *      tags={"SeedCollection"},
     *      description="Update SeedCollection",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedCollection",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="soil_depth_id",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="soil_texture_id",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="drainage_id",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="soil_ph",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="soil_salinity_id",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="soil_lime_id",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="soil_depth_id",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="soil_texture_id",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="drainage_id",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="soil_ph",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="soil_salinity_id",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="soil_lime_id",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="soil_erosion_id",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="soil_erosion_id",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
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
     *                  ref="#/definitions/SeedCollection"
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
    public function storeSoil($id, SeedCollectionSoilAPIRequest $request)
    {
        $input = $request->all();

        /** @var SeedCollection $seedCollection */
        $seedCollection = $this->seedCollectionRepository->find($id);

        if (empty($seedCollection)) {
            return $this->sendError('Seed Collection not found');
        }

        $seedCollection = $this->seedCollectionRepository->storeSoil($input, $id);

        return $this->sendResponse($seedCollection->toArray(), 'SeedCollection updated successfully');
    }

    /**
     * @param int $id
     * @param SeedCollectionClimateAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/seed_collections/{id}/climate",
     *      summary="Update the specified SeedCollection in storage",
     *      tags={"SeedCollection"},
     *      description="Update SeedCollection",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedCollection",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="land_form_id",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="slope_aspect_id",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="slope_degree",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="general_habitat_id",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="climate",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="community_type",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="land_form_id",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="slope_aspect_id",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="slope_degree",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="general_habitat_id",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="climate",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="community_type",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="specimen_type_id",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="specimen_type_id",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
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
     *                  ref="#/definitions/SeedCollection"
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
    public function storeClimate($id, SeedCollectionClimateAPIRequest $request)
    {
        $input = $request->all();

        /** @var SeedCollection $seedCollection */
        $seedCollection = $this->seedCollectionRepository->find($id);

        if (empty($seedCollection)) {
            return $this->sendError('Seed Collection not found');
        }

        $seedCollection = $this->seedCollectionRepository->storeClimate($input, $id);

        return $this->sendResponse($seedCollection->toArray(), 'SeedCollection updated successfully');
    }

    /**
     * @param int $id
     * @param SeedCollectionProjectAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/seed_collections/{id}/climate",
     *      summary="Update the specified SeedCollection in storage",
     *      tags={"SeedCollection"},
     *      description="Update SeedCollection",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedCollection",
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
     *                  ref="#/definitions/SeedCollection"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     * @throws ValidationException
     * @todo
     */
    public function storeProject($id, SeedCollectionProjectAPIRequest $request)
    {
        $input = $request->all();

        /** @var SeedCollection $seedCollection */
        $seedCollection = $this->seedCollectionRepository->find($id);

        if (empty($seedCollection)) {
            return $this->sendError('Seed Collection not found');
        }

        $seedCollection = $this->seedCollectionRepository->storeProject($input, $id);

        return $this->sendResponse($seedCollection->toArray(), 'SeedCollection updated successfully');
    }

    public function storeMedia($id, Request $request)
    {
        $input = $request->all();

        /** @var SeedCollection $seedCollection */
        $seedCollection = $this->seedCollectionRepository->find($id);

        if (empty($seedCollection)) {
            return $this->sendError('Seed Collection not found');
        }

        $this->seedCollectionRepository->storeMedia($input, $seedCollection);

        return $this->sendResponse([], 'SeedCollection updated successfully');
    }
}
