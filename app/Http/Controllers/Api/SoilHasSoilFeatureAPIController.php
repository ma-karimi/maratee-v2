<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateSoilHasSoilFeatureAPIRequest;
use App\Http\Requests\Api\UpdateSoilHasSoilFeatureAPIRequest;
use App\Models\SoilHasSoilFeature;
use App\Repositories\SoilHasSoilFeatureRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SoilHasSoilFeatureController
 * @package App\Http\Controllers\Api
 */

class SoilHasSoilFeatureAPIController extends AppBaseController
{
    /** @var  SoilHasSoilFeatureRepository */
    private $soilHasSoilFeatureRepository;

    public function __construct(SoilHasSoilFeatureRepository $soilHasSoilFeatureRepo)
    {
        $this->soilHasSoilFeatureRepository = $soilHasSoilFeatureRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/soilHasSoilFeatures",
     *      summary="Get a listing of the SoilHasSoilFeatures.",
     *      tags={"SoilHasSoilFeature"},
     *      description="Get all SoilHasSoilFeatures",
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
     *                  @SWG\Items(ref="#/definitions/SoilHasSoilFeature")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $soilHasSoilFeatures = $this->soilHasSoilFeatureRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($soilHasSoilFeatures->toArray(), 'Soil Has Soil Features retrieved successfully');
    }

    /**
     * @param CreateSoilHasSoilFeatureAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/soilHasSoilFeatures",
     *      summary="Store a newly created SoilHasSoilFeature in storage",
     *      tags={"SoilHasSoilFeature"},
     *      description="Store SoilHasSoilFeature",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="soil_id",
     *          in="body",
     *          description="SoilHasSoilFeature that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SoilHasSoilFeature")
     *      ),
     *       @SWG\Parameter(
     *          name="soil_feature_id",
     *          in="body",
     *          description="SoilHasSoilFeature that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SoilHasSoilFeature")
     *      ),
     *       @SWG\Parameter(
     *          name="value",
     *          in="body",
     *          description="SoilHasSoilFeature that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SoilHasSoilFeature")
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
     *                  ref="#/definitions/SoilHasSoilFeature"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSoilHasSoilFeatureAPIRequest $request)
    {
        $input = $request->all();

        $soilHasSoilFeature = $this->soilHasSoilFeatureRepository->create($input);

        return $this->sendResponse($soilHasSoilFeature->toArray(), 'Soil Has Soil Feature saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/soilHasSoilFeatures/{id}",
     *      summary="Display the specified SoilHasSoilFeature",
     *      tags={"SoilHasSoilFeature"},
     *      description="Get SoilHasSoilFeature",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SoilHasSoilFeature",
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
     *                  ref="#/definitions/SoilHasSoilFeature"
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
        /** @var SoilHasSoilFeature $soilHasSoilFeature */
        $soilHasSoilFeature = $this->soilHasSoilFeatureRepository->find($id);

        if (empty($soilHasSoilFeature)) {
            return $this->sendError('Soil Has Soil Feature not found');
        }

        return $this->sendResponse($soilHasSoilFeature->toArray(), 'Soil Has Soil Feature retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateSoilHasSoilFeatureAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/soilHasSoilFeatures/{id}",
     *      summary="Update the specified SoilHasSoilFeature in storage",
     *      tags={"SoilHasSoilFeature"},
     *      description="Update SoilHasSoilFeature",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SoilHasSoilFeature",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="soil_id",
     *          in="body",
     *          description="SoilHasSoilFeature that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SoilHasSoilFeature")
     *      ),
     *       @SWG\Parameter(
     *          name="soil_feature_id",
     *          in="body",
     *          description="SoilHasSoilFeature that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SoilHasSoilFeature")
     *      ),
     *       @SWG\Parameter(
     *          name="value",
     *          in="body",
     *          description="SoilHasSoilFeature that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SoilHasSoilFeature")
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
     *                  ref="#/definitions/SoilHasSoilFeature"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSoilHasSoilFeatureAPIRequest $request)
    {
        $input = $request->all();

        /** @var SoilHasSoilFeature $soilHasSoilFeature */
        $soilHasSoilFeature = $this->soilHasSoilFeatureRepository->find($id);

        if (empty($soilHasSoilFeature)) {
            return $this->sendError('Soil Has Soil Feature not found');
        }

        $soilHasSoilFeature = $this->soilHasSoilFeatureRepository->update($input, $id);

        return $this->sendResponse($soilHasSoilFeature->toArray(), 'SoilHasSoilFeature updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/soilHasSoilFeatures/{id}",
     *      summary="Remove the specified SoilHasSoilFeature from storage",
     *      tags={"SoilHasSoilFeature"},
     *      description="Delete SoilHasSoilFeature",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SoilHasSoilFeature",
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
        /** @var SoilHasSoilFeature $soilHasSoilFeature */
        $soilHasSoilFeature = $this->soilHasSoilFeatureRepository->find($id);

        if (empty($soilHasSoilFeature)) {
            return $this->sendError('Soil Has Soil Feature not found');
        }

        $soilHasSoilFeature->delete();

        return $this->sendResponse($id, 'Soil Has Soil Feature deleted successfully');
    }
}
