<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateMorphologyAPIRequest;
use App\Http\Requests\Api\UpdateMorphologyAPIRequest;
use App\Models\Morphology;
use App\Repositories\MorphologyRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class MorphologyController
 * @package App\Http\Controllers\Api
 */

class MorphologyAPIController extends AppBaseController
{
    /** @var  MorphologyRepository */
    private $morphologyRepository;

    public function __construct(MorphologyRepository $morphologyRepo)
    {
        $this->morphologyRepository = $morphologyRepo;
    }

    /**
     * Display a listing of the Morphology.
     * GET|HEAD /morphologies
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $morphologies = $this->morphologyRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($morphologies->toArray(), 'Morphologies retrieved successfully');
    }

    /**
     * Store a newly created Morphology in storage.
     * POST /morphologies
     *
     * @param CreateMorphologyAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateMorphologyAPIRequest $request)
    {
        $input = $request->all();

        $morphology = $this->morphologyRepository->create($input);

        return $this->sendResponse($morphology->toArray(), 'Morphology saved successfully');
    }

    /**
     * Display the specified Morphology.
     * GET|HEAD /morphologies/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Morphology $morphology */
        $morphology = $this->morphologyRepository->find($id);

        if (empty($morphology)) {
            return $this->sendError('Morphology not found');
        }

        return $this->sendResponse($morphology->toArray(), 'Morphology retrieved successfully');
    }

    /**
     * Update the specified Morphology in storage.
     * PUT/PATCH /morphologies/{id}
     *
     * @param int $id
     * @param UpdateMorphologyAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMorphologyAPIRequest $request)
    {
        $input = $request->all();

        /** @var Morphology $morphology */
        $morphology = $this->morphologyRepository->find($id);

        if (empty($morphology)) {
            return $this->sendError('Morphology not found');
        }

        $morphology = $this->morphologyRepository->update($input, $id);

        return $this->sendResponse($morphology->toArray(), 'Morphology updated successfully');
    }

    /**
     * Remove the specified Morphology from storage.
     * DELETE /morphologies/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Morphology $morphology */
        $morphology = $this->morphologyRepository->find($id);

        if (empty($morphology)) {
            return $this->sendError('Morphology not found');
        }

        $morphology->delete();

        return $this->sendResponse($id, 'Morphology deleted successfully');
    }
}
