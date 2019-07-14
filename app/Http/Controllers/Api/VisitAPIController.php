<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateVisitAPIRequest;
use App\Http\Requests\Api\UpdateVisitAPIRequest;
use App\Models\Visit;
use App\Repositories\VisitRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class VisitController
 * @package App\Http\Controllers\Api
 */

class VisitAPIController extends AppBaseController
{
    /** @var  VisitRepository */
    private $visitRepository;

    public function __construct(VisitRepository $visitRepo)
    {
        $this->visitRepository = $visitRepo;
    }

    /**
     * Display a listing of the Visit.
     * GET|HEAD /visits
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $visits = $this->visitRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($visits->toArray(), 'Visits retrieved successfully');
    }

    /**
     * Store a newly created Visit in storage.
     * POST /visits
     *
     * @param CreateVisitAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateVisitAPIRequest $request)
    {
        $input = $request->all();

        $visit = $this->visitRepository->create($input);

        return $this->sendResponse($visit->toArray(), 'Visit saved successfully');
    }

    /**
     * Display the specified Visit.
     * GET|HEAD /visits/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Visit $visit */
        $visit = $this->visitRepository->find($id);

        if (empty($visit)) {
            return $this->sendError('Visit not found');
        }

        return $this->sendResponse($visit->toArray(), 'Visit retrieved successfully');
    }

    /**
     * Update the specified Visit in storage.
     * PUT/PATCH /visits/{id}
     *
     * @param int $id
     * @param UpdateVisitAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVisitAPIRequest $request)
    {
        $input = $request->all();

        /** @var Visit $visit */
        $visit = $this->visitRepository->find($id);

        if (empty($visit)) {
            return $this->sendError('Visit not found');
        }

        $visit = $this->visitRepository->update($input, $id);

        return $this->sendResponse($visit->toArray(), 'Visit updated successfully');
    }

    /**
     * Remove the specified Visit from storage.
     * DELETE /visits/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Visit $visit */
        $visit = $this->visitRepository->find($id);

        if (empty($visit)) {
            return $this->sendError('Visit not found');
        }

        $visit->delete();

        return $this->sendResponse($id, 'Visit deleted successfully');
    }
}
