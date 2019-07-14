<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreatePaleontologyMediaAPIRequest;
use App\Http\Requests\Api\UpdatePaleontologyMediaAPIRequest;
use App\Models\PaleontologyMedia;
use App\Repositories\PaleontologyMediaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PaleontologyMediaController
 * @package App\Http\Controllers\Api
 */

class PaleontologyMediaAPIController extends AppBaseController
{
    /** @var  PaleontologyMediaRepository */
    private $paleontologyMediaRepository;

    public function __construct(PaleontologyMediaRepository $paleontologyMediaRepo)
    {
        $this->paleontologyMediaRepository = $paleontologyMediaRepo;
    }

    /**
     * Display a listing of the PaleontologyMedia.
     * GET|HEAD /paleontologyMedia
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $paleontologyMedia = $this->paleontologyMediaRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($paleontologyMedia->toArray(), 'Paleontology Media retrieved successfully');
    }

    /**
     * Store a newly created PaleontologyMedia in storage.
     * POST /paleontologyMedia
     *
     * @param CreatePaleontologyMediaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePaleontologyMediaAPIRequest $request)
    {
        $input = $request->all();

        $paleontologyMedia = $this->paleontologyMediaRepository->create($input);

        return $this->sendResponse($paleontologyMedia->toArray(), 'Paleontology Media saved successfully');
    }

    /**
     * Display the specified PaleontologyMedia.
     * GET|HEAD /paleontologyMedia/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var PaleontologyMedia $paleontologyMedia */
        $paleontologyMedia = $this->paleontologyMediaRepository->find($id);

        if (empty($paleontologyMedia)) {
            return $this->sendError('Paleontology Media not found');
        }

        return $this->sendResponse($paleontologyMedia->toArray(), 'Paleontology Media retrieved successfully');
    }

    /**
     * Update the specified PaleontologyMedia in storage.
     * PUT/PATCH /paleontologyMedia/{id}
     *
     * @param int $id
     * @param UpdatePaleontologyMediaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePaleontologyMediaAPIRequest $request)
    {
        $input = $request->all();

        /** @var PaleontologyMedia $paleontologyMedia */
        $paleontologyMedia = $this->paleontologyMediaRepository->find($id);

        if (empty($paleontologyMedia)) {
            return $this->sendError('Paleontology Media not found');
        }

        $paleontologyMedia = $this->paleontologyMediaRepository->update($input, $id);

        return $this->sendResponse($paleontologyMedia->toArray(), 'PaleontologyMedia updated successfully');
    }

    /**
     * Remove the specified PaleontologyMedia from storage.
     * DELETE /paleontologyMedia/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var PaleontologyMedia $paleontologyMedia */
        $paleontologyMedia = $this->paleontologyMediaRepository->find($id);

        if (empty($paleontologyMedia)) {
            return $this->sendError('Paleontology Media not found');
        }

        $paleontologyMedia->delete();

        return $this->sendResponse($id, 'Paleontology Media deleted successfully');
    }
}
