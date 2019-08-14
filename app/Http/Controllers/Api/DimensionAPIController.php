<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateDimensionAPIRequest;
use App\Http\Requests\Api\UpdateDimensionAPIRequest;
use App\Models\Dimension;
use App\Repositories\DimensionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class DimensionController
 * @package App\Http\Controllers\Api
 */

class DimensionAPIController extends AppBaseController
{
    /** @var  DimensionRepository */
    private $dimensionRepository;

    public function __construct(DimensionRepository $dimensionRepo)
    {
        $this->dimensionRepository = $dimensionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/dimensions",
     *      summary="Get a listing of the Dimensions.",
     *      tags={"Dimension"},
     *      description="Get all Dimensions",
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
     *                  @SWG\Items(ref="#/definitions/Dimension")
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
        $dimensions = $this->dimensionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($dimensions->toArray(), 'Dimensions retrieved successfully');
    }

    /**
     * @param CreateDimensionAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/dimensions",
     *      summary="Store a newly created Dimension in storage",
     *      tags={"Dimension"},
     *      description="Store Dimension",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="Dimension that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Dimension")
     *      ),
     *      @SWG\Parameter(
     *          name="type",
     *          in="body",
     *          description="Dimension that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Dimension")
     *      ),
     *      @SWG\Parameter(
     *          name="index",
     *          in="body",
     *          description="Dimension that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Dimension")
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
     *                  ref="#/definitions/Dimension"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateDimensionAPIRequest $request)
    {
        $input = $request->all();

        $dimension = $this->dimensionRepository->create($input);

        return $this->sendResponse($dimension->toArray(), 'Dimension saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/dimensions/{id}",
     *      summary="Display the specified Dimension",
     *      tags={"Dimension"},
     *      description="Get Dimension",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Dimension",
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
     *                  ref="#/definitions/Dimension"
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
        /** @var Dimension $dimension */
        $dimension = $this->dimensionRepository->find($id);

        if (empty($dimension)) {
            return $this->sendError('Dimension not found');
        }

        return $this->sendResponse($dimension->toArray(), 'Dimension retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateDimensionAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/dimensions/{id}",
     *      summary="Update the specified Dimension in storage",
     *      tags={"Dimension"},
     *      description="Update Dimension",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Dimension",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="Dimension that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Dimension")
     *      ),
     *      @SWG\Parameter(
     *          name="type",
     *          in="body",
     *          description="Dimension that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Dimension")
     *      ),
     *      @SWG\Parameter(
     *          name="index",
     *          in="body",
     *          description="Dimension that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Dimension")
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
     *                  ref="#/definitions/Dimension"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateDimensionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Dimension $dimension */
        $dimension = $this->dimensionRepository->find($id);

        if (empty($dimension)) {
            return $this->sendError('Dimension not found');
        }

        $dimension = $this->dimensionRepository->update($input, $id);

        return $this->sendResponse($dimension->toArray(), 'Dimension updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/dimensions/{id}",
     *      summary="Remove the specified Dimension from storage",
     *      tags={"Dimension"},
     *      description="Delete Dimension",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Dimension",
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
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var Dimension $dimension */
        $dimension = $this->dimensionRepository->find($id);

        if (empty($dimension)) {
            return $this->sendError('Dimension not found');
        }

        $dimension->delete();

        return $this->sendResponse($id, 'Dimension deleted successfully');
    }
}
