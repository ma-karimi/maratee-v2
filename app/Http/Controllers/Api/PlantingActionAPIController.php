<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreatePlantingActionAPIRequest;
use App\Http\Requests\Api\UpdatePlantingActionAPIRequest;
use App\Models\PlantingAction;
use App\Repositories\PlantingActionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PlantingActionController
 * @package App\Http\Controllers\Api
 */

class PlantingActionAPIController extends AppBaseController
{
    /** @var  PlantingActionRepository */
    private $plantingActionRepository;

    public function __construct(PlantingActionRepository $plantingActionRepo)
    {
        $this->plantingActionRepository = $plantingActionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/plantingActions",
     *      summary="Get a listing of the PlantingActions.",
     *      tags={"PlantingAction"},
     *      description="Get all PlantingActions",
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
     *                  @SWG\Items(ref="#/definitions/PlantingAction")
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
        $plantingActions = $this->plantingActionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($plantingActions->toArray(), 'Planting Actions retrieved successfully');
    }

    /**
     * @param CreatePlantingActionAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/plantingActions",
     *      summary="Store a newly created PlantingAction in storage",
     *      tags={"PlantingAction"},
     *      description="Store PlantingAction",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="PlantingAction that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PlantingAction")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="PlantingAction that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantingAction")
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
     *                  ref="#/definitions/PlantingAction"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePlantingActionAPIRequest $request)
    {
        $input = $request->all();

        $plantingAction = $this->plantingActionRepository->create($input);

        return $this->sendResponse($plantingAction->toArray(), 'Planting Action saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/plantingActions/{id}",
     *      summary="Display the specified PlantingAction",
     *      tags={"PlantingAction"},
     *      description="Get PlantingAction",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of PlantingAction",
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
     *                  ref="#/definitions/PlantingAction"
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
        /** @var PlantingAction $plantingAction */
        $plantingAction = $this->plantingActionRepository->find($id);

        if (empty($plantingAction)) {
            return $this->sendError('Planting Action not found');
        }

        return $this->sendResponse($plantingAction->toArray(), 'Planting Action retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePlantingActionAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/plantingActions/{id}",
     *      summary="Update the specified PlantingAction in storage",
     *      tags={"PlantingAction"},
     *      description="Update PlantingAction",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of PlantingAction",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="PlantingAction that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PlantingAction")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="PlantingAction that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantingAction")
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
     *                  ref="#/definitions/PlantingAction"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePlantingActionAPIRequest $request)
    {
        $input = $request->all();

        /** @var PlantingAction $plantingAction */
        $plantingAction = $this->plantingActionRepository->find($id);

        if (empty($plantingAction)) {
            return $this->sendError('Planting Action not found');
        }

        $plantingAction = $this->plantingActionRepository->update($input, $id);

        return $this->sendResponse($plantingAction->toArray(), 'PlantingAction updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/plantingActions/{id}",
     *      summary="Remove the specified PlantingAction from storage",
     *      tags={"PlantingAction"},
     *      description="Delete PlantingAction",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of PlantingAction",
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
        /** @var PlantingAction $plantingAction */
        $plantingAction = $this->plantingActionRepository->find($id);

        if (empty($plantingAction)) {
            return $this->sendError('Planting Action not found');
        }

        $plantingAction->delete();

        return $this->sendResponse($id, 'Planting Action deleted successfully');
    }
}
