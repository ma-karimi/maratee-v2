<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateSeedAPIRequest;
use App\Http\Requests\Api\UpdateSeedAPIRequest;
use App\Models\Seed;
use App\Repositories\SeedRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SeedController
 * @package App\Http\Controllers\Api
 */

class SeedAPIController extends AppBaseController
{
    /** @var  SeedRepository */
    private $seedRepository;

    public function __construct(SeedRepository $seedRepo)
    {
        $this->seedRepository = $seedRepo;
    }

    /**
     * Display a listing of the Seed.
     * GET|HEAD /seeds
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $seeds = $this->seedRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($seeds->toArray(), 'Seeds retrieved successfully');
    }

    /**
     * Store a newly created Seed in storage.
     * POST /seeds
     *
     * @param CreateSeedAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSeedAPIRequest $request)
    {
        $input = $request->all();

        $seed = $this->seedRepository->create($input);

        return $this->sendResponse($seed->toArray(), 'Seed saved successfully');
    }

    /**
     * Display the specified Seed.
     * GET|HEAD /seeds/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Seed $seed */
        $seed = $this->seedRepository->find($id);

        if (empty($seed)) {
            return $this->sendError('Seed not found');
        }

        return $this->sendResponse($seed->toArray(), 'Seed retrieved successfully');
    }

    /**
     * Update the specified Seed in storage.
     * PUT/PATCH /seeds/{id}
     *
     * @param int $id
     * @param UpdateSeedAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSeedAPIRequest $request)
    {
        $input = $request->all();

        /** @var Seed $seed */
        $seed = $this->seedRepository->find($id);

        if (empty($seed)) {
            return $this->sendError('Seed not found');
        }

        $seed = $this->seedRepository->update($input, $id);

        return $this->sendResponse($seed->toArray(), 'Seed updated successfully');
    }

    /**
     * Remove the specified Seed from storage.
     * DELETE /seeds/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Seed $seed */
        $seed = $this->seedRepository->find($id);

        if (empty($seed)) {
            return $this->sendError('Seed not found');
        }

        $seed->delete();

        return $this->sendResponse($id, 'Seed deleted successfully');
    }
}
