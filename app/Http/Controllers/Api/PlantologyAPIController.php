<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreatePlantologyAPIRequest;
use App\Http\Requests\Api\UpdatePlantologyAPIRequest;
use App\Models\Plantology;
use App\Repositories\PlantologyRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PlantologyController
 * @package App\Http\Controllers\Api
 */

class PlantologyAPIController extends AppBaseController
{
    /** @var  PlantologyRepository */
    private $plantologyRepository;

    public function __construct(PlantologyRepository $plantologyRepo)
    {
        $this->plantologyRepository = $plantologyRepo;
    }

    /**
     * Display a listing of the Plantology.
     * GET|HEAD /plantologies
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $plantologies = $this->plantologyRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($plantologies->toArray(), 'Plantologies retrieved successfully');
    }

    /**
     * Store a newly created Plantology in storage.
     * POST /plantologies
     *
     * @param CreatePlantologyAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePlantologyAPIRequest $request)
    {
        $input = $request->all();

        $plantology = $this->plantologyRepository->create($input);

        return $this->sendResponse($plantology->toArray(), 'Plantology saved successfully');
    }

    /**
     * Display the specified Plantology.
     * GET|HEAD /plantologies/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Plantology $plantology */
        $plantology = $this->plantologyRepository->find($id);

        if (empty($plantology)) {
            return $this->sendError('Plantology not found');
        }

        return $this->sendResponse($plantology->toArray(), 'Plantology retrieved successfully');
    }

    /**
     * Update the specified Plantology in storage.
     * PUT/PATCH /plantologies/{id}
     *
     * @param int $id
     * @param UpdatePlantologyAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePlantologyAPIRequest $request)
    {
        $input = $request->all();

        /** @var Plantology $plantology */
        $plantology = $this->plantologyRepository->find($id);

        if (empty($plantology)) {
            return $this->sendError('Plantology not found');
        }

        $plantology = $this->plantologyRepository->update($input, $id);

        return $this->sendResponse($plantology->toArray(), 'Plantology updated successfully');
    }

    /**
     * Remove the specified Plantology from storage.
     * DELETE /plantologies/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Plantology $plantology */
        $plantology = $this->plantologyRepository->find($id);

        if (empty($plantology)) {
            return $this->sendError('Plantology not found');
        }

        $plantology->delete();

        return $this->sendResponse($id, 'Plantology deleted successfully');
    }
}
