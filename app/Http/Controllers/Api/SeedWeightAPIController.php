<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateSeedWeightAPIRequest;
use App\Http\Requests\Api\UpdateSeedWeightAPIRequest;
use App\Models\SeedWeight;
use App\Repositories\SeedWeightRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SeedWeightController
 * @package App\Http\Controllers\Api
 */

class SeedWeightAPIController extends AppBaseController
{
    /** @var  SeedWeightRepository */
    private $seedWeightRepository;

    public function __construct(SeedWeightRepository $seedWeightRepo)
    {
        $this->seedWeightRepository = $seedWeightRepo;
    }

    /**
     * Display a listing of the SeedWeight.
     * GET|HEAD /seedWeights
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $seedWeights = $this->seedWeightRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($seedWeights->toArray(), 'Seed Weights retrieved successfully');
    }

    /**
     * Store a newly created SeedWeight in storage.
     * POST /seedWeights
     *
     * @param CreateSeedWeightAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSeedWeightAPIRequest $request)
    {
        $input = $request->all();

        $seedWeight = $this->seedWeightRepository->create($input);

        return $this->sendResponse($seedWeight->toArray(), 'Seed Weight saved successfully');
    }

    /**
     * Display the specified SeedWeight.
     * GET|HEAD /seedWeights/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var SeedWeight $seedWeight */
        $seedWeight = $this->seedWeightRepository->find($id);

        if (empty($seedWeight)) {
            return $this->sendError('Seed Weight not found');
        }

        return $this->sendResponse($seedWeight->toArray(), 'Seed Weight retrieved successfully');
    }

    /**
     * Update the specified SeedWeight in storage.
     * PUT/PATCH /seedWeights/{id}
     *
     * @param int $id
     * @param UpdateSeedWeightAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSeedWeightAPIRequest $request)
    {
        $input = $request->all();

        /** @var SeedWeight $seedWeight */
        $seedWeight = $this->seedWeightRepository->find($id);

        if (empty($seedWeight)) {
            return $this->sendError('Seed Weight not found');
        }

        $seedWeight = $this->seedWeightRepository->update($input, $id);

        return $this->sendResponse($seedWeight->toArray(), 'SeedWeight updated successfully');
    }

    /**
     * Remove the specified SeedWeight from storage.
     * DELETE /seedWeights/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var SeedWeight $seedWeight */
        $seedWeight = $this->seedWeightRepository->find($id);

        if (empty($seedWeight)) {
            return $this->sendError('Seed Weight not found');
        }

        $seedWeight->delete();

        return $this->sendResponse($id, 'Seed Weight deleted successfully');
    }
}
