<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreatePlantingApplicationAPIRequest;
use App\Http\Requests\Api\UpdatePlantingApplicationAPIRequest;
use App\Models\PlantingApplication;
use App\Repositories\PlantingApplicationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PlantingApplicationController
 * @package App\Http\Controllers\Api
 */

class PlantingApplicationAPIController extends AppBaseController
{
    /** @var  PlantingApplicationRepository */
    private $plantingApplicationRepository;

    public function __construct(PlantingApplicationRepository $plantingApplicationRepo)
    {
        $this->plantingApplicationRepository = $plantingApplicationRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/plantingApplications",
     *      summary="Get a listing of the PlantingApplications.",
     *      tags={"PlantingApplication"},
     *      description="Get all PlantingApplications",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/PlantingApplication")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $plantingApplications = $this->plantingApplicationRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($plantingApplications->toArray(), 'Planting Applications retrieved successfully');
    }

    /**
     * @param CreatePlantingApplicationAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/plantingApplications",
     *      summary="Store a newly created PlantingApplication in storage",
     *      tags={"PlantingApplication"},
     *      description="Store PlantingApplication",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="PlantingApplication that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantingApplication")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/PlantingApplication"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePlantingApplicationAPIRequest $request)
    {
        $input = $request->all();

        $plantingApplication = $this->plantingApplicationRepository->create($input);

        return $this->sendResponse($plantingApplication->toArray(), 'Planting Application saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/plantingApplications/{id}",
     *      summary="Display the specified PlantingApplication",
     *      tags={"PlantingApplication"},
     *      description="Get PlantingApplication",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of PlantingApplication",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/PlantingApplication"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var PlantingApplication $plantingApplication */
        $plantingApplication = $this->plantingApplicationRepository->find($id);

        if (empty($plantingApplication)) {
            return $this->sendError('Planting Application not found');
        }

        return $this->sendResponse($plantingApplication->toArray(), 'Planting Application retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePlantingApplicationAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/plantingApplications/{id}",
     *      summary="Update the specified PlantingApplication in storage",
     *      tags={"PlantingApplication"},
     *      description="Update PlantingApplication",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of PlantingApplication",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="PlantingApplication that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantingApplication")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/PlantingApplication"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePlantingApplicationAPIRequest $request)
    {
        $input = $request->all();

        /** @var PlantingApplication $plantingApplication */
        $plantingApplication = $this->plantingApplicationRepository->find($id);

        if (empty($plantingApplication)) {
            return $this->sendError('Planting Application not found');
        }

        $plantingApplication = $this->plantingApplicationRepository->update($input, $id);

        return $this->sendResponse($plantingApplication->toArray(), 'PlantingApplication updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/plantingApplications/{id}",
     *      summary="Remove the specified PlantingApplication from storage",
     *      tags={"PlantingApplication"},
     *      description="Delete PlantingApplication",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of PlantingApplication",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var PlantingApplication $plantingApplication */
        $plantingApplication = $this->plantingApplicationRepository->find($id);

        if (empty($plantingApplication)) {
            return $this->sendError('Planting Application not found');
        }

        $plantingApplication->delete();

        return $this->sendResponse($id, 'Planting Application deleted successfully');
    }
}
