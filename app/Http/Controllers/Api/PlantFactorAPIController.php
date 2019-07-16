<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreatePlantFactorAPIRequest;
use App\Http\Requests\Api\UpdatePlantFactorAPIRequest;
use App\Models\PlantFactor;
use App\Repositories\PlantFactorRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PlantFactorController
 * @package App\Http\Controllers\Api
 */

class PlantFactorAPIController extends AppBaseController
{
    /** @var  PlantFactorRepository */
    private $PlantFactorRepository;

    public function __construct(PlantFactorRepository $PlantFactorRepo)
    {
        $this->PlantFactorRepository = $PlantFactorRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/PlantFactors",
     *      summary="Get a listing of the PlantFactors.",
     *      tags={"PlantFactor"},
     *      description="Get all PlantFactors",
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
     *                  @SWG\Items(ref="#/definitions/PlantFactor")
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
        $PlantFactors = $this->PlantFactorRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($PlantFactors->toArray(), 'Plant Factors retrieved successfully');
    }

    /**
     * @param CreatePlantFactorAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/PlantFactors",
     *      summary="Store a newly created PlantFactor in storage",
     *      tags={"PlantFactor"},
     *      description="Store PlantFactor",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="PlantFactor that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PlantFactor")
     *      ),
     *      @SWG\Parameter(
     *          name="type",
     *          in="body",
     *          description="PlantFactor that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PlantFactor")
     *      ),
     *      @SWG\Parameter(
     *          name="parent_id",
     *          in="body",
     *          description="PlantFactor that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PlantFactor")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="PlantFactor that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PlantFactor")
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
     *                  ref="#/definitions/PlantFactor"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePlantFactorAPIRequest $request)
    {
        $input = $request->all();

        $PlantFactor = $this->PlantFactorRepository->create($input);

        return $this->sendResponse($PlantFactor->toArray(), 'Plant Factor saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/PlantFactors/{id}",
     *      summary="Display the specified PlantFactor",
     *      tags={"PlantFactor"},
     *      description="Get PlantFactor",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of PlantFactor",
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
     *                  ref="#/definitions/PlantFactor"
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
        /** @var PlantFactor $PlantFactor */
        $PlantFactor = $this->PlantFactorRepository->find($id);

        if (empty($PlantFactor)) {
            return $this->sendError('Plant Factor not found');
        }

        return $this->sendResponse($PlantFactor->toArray(), 'Plant Factor retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePlantFactorAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/PlantFactors/{id}",
     *      summary="Update the specified PlantFactor in storage",
     *      tags={"PlantFactor"},
     *      description="Update PlantFactor",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of PlantFactor",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="PlantFactor that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PlantFactor")
     *      ),
     *      @SWG\Parameter(
     *          name="type",
     *          in="body",
     *          description="PlantFactor that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PlantFactor")
     *      ),
     *      @SWG\Parameter(
     *          name="parent_id",
     *          in="body",
     *          description="PlantFactor that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PlantFactor")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="PlantFactor that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PlantFactor")
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
     *                  ref="#/definitions/PlantFactor"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePlantFactorAPIRequest $request)
    {
        $input = $request->all();

        /** @var PlantFactor $PlantFactor */
        $PlantFactor = $this->PlantFactorRepository->find($id);

        if (empty($PlantFactor)) {
            return $this->sendError('Plant Factor not found');
        }

        $PlantFactor = $this->PlantFactorRepository->update($input, $id);

        return $this->sendResponse($PlantFactor->toArray(), 'PlantFactor updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/PlantFactors/{id}",
     *      summary="Remove the specified PlantFactor from storage",
     *      tags={"PlantFactor"},
     *      description="Delete PlantFactor",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of PlantFactor",
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
        /** @var PlantFactor $PlantFactor */
        $PlantFactor = $this->PlantFactorRepository->find($id);

        if (empty($PlantFactor)) {
            return $this->sendError('Plant Factor not found');
        }

        $PlantFactor->delete();

        return $this->sendResponse($id, 'Plant Factor deleted successfully');
    }
}
