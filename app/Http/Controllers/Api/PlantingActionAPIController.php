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
     * Display a listing of the PlantingAction.
     * GET|HEAD /plantingActions
     *
     * @param Request $request
     * @return Response
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
     * Store a newly created PlantingAction in storage.
     * POST /plantingActions
     *
     * @param CreatePlantingActionAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePlantingActionAPIRequest $request)
    {
        $input = $request->all();

        $plantingAction = $this->plantingActionRepository->create($input);

        return $this->sendResponse($plantingAction->toArray(), 'Planting Action saved successfully');
    }

    /**
     * Display the specified PlantingAction.
     * GET|HEAD /plantingActions/{id}
     *
     * @param int $id
     *
     * @return Response
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
     * Update the specified PlantingAction in storage.
     * PUT/PATCH /plantingActions/{id}
     *
     * @param int $id
     * @param UpdatePlantingActionAPIRequest $request
     *
     * @return Response
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
     * Remove the specified PlantingAction from storage.
     * DELETE /plantingActions/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
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
