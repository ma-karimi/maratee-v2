<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreatePlantAPIRequest;
use App\Http\Requests\Api\UpdatePlantAPIRequest;
use App\Models\Plant;
use App\Repositories\PlantRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PlantController
 * @package App\Http\Controllers\Api
 */

class PlantAPIController extends AppBaseController
{
    /** @var  PlantRepository */
    private $plantRepository;

    public function __construct(PlantRepository $plantRepo)
    {
        $this->plantRepository = $plantRepo;
    }

    /**
     * Display a listing of the Plant.
     * GET|HEAD /plants
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $plants = $this->plantRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($plants->toArray(), 'Plants retrieved successfully');
    }

    /**
     * Store a newly created Plant in storage.
     * POST /plants
     *
     * @param CreatePlantAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePlantAPIRequest $request)
    {
        $input = $request->all();

        $plant = $this->plantRepository->create($input);

        return $this->sendResponse($plant->toArray(), 'Plant saved successfully');
    }

    /**
     * Display the specified Plant.
     * GET|HEAD /plants/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Plant $plant */
        $plant = $this->plantRepository->find($id);

        if (empty($plant)) {
            return $this->sendError('Plant not found');
        }

        return $this->sendResponse($plant->toArray(), 'Plant retrieved successfully');
    }

    /**
     * Update the specified Plant in storage.
     * PUT/PATCH /plants/{id}
     *
     * @param int $id
     * @param UpdatePlantAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePlantAPIRequest $request)
    {
        $input = $request->all();

        /** @var Plant $plant */
        $plant = $this->plantRepository->find($id);

        if (empty($plant)) {
            return $this->sendError('Plant not found');
        }

        $plant = $this->plantRepository->update($input, $id);

        return $this->sendResponse($plant->toArray(), 'Plant updated successfully');
    }

    /**
     * Remove the specified Plant from storage.
     * DELETE /plants/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Plant $plant */
        $plant = $this->plantRepository->find($id);

        if (empty($plant)) {
            return $this->sendError('Plant not found');
        }

        $plant->delete();

        return $this->sendResponse($id, 'Plant deleted successfully');
    }
}
