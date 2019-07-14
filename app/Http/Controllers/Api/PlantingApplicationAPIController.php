<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreatePlantingApplicationAPIRequest;
use App\Http\Requests\Api\UpdatePlantingApplicationAPIRequest;
use App\Models\PlantingApplication;
use App\Repositories\PlantingApplicationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PlantingApplicationController
 * @package App\Http\Controllers\Api
 */

class PlantingApplicationAPIController extends AppBaseController
{
    /** @var  PlantingApplicationRepository */
    private $plantingApplicationRepository;

    public function __construct(PlantingApplicationRepository $plantingApplicationRepo)
    {
        $this->plantingApplicationRepository = $plantingApplicationRepo;
    }

    /**
     * Display a listing of the PlantingApplication.
     * GET|HEAD /plantingApplications
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $plantingApplications = $this->plantingApplicationRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($plantingApplications->toArray(), 'Planting Applications retrieved successfully');
    }

    /**
     * Store a newly created PlantingApplication in storage.
     * POST /plantingApplications
     *
     * @param CreatePlantingApplicationAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePlantingApplicationAPIRequest $request)
    {
        $input = $request->all();

        $plantingApplication = $this->plantingApplicationRepository->create($input);

        return $this->sendResponse($plantingApplication->toArray(), 'Planting Application saved successfully');
    }

    /**
     * Display the specified PlantingApplication.
     * GET|HEAD /plantingApplications/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var PlantingApplication $plantingApplication */
        $plantingApplication = $this->plantingApplicationRepository->find($id);

        if (empty($plantingApplication)) {
            return $this->sendError('Planting Application not found');
        }

        return $this->sendResponse($plantingApplication->toArray(), 'Planting Application retrieved successfully');
    }

    /**
     * Update the specified PlantingApplication in storage.
     * PUT/PATCH /plantingApplications/{id}
     *
     * @param int $id
     * @param UpdatePlantingApplicationAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePlantingApplicationAPIRequest $request)
    {
        $input = $request->all();

        /** @var PlantingApplication $plantingApplication */
        $plantingApplication = $this->plantingApplicationRepository->find($id);

        if (empty($plantingApplication)) {
            return $this->sendError('Planting Application not found');
        }

        $plantingApplication = $this->plantingApplicationRepository->update($input, $id);

        return $this->sendResponse($plantingApplication->toArray(), 'PlantingApplication updated successfully');
    }

    /**
     * Remove the specified PlantingApplication from storage.
     * DELETE /plantingApplications/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var PlantingApplication $plantingApplication */
        $plantingApplication = $this->plantingApplicationRepository->find($id);

        if (empty($plantingApplication)) {
            return $this->sendError('Planting Application not found');
        }

        $plantingApplication->delete();

        return $this->sendResponse($id, 'Planting Application deleted successfully');
    }
}
