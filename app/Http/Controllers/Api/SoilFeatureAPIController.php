<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateSoilFeatureAPIRequest;
use App\Http\Requests\Api\UpdateSoilFeatureAPIRequest;
use App\Models\SoilFeature;
use App\Repositories\SoilFeatureRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SoilFeatureController
 * @package App\Http\Controllers\Api
 */

class SoilFeatureAPIController extends AppBaseController
{
    /** @var  SoilFeatureRepository */
    private $soilFeatureRepository;

    public function __construct(SoilFeatureRepository $soilFeatureRepo)
    {
        $this->soilFeatureRepository = $soilFeatureRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/soilFeatures",
     *      summary="Get a listing of the SoilFeatures.",
     *      tags={"SoilFeature"},
     *      description="Get all SoilFeatures",
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
     *                  @SWG\Items(ref="#/definitions/SoilFeature")
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
        $soilFeatures = $this->soilFeatureRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($soilFeatures->toArray(), 'Soil Features retrieved successfully');
    }

    /**
     * @param CreateSoilFeatureAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/soilFeatures",
     *      summary="Store a newly created SoilFeature in storage",
     *      tags={"SoilFeature"},
     *      description="Store SoilFeature",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="SoilFeature that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SoilFeature")
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
     *                  ref="#/definitions/SoilFeature"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSoilFeatureAPIRequest $request)
    {
        $input = $request->all();

        $soilFeature = $this->soilFeatureRepository->create($input);

        return $this->sendResponse($soilFeature->toArray(), 'Soil Feature saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/soilFeatures/{id}",
     *      summary="Display the specified SoilFeature",
     *      tags={"SoilFeature"},
     *      description="Get SoilFeature",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SoilFeature",
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
     *                  ref="#/definitions/SoilFeature"
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
        /** @var SoilFeature $soilFeature */
        $soilFeature = $this->soilFeatureRepository->find($id);

        if (empty($soilFeature)) {
            return $this->sendError('Soil Feature not found');
        }

        return $this->sendResponse($soilFeature->toArray(), 'Soil Feature retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateSoilFeatureAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/soilFeatures/{id}",
     *      summary="Update the specified SoilFeature in storage",
     *      tags={"SoilFeature"},
     *      description="Update SoilFeature",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SoilFeature",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="SoilFeature that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SoilFeature")
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
     *                  ref="#/definitions/SoilFeature"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSoilFeatureAPIRequest $request)
    {
        $input = $request->all();

        /** @var SoilFeature $soilFeature */
        $soilFeature = $this->soilFeatureRepository->find($id);

        if (empty($soilFeature)) {
            return $this->sendError('Soil Feature not found');
        }

        $soilFeature = $this->soilFeatureRepository->update($input, $id);

        return $this->sendResponse($soilFeature->toArray(), 'SoilFeature updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/soilFeatures/{id}",
     *      summary="Remove the specified SoilFeature from storage",
     *      tags={"SoilFeature"},
     *      description="Delete SoilFeature",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SoilFeature",
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
        /** @var SoilFeature $soilFeature */
        $soilFeature = $this->soilFeatureRepository->find($id);

        if (empty($soilFeature)) {
            return $this->sendError('Soil Feature not found');
        }

        $soilFeature->delete();

        return $this->sendResponse($id, 'Soil Feature deleted successfully');
    }
}
