<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateSoilHasSoilFeatureAPIRequest;
use App\Http\Requests\Api\UpdateSoilHasSoilFeatureAPIRequest;
use App\Models\SoilHasSoilFeature;
use App\Repositories\SoilHasSoilFeatureRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SoilHasSoilFeatureController
 * @package App\Http\Controllers\Api
 */

class SoilHasSoilFeatureAPIController extends AppBaseController
{
    /** @var  SoilHasSoilFeatureRepository */
    private $soilHasSoilFeatureRepository;

    public function __construct(SoilHasSoilFeatureRepository $soilHasSoilFeatureRepo)
    {
        $this->soilHasSoilFeatureRepository = $soilHasSoilFeatureRepo;
    }

    /**
     * Display a listing of the SoilHasSoilFeature.
     * GET|HEAD /soilHasSoilFeatures
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $soilHasSoilFeatures = $this->soilHasSoilFeatureRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($soilHasSoilFeatures->toArray(), 'Soil Has Soil Features retrieved successfully');
    }

    /**
     * Store a newly created SoilHasSoilFeature in storage.
     * POST /soilHasSoilFeatures
     *
     * @param CreateSoilHasSoilFeatureAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSoilHasSoilFeatureAPIRequest $request)
    {
        $input = $request->all();

        $soilHasSoilFeature = $this->soilHasSoilFeatureRepository->create($input);

        return $this->sendResponse($soilHasSoilFeature->toArray(), 'Soil Has Soil Feature saved successfully');
    }

    /**
     * Display the specified SoilHasSoilFeature.
     * GET|HEAD /soilHasSoilFeatures/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var SoilHasSoilFeature $soilHasSoilFeature */
        $soilHasSoilFeature = $this->soilHasSoilFeatureRepository->find($id);

        if (empty($soilHasSoilFeature)) {
            return $this->sendError('Soil Has Soil Feature not found');
        }

        return $this->sendResponse($soilHasSoilFeature->toArray(), 'Soil Has Soil Feature retrieved successfully');
    }

    /**
     * Update the specified SoilHasSoilFeature in storage.
     * PUT/PATCH /soilHasSoilFeatures/{id}
     *
     * @param int $id
     * @param UpdateSoilHasSoilFeatureAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSoilHasSoilFeatureAPIRequest $request)
    {
        $input = $request->all();

        /** @var SoilHasSoilFeature $soilHasSoilFeature */
        $soilHasSoilFeature = $this->soilHasSoilFeatureRepository->find($id);

        if (empty($soilHasSoilFeature)) {
            return $this->sendError('Soil Has Soil Feature not found');
        }

        $soilHasSoilFeature = $this->soilHasSoilFeatureRepository->update($input, $id);

        return $this->sendResponse($soilHasSoilFeature->toArray(), 'SoilHasSoilFeature updated successfully');
    }

    /**
     * Remove the specified SoilHasSoilFeature from storage.
     * DELETE /soilHasSoilFeatures/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var SoilHasSoilFeature $soilHasSoilFeature */
        $soilHasSoilFeature = $this->soilHasSoilFeatureRepository->find($id);

        if (empty($soilHasSoilFeature)) {
            return $this->sendError('Soil Has Soil Feature not found');
        }

        $soilHasSoilFeature->delete();

        return $this->sendResponse($id, 'Soil Has Soil Feature deleted successfully');
    }
}
