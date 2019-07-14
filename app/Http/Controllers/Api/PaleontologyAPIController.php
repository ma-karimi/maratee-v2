<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreatePaleontologyAPIRequest;
use App\Http\Requests\Api\UpdatePaleontologyAPIRequest;
use App\Models\Paleontology;
use App\Repositories\PaleontologyRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PaleontologyController
 * @package App\Http\Controllers\Api
 */

class PaleontologyAPIController extends AppBaseController
{
    /** @var  PaleontologyRepository */
    private $paleontologyRepository;

    public function __construct(PaleontologyRepository $paleontologyRepo)
    {
        $this->paleontologyRepository = $paleontologyRepo;
    }

    /**
     * Display a listing of the Paleontology.
     * GET|HEAD /paleontologies
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $paleontologies = $this->paleontologyRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($paleontologies->toArray(), 'Paleontologies retrieved successfully');
    }

    /**
     * Store a newly created Paleontology in storage.
     * POST /paleontologies
     *
     * @param CreatePaleontologyAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePaleontologyAPIRequest $request)
    {
        $input = $request->all();

        $paleontology = $this->paleontologyRepository->create($input);

        return $this->sendResponse($paleontology->toArray(), 'Paleontology saved successfully');
    }

    /**
     * Display the specified Paleontology.
     * GET|HEAD /paleontologies/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Paleontology $paleontology */
        $paleontology = $this->paleontologyRepository->find($id);

        if (empty($paleontology)) {
            return $this->sendError('Paleontology not found');
        }

        return $this->sendResponse($paleontology->toArray(), 'Paleontology retrieved successfully');
    }

    /**
     * Update the specified Paleontology in storage.
     * PUT/PATCH /paleontologies/{id}
     *
     * @param int $id
     * @param UpdatePaleontologyAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePaleontologyAPIRequest $request)
    {
        $input = $request->all();

        /** @var Paleontology $paleontology */
        $paleontology = $this->paleontologyRepository->find($id);

        if (empty($paleontology)) {
            return $this->sendError('Paleontology not found');
        }

        $paleontology = $this->paleontologyRepository->update($input, $id);

        return $this->sendResponse($paleontology->toArray(), 'Paleontology updated successfully');
    }

    /**
     * Remove the specified Paleontology from storage.
     * DELETE /paleontologies/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Paleontology $paleontology */
        $paleontology = $this->paleontologyRepository->find($id);

        if (empty($paleontology)) {
            return $this->sendError('Paleontology not found');
        }

        $paleontology->delete();

        return $this->sendResponse($id, 'Paleontology deleted successfully');
    }
}
