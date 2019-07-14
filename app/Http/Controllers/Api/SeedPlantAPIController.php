<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateSeedPlantAPIRequest;
use App\Http\Requests\Api\UpdateSeedPlantAPIRequest;
use App\Models\SeedPlant;
use App\Repositories\SeedPlantRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SeedPlantController
 * @package App\Http\Controllers\Api
 */

class SeedPlantAPIController extends AppBaseController
{
    /** @var  SeedPlantRepository */
    private $seedPlantRepository;

    public function __construct(SeedPlantRepository $seedPlantRepo)
    {
        $this->seedPlantRepository = $seedPlantRepo;
    }

    /**
     * Display a listing of the SeedPlant.
     * GET|HEAD /seedPlants
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $seedPlants = $this->seedPlantRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($seedPlants->toArray(), 'Seed Plants retrieved successfully');
    }

    /**
     * Store a newly created SeedPlant in storage.
     * POST /seedPlants
     *
     * @param CreateSeedPlantAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSeedPlantAPIRequest $request)
    {
        $input = $request->all();

        $seedPlant = $this->seedPlantRepository->create($input);

        return $this->sendResponse($seedPlant->toArray(), 'Seed Plant saved successfully');
    }

    /**
     * Display the specified SeedPlant.
     * GET|HEAD /seedPlants/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var SeedPlant $seedPlant */
        $seedPlant = $this->seedPlantRepository->find($id);

        if (empty($seedPlant)) {
            return $this->sendError('Seed Plant not found');
        }

        return $this->sendResponse($seedPlant->toArray(), 'Seed Plant retrieved successfully');
    }

    /**
     * Update the specified SeedPlant in storage.
     * PUT/PATCH /seedPlants/{id}
     *
     * @param int $id
     * @param UpdateSeedPlantAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSeedPlantAPIRequest $request)
    {
        $input = $request->all();

        /** @var SeedPlant $seedPlant */
        $seedPlant = $this->seedPlantRepository->find($id);

        if (empty($seedPlant)) {
            return $this->sendError('Seed Plant not found');
        }

        $seedPlant = $this->seedPlantRepository->update($input, $id);

        return $this->sendResponse($seedPlant->toArray(), 'SeedPlant updated successfully');
    }

    /**
     * Remove the specified SeedPlant from storage.
     * DELETE /seedPlants/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var SeedPlant $seedPlant */
        $seedPlant = $this->seedPlantRepository->find($id);

        if (empty($seedPlant)) {
            return $this->sendError('Seed Plant not found');
        }

        $seedPlant->delete();

        return $this->sendResponse($id, 'Seed Plant deleted successfully');
    }
}
