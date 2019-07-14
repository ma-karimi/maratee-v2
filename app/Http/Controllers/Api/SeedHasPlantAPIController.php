<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateSeedHasPlantAPIRequest;
use App\Http\Requests\Api\UpdateSeedHasPlantAPIRequest;
use App\Models\SeedHasPlant;
use App\Repositories\SeedHasPlantRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SeedHasPlantController
 * @package App\Http\Controllers\Api
 */

class SeedHasPlantAPIController extends AppBaseController
{
    /** @var  SeedHasPlantRepository */
    private $seedHasPlantRepository;

    public function __construct(SeedHasPlantRepository $seedHasPlantRepo)
    {
        $this->seedHasPlantRepository = $seedHasPlantRepo;
    }

    /**
     * Display a listing of the SeedHasPlant.
     * GET|HEAD /seedHasPlants
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $seedHasPlants = $this->seedHasPlantRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($seedHasPlants->toArray(), 'Seed Has Plants retrieved successfully');
    }

    /**
     * Store a newly created SeedHasPlant in storage.
     * POST /seedHasPlants
     *
     * @param CreateSeedHasPlantAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSeedHasPlantAPIRequest $request)
    {
        $input = $request->all();

        $seedHasPlant = $this->seedHasPlantRepository->create($input);

        return $this->sendResponse($seedHasPlant->toArray(), 'Seed Has Plant saved successfully');
    }

    /**
     * Display the specified SeedHasPlant.
     * GET|HEAD /seedHasPlants/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var SeedHasPlant $seedHasPlant */
        $seedHasPlant = $this->seedHasPlantRepository->find($id);

        if (empty($seedHasPlant)) {
            return $this->sendError('Seed Has Plant not found');
        }

        return $this->sendResponse($seedHasPlant->toArray(), 'Seed Has Plant retrieved successfully');
    }

    /**
     * Update the specified SeedHasPlant in storage.
     * PUT/PATCH /seedHasPlants/{id}
     *
     * @param int $id
     * @param UpdateSeedHasPlantAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSeedHasPlantAPIRequest $request)
    {
        $input = $request->all();

        /** @var SeedHasPlant $seedHasPlant */
        $seedHasPlant = $this->seedHasPlantRepository->find($id);

        if (empty($seedHasPlant)) {
            return $this->sendError('Seed Has Plant not found');
        }

        $seedHasPlant = $this->seedHasPlantRepository->update($input, $id);

        return $this->sendResponse($seedHasPlant->toArray(), 'SeedHasPlant updated successfully');
    }

    /**
     * Remove the specified SeedHasPlant from storage.
     * DELETE /seedHasPlants/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var SeedHasPlant $seedHasPlant */
        $seedHasPlant = $this->seedHasPlantRepository->find($id);

        if (empty($seedHasPlant)) {
            return $this->sendError('Seed Has Plant not found');
        }

        $seedHasPlant->delete();

        return $this->sendResponse($id, 'Seed Has Plant deleted successfully');
    }
}
