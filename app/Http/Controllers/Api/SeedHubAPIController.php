<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateSeedHubAPIRequest;
use App\Http\Requests\Api\UpdateSeedHubAPIRequest;
use App\Models\SeedHub;
use App\Repositories\SeedHubRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SeedHubController
 * @package App\Http\Controllers\Api
 */

class SeedHubAPIController extends AppBaseController
{
    /** @var  SeedHubRepository */
    private $seedHubRepository;

    public function __construct(SeedHubRepository $seedHubRepo)
    {
        $this->seedHubRepository = $seedHubRepo;
    }

    /**
     * Display a listing of the SeedHub.
     * GET|HEAD /seedHubs
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $seedHubs = $this->seedHubRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($seedHubs->toArray(), 'Seed Hubs retrieved successfully');
    }

    /**
     * Store a newly created SeedHub in storage.
     * POST /seedHubs
     *
     * @param CreateSeedHubAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSeedHubAPIRequest $request)
    {
        $input = $request->all();

        $seedHub = $this->seedHubRepository->create($input);

        return $this->sendResponse($seedHub->toArray(), 'Seed Hub saved successfully');
    }

    /**
     * Display the specified SeedHub.
     * GET|HEAD /seedHubs/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var SeedHub $seedHub */
        $seedHub = $this->seedHubRepository->find($id);

        if (empty($seedHub)) {
            return $this->sendError('Seed Hub not found');
        }

        return $this->sendResponse($seedHub->toArray(), 'Seed Hub retrieved successfully');
    }

    /**
     * Update the specified SeedHub in storage.
     * PUT/PATCH /seedHubs/{id}
     *
     * @param int $id
     * @param UpdateSeedHubAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSeedHubAPIRequest $request)
    {
        $input = $request->all();

        /** @var SeedHub $seedHub */
        $seedHub = $this->seedHubRepository->find($id);

        if (empty($seedHub)) {
            return $this->sendError('Seed Hub not found');
        }

        $seedHub = $this->seedHubRepository->update($input, $id);

        return $this->sendResponse($seedHub->toArray(), 'SeedHub updated successfully');
    }

    /**
     * Remove the specified SeedHub from storage.
     * DELETE /seedHubs/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var SeedHub $seedHub */
        $seedHub = $this->seedHubRepository->find($id);

        if (empty($seedHub)) {
            return $this->sendError('Seed Hub not found');
        }

        $seedHub->delete();

        return $this->sendResponse($id, 'Seed Hub deleted successfully');
    }
}
