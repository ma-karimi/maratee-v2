<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreatePaleontologyActionAPIRequest;
use App\Http\Requests\Api\UpdatePaleontologyActionAPIRequest;
use App\Models\PaleontologyAction;
use App\Repositories\PaleontologyActionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PaleontologyActionController
 * @package App\Http\Controllers\Api
 */

class PaleontologyActionAPIController extends AppBaseController
{
    /** @var  PaleontologyActionRepository */
    private $paleontologyActionRepository;

    public function __construct(PaleontologyActionRepository $paleontologyActionRepo)
    {
        $this->paleontologyActionRepository = $paleontologyActionRepo;
    }

    /**
     * Display a listing of the PaleontologyAction.
     * GET|HEAD /paleontologyActions
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $paleontologyActions = $this->paleontologyActionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($paleontologyActions->toArray(), 'Paleontology Actions retrieved successfully');
    }

    /**
     * Store a newly created PaleontologyAction in storage.
     * POST /paleontologyActions
     *
     * @param CreatePaleontologyActionAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePaleontologyActionAPIRequest $request)
    {
        $input = $request->all();

        $paleontologyAction = $this->paleontologyActionRepository->create($input);

        return $this->sendResponse($paleontologyAction->toArray(), 'Paleontology Action saved successfully');
    }

    /**
     * Display the specified PaleontologyAction.
     * GET|HEAD /paleontologyActions/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var PaleontologyAction $paleontologyAction */
        $paleontologyAction = $this->paleontologyActionRepository->find($id);

        if (empty($paleontologyAction)) {
            return $this->sendError('Paleontology Action not found');
        }

        return $this->sendResponse($paleontologyAction->toArray(), 'Paleontology Action retrieved successfully');
    }

    /**
     * Update the specified PaleontologyAction in storage.
     * PUT/PATCH /paleontologyActions/{id}
     *
     * @param int $id
     * @param UpdatePaleontologyActionAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePaleontologyActionAPIRequest $request)
    {
        $input = $request->all();

        /** @var PaleontologyAction $paleontologyAction */
        $paleontologyAction = $this->paleontologyActionRepository->find($id);

        if (empty($paleontologyAction)) {
            return $this->sendError('Paleontology Action not found');
        }

        $paleontologyAction = $this->paleontologyActionRepository->update($input, $id);

        return $this->sendResponse($paleontologyAction->toArray(), 'PaleontologyAction updated successfully');
    }

    /**
     * Remove the specified PaleontologyAction from storage.
     * DELETE /paleontologyActions/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var PaleontologyAction $paleontologyAction */
        $paleontologyAction = $this->paleontologyActionRepository->find($id);

        if (empty($paleontologyAction)) {
            return $this->sendError('Paleontology Action not found');
        }

        $paleontologyAction->delete();

        return $this->sendResponse($id, 'Paleontology Action deleted successfully');
    }
}
