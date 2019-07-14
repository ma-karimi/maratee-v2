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
     * Display a listing of the PlantingFactor.
     * GET|HEAD /plantingFactors
     *
     * @param Request $request
     * @return Response
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
     * Store a newly created PlantingFactor in storage.
     * POST /plantingFactors
     *
     * @param CreatePlantingFactorAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePlantingFactorAPIRequest $request)
    {
        $input = $request->all();

        $plantingFactor = $this->plantingFactorRepository->create($input);

        return $this->sendResponse($plantingFactor->toArray(), 'Planting Factor saved successfully');
    }

    /**
     * Display the specified PlantingFactor.
     * GET|HEAD /plantingFactors/{id}
     *
     * @param int $id
     *
     * @return Response
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
     * Update the specified PlantingFactor in storage.
     * PUT/PATCH /plantingFactors/{id}
     *
     * @param int $id
     * @param UpdatePlantingFactorAPIRequest $request
     *
     * @return Response
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
     * Remove the specified PlantingFactor from storage.
     * DELETE /plantingFactors/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
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
