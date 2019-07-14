<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateTechnologyCollectionAPIRequest;
use App\Http\Requests\Api\UpdateTechnologyCollectionAPIRequest;
use App\Models\TechnologyCollection;
use App\Repositories\TechnologyCollectionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class TechnologyCollectionController
 * @package App\Http\Controllers\Api
 */

class TechnologyCollectionAPIController extends AppBaseController
{
    /** @var  TechnologyCollectionRepository */
    private $technologyCollectionRepository;

    public function __construct(TechnologyCollectionRepository $technologyCollectionRepo)
    {
        $this->technologyCollectionRepository = $technologyCollectionRepo;
    }

    /**
     * Display a listing of the TechnologyCollection.
     * GET|HEAD /technologyCollections
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $technologyCollections = $this->technologyCollectionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($technologyCollections->toArray(), 'Technology Collections retrieved successfully');
    }

    /**
     * Store a newly created TechnologyCollection in storage.
     * POST /technologyCollections
     *
     * @param CreateTechnologyCollectionAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateTechnologyCollectionAPIRequest $request)
    {
        $input = $request->all();

        $technologyCollection = $this->technologyCollectionRepository->create($input);

        return $this->sendResponse($technologyCollection->toArray(), 'Technology Collection saved successfully');
    }

    /**
     * Display the specified TechnologyCollection.
     * GET|HEAD /technologyCollections/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var TechnologyCollection $technologyCollection */
        $technologyCollection = $this->technologyCollectionRepository->find($id);

        if (empty($technologyCollection)) {
            return $this->sendError('Technology Collection not found');
        }

        return $this->sendResponse($technologyCollection->toArray(), 'Technology Collection retrieved successfully');
    }

    /**
     * Update the specified TechnologyCollection in storage.
     * PUT/PATCH /technologyCollections/{id}
     *
     * @param int $id
     * @param UpdateTechnologyCollectionAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTechnologyCollectionAPIRequest $request)
    {
        $input = $request->all();

        /** @var TechnologyCollection $technologyCollection */
        $technologyCollection = $this->technologyCollectionRepository->find($id);

        if (empty($technologyCollection)) {
            return $this->sendError('Technology Collection not found');
        }

        $technologyCollection = $this->technologyCollectionRepository->update($input, $id);

        return $this->sendResponse($technologyCollection->toArray(), 'TechnologyCollection updated successfully');
    }

    /**
     * Remove the specified TechnologyCollection from storage.
     * DELETE /technologyCollections/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var TechnologyCollection $technologyCollection */
        $technologyCollection = $this->technologyCollectionRepository->find($id);

        if (empty($technologyCollection)) {
            return $this->sendError('Technology Collection not found');
        }

        $technologyCollection->delete();

        return $this->sendResponse($id, 'Technology Collection deleted successfully');
    }
}
