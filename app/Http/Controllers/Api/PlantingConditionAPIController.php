<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\CreatePlantingConditionAPIRequest;
use App\Http\Requests\Api\UpdatePlantingConditionAPIRequest;
use App\Models\PlantingCondition;
use App\Repositories\PlantingConditionRepository;
use Exception;
use Illuminate\Http\Request;
use Response;

/**
 * Class PlantingConditionController
 * @package App\Http\Controllers\Api
 */
class PlantingConditionAPIController extends AppBaseController
{
    /** @var  PlantingConditionRepository */
    private $plantingConditionRepository;

    public function __construct(PlantingConditionRepository $plantingConditionRepo)
    {
        $this->plantingConditionRepository = $plantingConditionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/plantingConditions",
     *      summary="Get a listing of the PlantingConditions.",
     *      tags={"PlantingCondition"},
     *      description="Get all PlantingConditions",
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
     *                  @SWG\Items(ref="#/definitions/PlantingCondition")
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
        $plantingConditions = $this->plantingConditionRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($plantingConditions->toArray(), 'Planting Conditions retrieved successfully');
    }

    /**
     * @param CreatePlantingConditionAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/plantingConditions",
     *      summary="Store a newly created PlantingCondition in storage",
     *      tags={"PlantingCondition"},
     *      description="Store PlantingCondition",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="PlantingCondition that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PlantingCondition")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="PlantingCondition that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantingCondition")
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
     *                  ref="#/definitions/PlantingCondition"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePlantingConditionAPIRequest $request)
    {
        $input = $request->all();

        $plantingCondition = $this->plantingConditionRepository->create($input);

        return $this->sendResponse($plantingCondition->toArray(), 'Planting Condition saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/plantingConditions/{id}",
     *      summary="Display the specified PlantingCondition",
     *      tags={"PlantingCondition"},
     *      description="Get PlantingCondition",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of PlantingCondition",
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
     *                  ref="#/definitions/PlantingCondition"
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
        /** @var PlantingCondition $plantingCondition */
        $plantingCondition = $this->plantingConditionRepository->find($id);

        if (empty($plantingCondition)) {
            return $this->sendError('Planting Condition not found');
        }

        return $this->sendResponse($plantingCondition->toArray(), 'Planting Condition retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePlantingConditionAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/plantingConditions/{id}",
     *      summary="Update the specified PlantingCondition in storage",
     *      tags={"PlantingCondition"},
     *      description="Update PlantingCondition",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of PlantingCondition",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="PlantingCondition that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PlantingCondition")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="PlantingCondition that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantingCondition")
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
     *                  ref="#/definitions/PlantingCondition"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePlantingConditionAPIRequest $request)
    {
        $input = $request->all();

        /** @var PlantingCondition $plantingCondition */
        $plantingCondition = $this->plantingConditionRepository->find($id);

        if (empty($plantingCondition)) {
            return $this->sendError('Planting Condition not found');
        }

        $plantingCondition = $this->plantingConditionRepository->update($input, $id);

        return $this->sendResponse($plantingCondition->toArray(), 'PlantingCondition updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/plantingConditions/{id}",
     *      summary="Remove the specified PlantingCondition from storage",
     *      tags={"PlantingCondition"},
     *      description="Delete PlantingCondition",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of PlantingCondition",
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
        /** @var PlantingCondition $plantingCondition */
        $plantingCondition = $this->plantingConditionRepository->find($id);

        if (empty($plantingCondition)) {
            return $this->sendError('Planting Condition not found');
        }

        $plantingCondition->delete();

        return $this->sendResponse($id, 'Planting Condition deleted successfully');
    }
}
