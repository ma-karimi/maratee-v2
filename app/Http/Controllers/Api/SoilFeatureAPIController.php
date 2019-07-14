<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateSoilFeatureAPIRequest;
use App\Http\Requests\Api\UpdateSoilFeatureAPIRequest;
use App\Models\SoilFeature;
use App\Repositories\SoilFeatureRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SoilFeatureController
 * @package App\Http\Controllers\Api
 */

class SoilFeatureAPIController extends AppBaseController
{
    /** @var  SoilFeatureRepository */
    private $soilFeatureRepository;

    public function __construct(SoilFeatureRepository $soilFeatureRepo)
    {
        $this->soilFeatureRepository = $soilFeatureRepo;
    }

    /**
     * Display a listing of the SoilFeature.
     * GET|HEAD /soilFeatures
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $soilFeatures = $this->soilFeatureRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($soilFeatures->toArray(), 'Soil Features retrieved successfully');
    }

    /**
     * Store a newly created SoilFeature in storage.
     * POST /soilFeatures
     *
     * @param CreateSoilFeatureAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSoilFeatureAPIRequest $request)
    {
        $input = $request->all();

        $soilFeature = $this->soilFeatureRepository->create($input);

        return $this->sendResponse($soilFeature->toArray(), 'Soil Feature saved successfully');
    }

    /**
     * Display the specified SoilFeature.
     * GET|HEAD /soilFeatures/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var SoilFeature $soilFeature */
        $soilFeature = $this->soilFeatureRepository->find($id);

        if (empty($soilFeature)) {
            return $this->sendError('Soil Feature not found');
        }

        return $this->sendResponse($soilFeature->toArray(), 'Soil Feature retrieved successfully');
    }

    /**
     * Update the specified SoilFeature in storage.
     * PUT/PATCH /soilFeatures/{id}
     *
     * @param int $id
     * @param UpdateSoilFeatureAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSoilFeatureAPIRequest $request)
    {
        $input = $request->all();

        /** @var SoilFeature $soilFeature */
        $soilFeature = $this->soilFeatureRepository->find($id);

        if (empty($soilFeature)) {
            return $this->sendError('Soil Feature not found');
        }

        $soilFeature = $this->soilFeatureRepository->update($input, $id);

        return $this->sendResponse($soilFeature->toArray(), 'SoilFeature updated successfully');
    }

    /**
     * Remove the specified SoilFeature from storage.
     * DELETE /soilFeatures/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var SoilFeature $soilFeature */
        $soilFeature = $this->soilFeatureRepository->find($id);

        if (empty($soilFeature)) {
            return $this->sendError('Soil Feature not found');
        }

        $soilFeature->delete();

        return $this->sendResponse($id, 'Soil Feature deleted successfully');
    }
}
