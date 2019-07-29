<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreatePlantologyAPIRequest;
use App\Http\Requests\Api\UpdatePlantologyAPIRequest;
use App\Models\Plantology;
use App\Repositories\PlantologyRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PlantologyController
 * @package App\Http\Controllers\Api
 */

class PlantologyAPIController extends AppBaseController
{
    /** @var  PlantologyRepository */
    private $plantologyRepository;

    public function __construct(PlantologyRepository $plantologyRepo)
    {
        $this->plantologyRepository = $plantologyRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/plantologies",
     *      summary="Get a listing of the Plantologies.",
     *      tags={"Plantology"},
     *      description="Get all Plantologies",
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
     *                  @SWG\Items(ref="#/definitions/Plantology")
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
        $plantologies = $this->plantologyRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($plantologies->toArray(), 'Plantologies retrieved successfully');
    }

    /**
     * @param CreatePlantologyAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/plantologies",
     *      summary="Store a newly created Plantology in storage",
     *      tags={"Plantology"},
     *      description="Store Plantology",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="Plantology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Plantology")
     *      ),
     *      @SWG\Parameter(
     *          name="type",
     *          in="body",
     *          description="Plantology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Plantology")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="Plantology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plantology")
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
     *                  ref="#/definitions/Plantology"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePlantologyAPIRequest $request)
    {
        $input = $request->all();

        $plantology = $this->plantologyRepository->create($input);

        return $this->sendResponse($plantology->toArray(), 'Plantology saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/plantologies/{id}",
     *      summary="Display the specified Plantology",
     *      tags={"Plantology"},
     *      description="Get Plantology",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Plantology",
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
     *                  ref="#/definitions/Plantology"
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
        /** @var Plantology $plantology */
        $plantology = $this->plantologyRepository->find($id);

        if (empty($plantology)) {
            return $this->sendError('Plantology not found');
        }

        return $this->sendResponse($plantology->toArray(), 'Plantology retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePlantologyAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/plantologies/{id}",
     *      summary="Update the specified Plantology in storage",
     *      tags={"Plantology"},
     *      description="Update Plantology",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Plantology",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="Plantology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Plantology")
     *      ),
     *      @SWG\Parameter(
     *          name="type",
     *          in="body",
     *          description="Plantology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Plantology")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="Plantology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plantology")
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
     *                  ref="#/definitions/Plantology"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePlantologyAPIRequest $request)
    {
        $input = $request->all();

        /** @var Plantology $plantology */
        $plantology = $this->plantologyRepository->find($id);

        if (empty($plantology)) {
            return $this->sendError('Plantology not found');
        }

        $plantology = $this->plantologyRepository->update($input, $id);

        return $this->sendResponse($plantology->toArray(), 'Plantology updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/plantologies/{id}",
     *      summary="Remove the specified Plantology from storage",
     *      tags={"Plantology"},
     *      description="Delete Plantology",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Plantology",
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
        /** @var Plantology $plantology */
        $plantology = $this->plantologyRepository->find($id);

        if (empty($plantology)) {
            return $this->sendError('Plantology not found');
        }

        $plantology->delete();

        return $this->sendResponse($id, 'Plantology deleted successfully');
    }
}
