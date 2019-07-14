<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateSeedMolecularAPIRequest;
use App\Http\Requests\Api\UpdateSeedMolecularAPIRequest;
use App\Models\SeedMolecular;
use App\Repositories\SeedMolecularRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SeedMolecularController
 * @package App\Http\Controllers\Api
 */

class SeedMolecularAPIController extends AppBaseController
{
    /** @var  SeedMolecularRepository */
    private $seedMolecularRepository;

    public function __construct(SeedMolecularRepository $seedMolecularRepo)
    {
        $this->seedMolecularRepository = $seedMolecularRepo;
    }

    /**
     * Display a listing of the SeedMolecular.
     * GET|HEAD /seedMoleculars
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $seedMoleculars = $this->seedMolecularRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($seedMoleculars->toArray(), 'Seed Moleculars retrieved successfully');
    }

    /**
     * Store a newly created SeedMolecular in storage.
     * POST /seedMoleculars
     *
     * @param CreateSeedMolecularAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSeedMolecularAPIRequest $request)
    {
        $input = $request->all();

        $seedMolecular = $this->seedMolecularRepository->create($input);

        return $this->sendResponse($seedMolecular->toArray(), 'Seed Molecular saved successfully');
    }

    /**
     * Display the specified SeedMolecular.
     * GET|HEAD /seedMoleculars/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var SeedMolecular $seedMolecular */
        $seedMolecular = $this->seedMolecularRepository->find($id);

        if (empty($seedMolecular)) {
            return $this->sendError('Seed Molecular not found');
        }

        return $this->sendResponse($seedMolecular->toArray(), 'Seed Molecular retrieved successfully');
    }

    /**
     * Update the specified SeedMolecular in storage.
     * PUT/PATCH /seedMoleculars/{id}
     *
     * @param int $id
     * @param UpdateSeedMolecularAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSeedMolecularAPIRequest $request)
    {
        $input = $request->all();

        /** @var SeedMolecular $seedMolecular */
        $seedMolecular = $this->seedMolecularRepository->find($id);

        if (empty($seedMolecular)) {
            return $this->sendError('Seed Molecular not found');
        }

        $seedMolecular = $this->seedMolecularRepository->update($input, $id);

        return $this->sendResponse($seedMolecular->toArray(), 'SeedMolecular updated successfully');
    }

    /**
     * Remove the specified SeedMolecular from storage.
     * DELETE /seedMoleculars/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var SeedMolecular $seedMolecular */
        $seedMolecular = $this->seedMolecularRepository->find($id);

        if (empty($seedMolecular)) {
            return $this->sendError('Seed Molecular not found');
        }

        $seedMolecular->delete();

        return $this->sendResponse($id, 'Seed Molecular deleted successfully');
    }
}
