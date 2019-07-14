<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateProtectionAPIRequest;
use App\Http\Requests\Api\UpdateProtectionAPIRequest;
use App\Models\Protection;
use App\Repositories\ProtectionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ProtectionController
 * @package App\Http\Controllers\Api
 */

class ProtectionAPIController extends AppBaseController
{
    /** @var  ProtectionRepository */
    private $protectionRepository;

    public function __construct(ProtectionRepository $protectionRepo)
    {
        $this->protectionRepository = $protectionRepo;
    }

    /**
     * Display a listing of the Protection.
     * GET|HEAD /protections
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $protections = $this->protectionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($protections->toArray(), 'Protections retrieved successfully');
    }

    /**
     * Store a newly created Protection in storage.
     * POST /protections
     *
     * @param CreateProtectionAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateProtectionAPIRequest $request)
    {
        $input = $request->all();

        $protection = $this->protectionRepository->create($input);

        return $this->sendResponse($protection->toArray(), 'Protection saved successfully');
    }

    /**
     * Display the specified Protection.
     * GET|HEAD /protections/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Protection $protection */
        $protection = $this->protectionRepository->find($id);

        if (empty($protection)) {
            return $this->sendError('Protection not found');
        }

        return $this->sendResponse($protection->toArray(), 'Protection retrieved successfully');
    }

    /**
     * Update the specified Protection in storage.
     * PUT/PATCH /protections/{id}
     *
     * @param int $id
     * @param UpdateProtectionAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProtectionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Protection $protection */
        $protection = $this->protectionRepository->find($id);

        if (empty($protection)) {
            return $this->sendError('Protection not found');
        }

        $protection = $this->protectionRepository->update($input, $id);

        return $this->sendResponse($protection->toArray(), 'Protection updated successfully');
    }

    /**
     * Remove the specified Protection from storage.
     * DELETE /protections/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Protection $protection */
        $protection = $this->protectionRepository->find($id);

        if (empty($protection)) {
            return $this->sendError('Protection not found');
        }

        $protection->delete();

        return $this->sendResponse($id, 'Protection deleted successfully');
    }
}
