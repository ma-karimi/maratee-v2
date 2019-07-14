<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateReproductionAPIRequest;
use App\Http\Requests\Api\UpdateReproductionAPIRequest;
use App\Models\Reproduction;
use App\Repositories\ReproductionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ReproductionController
 * @package App\Http\Controllers\Api
 */

class ReproductionAPIController extends AppBaseController
{
    /** @var  ReproductionRepository */
    private $reproductionRepository;

    public function __construct(ReproductionRepository $reproductionRepo)
    {
        $this->reproductionRepository = $reproductionRepo;
    }

    /**
     * Display a listing of the Reproduction.
     * GET|HEAD /reproductions
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $reproductions = $this->reproductionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($reproductions->toArray(), 'Reproductions retrieved successfully');
    }

    /**
     * Store a newly created Reproduction in storage.
     * POST /reproductions
     *
     * @param CreateReproductionAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateReproductionAPIRequest $request)
    {
        $input = $request->all();

        $reproduction = $this->reproductionRepository->create($input);

        return $this->sendResponse($reproduction->toArray(), 'Reproduction saved successfully');
    }

    /**
     * Display the specified Reproduction.
     * GET|HEAD /reproductions/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Reproduction $reproduction */
        $reproduction = $this->reproductionRepository->find($id);

        if (empty($reproduction)) {
            return $this->sendError('Reproduction not found');
        }

        return $this->sendResponse($reproduction->toArray(), 'Reproduction retrieved successfully');
    }

    /**
     * Update the specified Reproduction in storage.
     * PUT/PATCH /reproductions/{id}
     *
     * @param int $id
     * @param UpdateReproductionAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateReproductionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Reproduction $reproduction */
        $reproduction = $this->reproductionRepository->find($id);

        if (empty($reproduction)) {
            return $this->sendError('Reproduction not found');
        }

        $reproduction = $this->reproductionRepository->update($input, $id);

        return $this->sendResponse($reproduction->toArray(), 'Reproduction updated successfully');
    }

    /**
     * Remove the specified Reproduction from storage.
     * DELETE /reproductions/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Reproduction $reproduction */
        $reproduction = $this->reproductionRepository->find($id);

        if (empty($reproduction)) {
            return $this->sendError('Reproduction not found');
        }

        $reproduction->delete();

        return $this->sendResponse($id, 'Reproduction deleted successfully');
    }
}
