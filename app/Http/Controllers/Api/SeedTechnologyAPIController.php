<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateSeedTechnologyAPIRequest;
use App\Http\Requests\Api\UpdateSeedTechnologyAPIRequest;
use App\Models\SeedTechnology;
use App\Repositories\SeedTechnologyRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SeedTechnologyController
 * @package App\Http\Controllers\Api
 */

class SeedTechnologyAPIController extends AppBaseController
{
    /** @var  SeedTechnologyRepository */
    private $seedTechnologyRepository;

    public function __construct(SeedTechnologyRepository $seedTechnologyRepo)
    {
        $this->seedTechnologyRepository = $seedTechnologyRepo;
    }

    /**
     * Display a listing of the SeedTechnology.
     * GET|HEAD /seedTechnologies
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $seedTechnologies = $this->seedTechnologyRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($seedTechnologies->toArray(), 'Seed Technologies retrieved successfully');
    }

    /**
     * Store a newly created SeedTechnology in storage.
     * POST /seedTechnologies
     *
     * @param CreateSeedTechnologyAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSeedTechnologyAPIRequest $request)
    {
        $input = $request->all();

        $seedTechnology = $this->seedTechnologyRepository->create($input);

        return $this->sendResponse($seedTechnology->toArray(), 'Seed Technology saved successfully');
    }

    /**
     * Display the specified SeedTechnology.
     * GET|HEAD /seedTechnologies/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var SeedTechnology $seedTechnology */
        $seedTechnology = $this->seedTechnologyRepository->find($id);

        if (empty($seedTechnology)) {
            return $this->sendError('Seed Technology not found');
        }

        return $this->sendResponse($seedTechnology->toArray(), 'Seed Technology retrieved successfully');
    }

    /**
     * Update the specified SeedTechnology in storage.
     * PUT/PATCH /seedTechnologies/{id}
     *
     * @param int $id
     * @param UpdateSeedTechnologyAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSeedTechnologyAPIRequest $request)
    {
        $input = $request->all();

        /** @var SeedTechnology $seedTechnology */
        $seedTechnology = $this->seedTechnologyRepository->find($id);

        if (empty($seedTechnology)) {
            return $this->sendError('Seed Technology not found');
        }

        $seedTechnology = $this->seedTechnologyRepository->update($input, $id);

        return $this->sendResponse($seedTechnology->toArray(), 'SeedTechnology updated successfully');
    }

    /**
     * Remove the specified SeedTechnology from storage.
     * DELETE /seedTechnologies/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var SeedTechnology $seedTechnology */
        $seedTechnology = $this->seedTechnologyRepository->find($id);

        if (empty($seedTechnology)) {
            return $this->sendError('Seed Technology not found');
        }

        $seedTechnology->delete();

        return $this->sendResponse($id, 'Seed Technology deleted successfully');
    }
}
