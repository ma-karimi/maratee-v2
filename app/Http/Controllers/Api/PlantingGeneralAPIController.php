<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreatePlantingGeneralAPIRequest;
use App\Http\Requests\Api\UpdatePlantingGeneralAPIRequest;
use App\Models\PlantingGeneral;
use App\Repositories\PlantingGeneralRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PlantingGeneralController
 * @package App\Http\Controllers\Api
 */

class PlantingGeneralAPIController extends AppBaseController
{
    /** @var  PlantingGeneralRepository */
    private $plantingGeneralRepository;

    public function __construct(PlantingGeneralRepository $plantingGeneralRepo)
    {
        $this->plantingGeneralRepository = $plantingGeneralRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/plantingGenerals",
     *      summary="Get a listing of the PlantingGenerals.",
     *      tags={"PlantingGeneral"},
     *      description="Get all PlantingGenerals",
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
     *                  @SWG\Items(ref="#/definitions/PlantingGeneral")
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
        $plantingGenerals = $this->plantingGeneralRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($plantingGenerals->toArray(), 'Planting Generals retrieved successfully');
    }

    /**
     * @param CreatePlantingGeneralAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/plantingGenerals",
     *      summary="Store a newly created PlantingGeneral in storage",
     *      tags={"PlantingGeneral"},
     *      description="Store PlantingGeneral",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="PlantingGeneral that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantingGeneral")
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
     *                  ref="#/definitions/PlantingGeneral"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePlantingGeneralAPIRequest $request)
    {
        $input = $request->all();

        $plantingGeneral = $this->plantingGeneralRepository->create($input);

        return $this->sendResponse($plantingGeneral->toArray(), 'Planting General saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/plantingGenerals/{id}",
     *      summary="Display the specified PlantingGeneral",
     *      tags={"PlantingGeneral"},
     *      description="Get PlantingGeneral",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of PlantingGeneral",
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
     *                  ref="#/definitions/PlantingGeneral"
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
        /** @var PlantingGeneral $plantingGeneral */
        $plantingGeneral = $this->plantingGeneralRepository->find($id);

        if (empty($plantingGeneral)) {
            return $this->sendError('Planting General not found');
        }

        return $this->sendResponse($plantingGeneral->toArray(), 'Planting General retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePlantingGeneralAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/plantingGenerals/{id}",
     *      summary="Update the specified PlantingGeneral in storage",
     *      tags={"PlantingGeneral"},
     *      description="Update PlantingGeneral",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of PlantingGeneral",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="PlantingGeneral that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantingGeneral")
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
     *                  ref="#/definitions/PlantingGeneral"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePlantingGeneralAPIRequest $request)
    {
        $input = $request->all();

        /** @var PlantingGeneral $plantingGeneral */
        $plantingGeneral = $this->plantingGeneralRepository->find($id);

        if (empty($plantingGeneral)) {
            return $this->sendError('Planting General not found');
        }

        $plantingGeneral = $this->plantingGeneralRepository->update($input, $id);

        return $this->sendResponse($plantingGeneral->toArray(), 'PlantingGeneral updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/plantingGenerals/{id}",
     *      summary="Remove the specified PlantingGeneral from storage",
     *      tags={"PlantingGeneral"},
     *      description="Delete PlantingGeneral",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of PlantingGeneral",
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
        /** @var PlantingGeneral $plantingGeneral */
        $plantingGeneral = $this->plantingGeneralRepository->find($id);

        if (empty($plantingGeneral)) {
            return $this->sendError('Planting General not found');
        }

        $plantingGeneral->delete();

        return $this->sendResponse($id, 'Planting General deleted successfully');
    }
}
