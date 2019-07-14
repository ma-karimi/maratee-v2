<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateSoilAPIRequest;
use App\Http\Requests\Api\UpdateSoilAPIRequest;
use App\Models\Soil;
use App\Repositories\SoilRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SoilController
 * @package App\Http\Controllers\Api
 */

class SoilAPIController extends AppBaseController
{
    /** @var  SoilRepository */
    private $soilRepository;

    public function __construct(SoilRepository $soilRepo)
    {
        $this->soilRepository = $soilRepo;
    }

    /**
     * Display a listing of the Soil.
     * GET|HEAD /soils
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $soils = $this->soilRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($soils->toArray(), 'Soils retrieved successfully');
    }

    /**
     * Store a newly created Soil in storage.
     * POST /soils
     *
     * @param CreateSoilAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSoilAPIRequest $request)
    {
        $input = $request->all();

        $soil = $this->soilRepository->create($input);

        return $this->sendResponse($soil->toArray(), 'Soil saved successfully');
    }

    /**
     * Display the specified Soil.
     * GET|HEAD /soils/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Soil $soil */
        $soil = $this->soilRepository->find($id);

        if (empty($soil)) {
            return $this->sendError('Soil not found');
        }

        return $this->sendResponse($soil->toArray(), 'Soil retrieved successfully');
    }

    /**
     * Update the specified Soil in storage.
     * PUT/PATCH /soils/{id}
     *
     * @param int $id
     * @param UpdateSoilAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSoilAPIRequest $request)
    {
        $input = $request->all();

        /** @var Soil $soil */
        $soil = $this->soilRepository->find($id);

        if (empty($soil)) {
            return $this->sendError('Soil not found');
        }

        $soil = $this->soilRepository->update($input, $id);

        return $this->sendResponse($soil->toArray(), 'Soil updated successfully');
    }

    /**
     * Remove the specified Soil from storage.
     * DELETE /soils/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Soil $soil */
        $soil = $this->soilRepository->find($id);

        if (empty($soil)) {
            return $this->sendError('Soil not found');
        }

        $soil->delete();

        return $this->sendResponse($id, 'Soil deleted successfully');
    }
}
