<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateSeedHasPlantAPIRequest;
use App\Http\Requests\Api\UpdateSeedHasPlantAPIRequest;
use App\Models\SeedHasPlant;
use App\Repositories\SeedHasPlantRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SeedHasPlantController
 * @package App\Http\Controllers\Api
 */

class SeedHasPlantAPIController extends AppBaseController
{
    /** @var  SeedHasPlantRepository */
    private $seedHasPlantRepository;

    public function __construct(SeedHasPlantRepository $seedHasPlantRepo)
    {
        $this->seedHasPlantRepository = $seedHasPlantRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/seedHasPlants",
     *      summary="Get a listing of the SeedHasPlants.",
     *      tags={"SeedHasPlant"},
     *      description="Get all SeedHasPlants",
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
     *                  @SWG\Items(ref="#/definitions/SeedHasPlant")
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
        $seedHasPlants = $this->seedHasPlantRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($seedHasPlants->toArray(), 'Seed Has Plants retrieved successfully');
    }

    /**
     * @param CreateSeedHasPlantAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/seedHasPlants",
     *      summary="Store a newly created SeedHasPlant in storage",
     *      tags={"SeedHasPlant"},
     *      description="Store SeedHasPlant",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="seed_id",
     *          in="body",
     *          description="SeedHasPlant that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedHasPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="plant_id",
     *          in="body",
     *          description="SeedHasPlant that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedHasPlant")
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
     *                  ref="#/definitions/SeedHasPlant"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSeedHasPlantAPIRequest $request)
    {
        $input = $request->all();

        $seedHasPlant = $this->seedHasPlantRepository->create($input);

        return $this->sendResponse($seedHasPlant->toArray(), 'Seed Has Plant saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/seedHasPlants/{id}",
     *      summary="Display the specified SeedHasPlant",
     *      tags={"SeedHasPlant"},
     *      description="Get SeedHasPlant",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedHasPlant",
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
     *                  ref="#/definitions/SeedHasPlant"
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
        /** @var SeedHasPlant $seedHasPlant */
        $seedHasPlant = $this->seedHasPlantRepository->find($id);

        if (empty($seedHasPlant)) {
            return $this->sendError('Seed Has Plant not found');
        }

        return $this->sendResponse($seedHasPlant->toArray(), 'Seed Has Plant retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateSeedHasPlantAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/seedHasPlants/{id}",
     *      summary="Update the specified SeedHasPlant in storage",
     *      tags={"SeedHasPlant"},
     *      description="Update SeedHasPlant",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedHasPlant",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="seed_id",
     *          in="body",
     *          description="SeedHasPlant that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedHasPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="plant_id",
     *          in="body",
     *          description="SeedHasPlant that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedHasPlant")
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
     *                  ref="#/definitions/SeedHasPlant"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSeedHasPlantAPIRequest $request)
    {
        $input = $request->all();

        /** @var SeedHasPlant $seedHasPlant */
        $seedHasPlant = $this->seedHasPlantRepository->find($id);

        if (empty($seedHasPlant)) {
            return $this->sendError('Seed Has Plant not found');
        }

        $seedHasPlant = $this->seedHasPlantRepository->update($input, $id);

        return $this->sendResponse($seedHasPlant->toArray(), 'SeedHasPlant updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/seedHasPlants/{id}",
     *      summary="Remove the specified SeedHasPlant from storage",
     *      tags={"SeedHasPlant"},
     *      description="Delete SeedHasPlant",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedHasPlant",
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
        /** @var SeedHasPlant $seedHasPlant */
        $seedHasPlant = $this->seedHasPlantRepository->find($id);

        if (empty($seedHasPlant)) {
            return $this->sendError('Seed Has Plant not found');
        }

        $seedHasPlant->delete();

        return $this->sendResponse($id, 'Seed Has Plant deleted successfully');
    }
}
