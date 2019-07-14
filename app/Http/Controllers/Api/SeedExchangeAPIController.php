<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateSeedExchangeAPIRequest;
use App\Http\Requests\Api\UpdateSeedExchangeAPIRequest;
use App\Models\SeedExchange;
use App\Repositories\SeedExchangeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SeedExchangeController
 * @package App\Http\Controllers\Api
 */

class SeedExchangeAPIController extends AppBaseController
{
    /** @var  SeedExchangeRepository */
    private $seedExchangeRepository;

    public function __construct(SeedExchangeRepository $seedExchangeRepo)
    {
        $this->seedExchangeRepository = $seedExchangeRepo;
    }

    /**
     * Display a listing of the SeedExchange.
     * GET|HEAD /seedExchanges
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $seedExchanges = $this->seedExchangeRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($seedExchanges->toArray(), 'Seed Exchanges retrieved successfully');
    }

    /**
     * Store a newly created SeedExchange in storage.
     * POST /seedExchanges
     *
     * @param CreateSeedExchangeAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSeedExchangeAPIRequest $request)
    {
        $input = $request->all();

        $seedExchange = $this->seedExchangeRepository->create($input);

        return $this->sendResponse($seedExchange->toArray(), 'Seed Exchange saved successfully');
    }

    /**
     * Display the specified SeedExchange.
     * GET|HEAD /seedExchanges/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var SeedExchange $seedExchange */
        $seedExchange = $this->seedExchangeRepository->find($id);

        if (empty($seedExchange)) {
            return $this->sendError('Seed Exchange not found');
        }

        return $this->sendResponse($seedExchange->toArray(), 'Seed Exchange retrieved successfully');
    }

    /**
     * Update the specified SeedExchange in storage.
     * PUT/PATCH /seedExchanges/{id}
     *
     * @param int $id
     * @param UpdateSeedExchangeAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSeedExchangeAPIRequest $request)
    {
        $input = $request->all();

        /** @var SeedExchange $seedExchange */
        $seedExchange = $this->seedExchangeRepository->find($id);

        if (empty($seedExchange)) {
            return $this->sendError('Seed Exchange not found');
        }

        $seedExchange = $this->seedExchangeRepository->update($input, $id);

        return $this->sendResponse($seedExchange->toArray(), 'SeedExchange updated successfully');
    }

    /**
     * Remove the specified SeedExchange from storage.
     * DELETE /seedExchanges/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var SeedExchange $seedExchange */
        $seedExchange = $this->seedExchangeRepository->find($id);

        if (empty($seedExchange)) {
            return $this->sendError('Seed Exchange not found');
        }

        $seedExchange->delete();

        return $this->sendResponse($id, 'Seed Exchange deleted successfully');
    }
}
