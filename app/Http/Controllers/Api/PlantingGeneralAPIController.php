<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreatePlantingGeneralAPIRequest;
use App\Http\Requests\Api\UpdatePlantingGeneralAPIRequest;
use App\Models\PlantingGeneral;
use App\Repositories\PlantingGeneralRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PlantingGeneralController
 * @package App\Http\Controllers\Api
 */

class PlantingGeneralAPIController extends AppBaseController
{
    /** @var  PlantingGeneralRepository */
    private $plantingGeneralRepository;

    public function __construct(PlantingGeneralRepository $plantingGeneralRepo)
    {
        $this->plantingGeneralRepository = $plantingGeneralRepo;
    }

    /**
     * Display a listing of the PlantingGeneral.
     * GET|HEAD /plantingGenerals
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $plantingGenerals = $this->plantingGeneralRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($plantingGenerals->toArray(), 'Planting Generals retrieved successfully');
    }

    /**
     * Store a newly created PlantingGeneral in storage.
     * POST /plantingGenerals
     *
     * @param CreatePlantingGeneralAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePlantingGeneralAPIRequest $request)
    {
        $input = $request->all();

        $plantingGeneral = $this->plantingGeneralRepository->create($input);

        return $this->sendResponse($plantingGeneral->toArray(), 'Planting General saved successfully');
    }

    /**
     * Display the specified PlantingGeneral.
     * GET|HEAD /plantingGenerals/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var PlantingGeneral $plantingGeneral */
        $plantingGeneral = $this->plantingGeneralRepository->find($id);

        if (empty($plantingGeneral)) {
            return $this->sendError('Planting General not found');
        }

        return $this->sendResponse($plantingGeneral->toArray(), 'Planting General retrieved successfully');
    }

    /**
     * Update the specified PlantingGeneral in storage.
     * PUT/PATCH /plantingGenerals/{id}
     *
     * @param int $id
     * @param UpdatePlantingGeneralAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePlantingGeneralAPIRequest $request)
    {
        $input = $request->all();

        /** @var PlantingGeneral $plantingGeneral */
        $plantingGeneral = $this->plantingGeneralRepository->find($id);

        if (empty($plantingGeneral)) {
            return $this->sendError('Planting General not found');
        }

        $plantingGeneral = $this->plantingGeneralRepository->update($input, $id);

        return $this->sendResponse($plantingGeneral->toArray(), 'PlantingGeneral updated successfully');
    }

    /**
     * Remove the specified PlantingGeneral from storage.
     * DELETE /plantingGenerals/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var PlantingGeneral $plantingGeneral */
        $plantingGeneral = $this->plantingGeneralRepository->find($id);

        if (empty($plantingGeneral)) {
            return $this->sendError('Planting General not found');
        }

        $plantingGeneral->delete();

        return $this->sendResponse($id, 'Planting General deleted successfully');
    }
}
