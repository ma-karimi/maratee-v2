<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreatePlantGeneralAPIRequest;
use App\Http\Requests\Api\UpdatePlantGeneralAPIRequest;
use App\Models\PlantGeneral;
use App\Repositories\PlantGeneralRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PlantGeneralController
 * @package App\Http\Controllers\Api
 */

class PlantGeneralAPIController extends AppBaseController
{
    /** @var  PlantGeneralRepository */
    private $PlantGeneralRepository;

    public function __construct(PlantGeneralRepository $PlantGeneralRepo)
    {
        $this->PlantGeneralRepository = $PlantGeneralRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/PlantGenerals",
     *      summary="Get a listing of the PlantGenerals.",
     *      tags={"PlantGeneral"},
     *      description="Get all PlantGenerals",
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
     *                  @SWG\Items(ref="#/definitions/PlantGeneral")
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
        $PlantGenerals = $this->PlantGeneralRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($PlantGenerals->toArray(), 'Planting Generals retrieved successfully');
    }

    /**
     * @param CreatePlantGeneralAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/PlantGenerals",
     *      summary="Store a newly created PlantGeneral in storage",
     *      tags={"PlantGeneral"},
     *      description="Store PlantGeneral",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="PlantGeneral that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PlantGeneral")
     *      ),
     *      @SWG\Parameter(
     *          name="type",
     *          in="body",
     *          description="PlantGeneral that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PlantGeneral")
     *      ),
     *      @SWG\Parameter(
     *          name="parent_id",
     *          in="body",
     *          description="PlantGeneral that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PlantGeneral")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="PlantGeneral that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantGeneral")
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
     *                  ref="#/definitions/PlantGeneral"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePlantGeneralAPIRequest $request)
    {
        $input = $request->all();

        $PlantGeneral = $this->PlantGeneralRepository->create($input);

        return $this->sendResponse($PlantGeneral->toArray(), 'Planting General saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/PlantGenerals/{id}",
     *      summary="Display the specified PlantGeneral",
     *      tags={"PlantGeneral"},
     *      description="Get PlantGeneral",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of PlantGeneral",
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
     *                  ref="#/definitions/PlantGeneral"
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
        /** @var PlantGeneral $PlantGeneral */
        $PlantGeneral = $this->PlantGeneralRepository->find($id);

        if (empty($PlantGeneral)) {
            return $this->sendError('Planting General not found');
        }

        return $this->sendResponse($PlantGeneral->toArray(), 'Planting General retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePlantGeneralAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/PlantGenerals/{id}",
     *      summary="Update the specified PlantGeneral in storage",
     *      tags={"PlantGeneral"},
     *      description="Update PlantGeneral",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of PlantGeneral",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="PlantGeneral that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PlantGeneral")
     *      ),
     *      @SWG\Parameter(
     *          name="type",
     *          in="body",
     *          description="PlantGeneral that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PlantGeneral")
     *      ),
     *      @SWG\Parameter(
     *          name="parent_id",
     *          in="body",
     *          description="PlantGeneral that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PlantGeneral")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="PlantGeneral that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantGeneral")
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
     *                  ref="#/definitions/PlantGeneral"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePlantGeneralAPIRequest $request)
    {
        $input = $request->all();

        /** @var PlantGeneral $PlantGeneral */
        $PlantGeneral = $this->PlantGeneralRepository->find($id);

        if (empty($PlantGeneral)) {
            return $this->sendError('Planting General not found');
        }

        $PlantGeneral = $this->PlantGeneralRepository->update($input, $id);

        return $this->sendResponse($PlantGeneral->toArray(), 'PlantGeneral updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/PlantGenerals/{id}",
     *      summary="Remove the specified PlantGeneral from storage",
     *      tags={"PlantGeneral"},
     *      description="Delete PlantGeneral",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of PlantGeneral",
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
        /** @var PlantGeneral $PlantGeneral */
        $PlantGeneral = $this->PlantGeneralRepository->find($id);

        if (empty($PlantGeneral)) {
            return $this->sendError('Planting General not found');
        }

        $PlantGeneral->delete();

        return $this->sendResponse($id, 'Planting General deleted successfully');
    }
}
