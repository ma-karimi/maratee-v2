<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateSeedChemicalAPIRequest;
use App\Http\Requests\Api\UpdateSeedChemicalAPIRequest;
use App\Models\SeedChemical;
use App\Repositories\SeedChemicalRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SeedChemicalController
 * @package App\Http\Controllers\Api
 */

class SeedChemicalAPIController extends AppBaseController
{
    /** @var  SeedChemicalRepository */
    private $seedChemicalRepository;

    public function __construct(SeedChemicalRepository $seedChemicalRepo)
    {
        $this->seedChemicalRepository = $seedChemicalRepo;
    }

    /**
     * Display a listing of the SeedChemical.
     * GET|HEAD /seedChemicals
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $seedChemicals = $this->seedChemicalRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($seedChemicals->toArray(), 'Seed Chemicals retrieved successfully');
    }

    /**
     * Store a newly created SeedChemical in storage.
     * POST /seedChemicals
     *
     * @param CreateSeedChemicalAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSeedChemicalAPIRequest $request)
    {
        $input = $request->all();

        $seedChemical = $this->seedChemicalRepository->create($input);

        return $this->sendResponse($seedChemical->toArray(), 'Seed Chemical saved successfully');
    }

    /**
     * Display the specified SeedChemical.
     * GET|HEAD /seedChemicals/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var SeedChemical $seedChemical */
        $seedChemical = $this->seedChemicalRepository->find($id);

        if (empty($seedChemical)) {
            return $this->sendError('Seed Chemical not found');
        }

        return $this->sendResponse($seedChemical->toArray(), 'Seed Chemical retrieved successfully');
    }

    /**
     * Update the specified SeedChemical in storage.
     * PUT/PATCH /seedChemicals/{id}
     *
     * @param int $id
     * @param UpdateSeedChemicalAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSeedChemicalAPIRequest $request)
    {
        $input = $request->all();

        /** @var SeedChemical $seedChemical */
        $seedChemical = $this->seedChemicalRepository->find($id);

        if (empty($seedChemical)) {
            return $this->sendError('Seed Chemical not found');
        }

        $seedChemical = $this->seedChemicalRepository->update($input, $id);

        return $this->sendResponse($seedChemical->toArray(), 'SeedChemical updated successfully');
    }

    /**
     * Remove the specified SeedChemical from storage.
     * DELETE /seedChemicals/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var SeedChemical $seedChemical */
        $seedChemical = $this->seedChemicalRepository->find($id);

        if (empty($seedChemical)) {
            return $this->sendError('Seed Chemical not found');
        }

        $seedChemical->delete();

        return $this->sendResponse($id, 'Seed Chemical deleted successfully');
    }
}
