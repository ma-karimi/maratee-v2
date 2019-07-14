<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreatePaleontologyCitationAPIRequest;
use App\Http\Requests\Api\UpdatePaleontologyCitationAPIRequest;
use App\Models\PaleontologyCitation;
use App\Repositories\PaleontologyCitationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PaleontologyCitationController
 * @package App\Http\Controllers\Api
 */

class PaleontologyCitationAPIController extends AppBaseController
{
    /** @var  PaleontologyCitationRepository */
    private $paleontologyCitationRepository;

    public function __construct(PaleontologyCitationRepository $paleontologyCitationRepo)
    {
        $this->paleontologyCitationRepository = $paleontologyCitationRepo;
    }

    /**
     * Display a listing of the PaleontologyCitation.
     * GET|HEAD /paleontologyCitations
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $paleontologyCitations = $this->paleontologyCitationRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($paleontologyCitations->toArray(), 'Paleontology Citations retrieved successfully');
    }

    /**
     * Store a newly created PaleontologyCitation in storage.
     * POST /paleontologyCitations
     *
     * @param CreatePaleontologyCitationAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePaleontologyCitationAPIRequest $request)
    {
        $input = $request->all();

        $paleontologyCitation = $this->paleontologyCitationRepository->create($input);

        return $this->sendResponse($paleontologyCitation->toArray(), 'Paleontology Citation saved successfully');
    }

    /**
     * Display the specified PaleontologyCitation.
     * GET|HEAD /paleontologyCitations/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var PaleontologyCitation $paleontologyCitation */
        $paleontologyCitation = $this->paleontologyCitationRepository->find($id);

        if (empty($paleontologyCitation)) {
            return $this->sendError('Paleontology Citation not found');
        }

        return $this->sendResponse($paleontologyCitation->toArray(), 'Paleontology Citation retrieved successfully');
    }

    /**
     * Update the specified PaleontologyCitation in storage.
     * PUT/PATCH /paleontologyCitations/{id}
     *
     * @param int $id
     * @param UpdatePaleontologyCitationAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePaleontologyCitationAPIRequest $request)
    {
        $input = $request->all();

        /** @var PaleontologyCitation $paleontologyCitation */
        $paleontologyCitation = $this->paleontologyCitationRepository->find($id);

        if (empty($paleontologyCitation)) {
            return $this->sendError('Paleontology Citation not found');
        }

        $paleontologyCitation = $this->paleontologyCitationRepository->update($input, $id);

        return $this->sendResponse($paleontologyCitation->toArray(), 'PaleontologyCitation updated successfully');
    }

    /**
     * Remove the specified PaleontologyCitation from storage.
     * DELETE /paleontologyCitations/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var PaleontologyCitation $paleontologyCitation */
        $paleontologyCitation = $this->paleontologyCitationRepository->find($id);

        if (empty($paleontologyCitation)) {
            return $this->sendError('Paleontology Citation not found');
        }

        $paleontologyCitation->delete();

        return $this->sendResponse($id, 'Paleontology Citation deleted successfully');
    }
}
