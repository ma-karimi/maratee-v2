<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreatePlantingFactorAPIRequest;
use App\Http\Requests\Api\UpdatePlantingFactorAPIRequest;
use App\Models\PlantingFactor;
use App\Repositories\PlantingFactorRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PlantingFactorController
 * @package App\Http\Controllers\Api
 */

class PlantingFactorAPIController extends AppBaseController
{
    /** @var  PlantingFactorRepository */
    private $plantingFactorRepository;

    public function __construct(PlantingFactorRepository $plantingFactorRepo)
    {
        $this->plantingFactorRepository = $plantingFactorRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/plantingFactors",
     *      summary="Get a listing of the PlantingFactors.",
     *      tags={"PlantingFactor"},
     *      description="Get all PlantingFactors",
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
     *                  @SWG\Items(ref="#/definitions/PlantingFactor")
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
        $plantingFactors = $this->plantingFactorRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($plantingFactors->toArray(), 'Planting Factors retrieved successfully');
    }

    /**
     * @param CreatePlantingFactorAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/plantingFactors",
     *      summary="Store a newly created PlantingFactor in storage",
     *      tags={"PlantingFactor"},
     *      description="Store PlantingFactor",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="PlantingFactor that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantingFactor")
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
     *                  ref="#/definitions/PlantingFactor"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePlantingFactorAPIRequest $request)
    {
        $input = $request->all();

        $plantingFactor = $this->plantingFactorRepository->create($input);

        return $this->sendResponse($plantingFactor->toArray(), 'Planting Factor saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/plantingFactors/{id}",
     *      summary="Display the specified PlantingFactor",
     *      tags={"PlantingFactor"},
     *      description="Get PlantingFactor",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of PlantingFactor",
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
     *                  ref="#/definitions/PlantingFactor"
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
        /** @var PlantingFactor $plantingFactor */
        $plantingFactor = $this->plantingFactorRepository->find($id);

        if (empty($plantingFactor)) {
            return $this->sendError('Planting Factor not found');
        }

        return $this->sendResponse($plantingFactor->toArray(), 'Planting Factor retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePlantingFactorAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/plantingFactors/{id}",
     *      summary="Update the specified PlantingFactor in storage",
     *      tags={"PlantingFactor"},
     *      description="Update PlantingFactor",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of PlantingFactor",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="PlantingFactor that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantingFactor")
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
     *                  ref="#/definitions/PlantingFactor"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePlantingFactorAPIRequest $request)
    {
        $input = $request->all();

        /** @var PlantingFactor $plantingFactor */
        $plantingFactor = $this->plantingFactorRepository->find($id);

        if (empty($plantingFactor)) {
            return $this->sendError('Planting Factor not found');
        }

        $plantingFactor = $this->plantingFactorRepository->update($input, $id);

        return $this->sendResponse($plantingFactor->toArray(), 'PlantingFactor updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/plantingFactors/{id}",
     *      summary="Remove the specified PlantingFactor from storage",
     *      tags={"PlantingFactor"},
     *      description="Delete PlantingFactor",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of PlantingFactor",
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
        /** @var PlantingFactor $plantingFactor */
        $plantingFactor = $this->plantingFactorRepository->find($id);

        if (empty($plantingFactor)) {
            return $this->sendError('Planting Factor not found');
        }

        $plantingFactor->delete();

        return $this->sendResponse($id, 'Planting Factor deleted successfully');
    }
}
