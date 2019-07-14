<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateContinentAPIRequest;
use App\Http\Requests\Api\UpdateContinentAPIRequest;
use App\Models\Continent;
use App\Repositories\ContinentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ContinentController
 * @package App\Http\Controllers\Api
 */

class ContinentAPIController extends AppBaseController
{
    /** @var  ContinentRepository */
    private $continentRepository;

    public function __construct(ContinentRepository $continentRepo)
    {
        $this->continentRepository = $continentRepo;
    }

    /**
     * Display a listing of the Continent.
     * GET|HEAD /continents
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $continents = $this->continentRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($continents->toArray(), 'Continents retrieved successfully');
    }

    /**
     * Store a newly created Continent in storage.
     * POST /continents
     *
     * @param CreateContinentAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateContinentAPIRequest $request)
    {
        $input = $request->all();

        $continent = $this->continentRepository->create($input);

        return $this->sendResponse($continent->toArray(), 'Continent saved successfully');
    }

    /**
     * Display the specified Continent.
     * GET|HEAD /continents/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Continent $continent */
        $continent = $this->continentRepository->find($id);

        if (empty($continent)) {
            return $this->sendError('Continent not found');
        }

        return $this->sendResponse($continent->toArray(), 'Continent retrieved successfully');
    }

    /**
     * Update the specified Continent in storage.
     * PUT/PATCH /continents/{id}
     *
     * @param int $id
     * @param UpdateContinentAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateContinentAPIRequest $request)
    {
        $input = $request->all();

        /** @var Continent $continent */
        $continent = $this->continentRepository->find($id);

        if (empty($continent)) {
            return $this->sendError('Continent not found');
        }

        $continent = $this->continentRepository->update($input, $id);

        return $this->sendResponse($continent->toArray(), 'Continent updated successfully');
    }

    /**
     * Remove the specified Continent from storage.
     * DELETE /continents/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Continent $continent */
        $continent = $this->continentRepository->find($id);

        if (empty($continent)) {
            return $this->sendError('Continent not found');
        }

        $continent->delete();

        return $this->sendResponse($id, 'Continent deleted successfully');
    }
}
