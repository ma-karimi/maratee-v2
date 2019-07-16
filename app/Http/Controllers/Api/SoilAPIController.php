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
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/soils",
     *      summary="Get a listing of the Soils.",
     *      tags={"Soil"},
     *      description="Get all Soils",
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
     *                  @SWG\Items(ref="#/definitions/Soil")
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
        $soils = $this->soilRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($soils->toArray(), 'Soils retrieved successfully');
    }

    /**
     * @param CreateSoilAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/soils",
     *      summary="Store a newly created Soil in storage",
     *      tags={"Soil"},
     *      description="Store Soil",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="type",
     *          in="body",
     *          description="Soil that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Soil")
     *      ),
     *     @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="Soil that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Soil")
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
     *                  ref="#/definitions/Soil"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSoilAPIRequest $request)
    {
        $input = $request->all();

        $soil = $this->soilRepository->create($input);

        return $this->sendResponse($soil->toArray(), 'Soil saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/soils/{id}",
     *      summary="Display the specified Soil",
     *      tags={"Soil"},
     *      description="Get Soil",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Soil",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="type",
     *          in="body",
     *          description="Soil that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Soil")
     *      ),
     *     @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="Soil that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Soil")
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
     *                  ref="#/definitions/Soil"
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
        /** @var Soil $soil */
        $soil = $this->soilRepository->find($id);

        if (empty($soil)) {
            return $this->sendError('Soil not found');
        }

        return $this->sendResponse($soil->toArray(), 'Soil retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateSoilAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/soils/{id}",
     *      summary="Update the specified Soil in storage",
     *      tags={"Soil"},
     *      description="Update Soil",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Soil",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="type",
     *          in="body",
     *          description="Soil that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Soil")
     *      ),
     *     @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="Soil that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Soil")
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
     *                  ref="#/definitions/Soil"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
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
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/soils/{id}",
     *      summary="Remove the specified Soil from storage",
     *      tags={"Soil"},
     *      description="Delete Soil",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Soil",
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
        /** @var Soil $soil */
        $soil = $this->soilRepository->find($id);

        if (empty($soil)) {
            return $this->sendError('Soil not found');
        }

        $soil->delete();

        return $this->sendResponse($id, 'Soil deleted successfully');
    }
}
