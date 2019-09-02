<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateSeedPlantAPIRequest;
use App\Http\Requests\Api\UpdateSeedPlantAPIRequest;
use App\Models\SeedPlant;
use App\Repositories\SeedPlantRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SeedPlantController
 * @package App\Http\Controllers\Api
 */

class SeedPlantAPIController extends AppBaseController
{
    /** @var  SeedPlantRepository */
    private $seedPlantRepository;

    public function __construct(SeedPlantRepository $seedPlantRepo)
    {
        $this->seedPlantRepository = $seedPlantRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/seed_plants",
     *      summary="Get a listing of the SeedPlants.",
     *      tags={"SeedPlant"},
     *      description="Get all SeedPlants",
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
     *                  @SWG\Items(ref="#/definitions/SeedPlant")
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
    public function index(Request $request)
    {
        $seedPlants = $this->seedPlantRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($seedPlants->toArray(), 'Seed Plants retrieved successfully');
    }

    /**
     * @param CreateSeedPlantAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/seed_plants",
     *      summary="Store a newly created SeedPlant in storage",
     *      tags={"SeedPlant"},
     *      description="Store SeedPlant",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="seed_id",
     *          in="body",
     *          description="SeedPlant that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="plant_id",
     *          in="body",
     *          description="SeedPlant that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedPlant")
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
     *                  ref="#/definitions/SeedPlant"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSeedPlantAPIRequest $request)
    {
        $input = $request->all();

        $seedPlant = $this->seedPlantRepository->create($input);

        return $this->sendResponse($seedPlant->toArray(), 'Seed Plant saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/seed_plants/{id}",
     *      summary="Display the specified SeedPlant",
     *      tags={"SeedPlant"},
     *      description="Get SeedPlant",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedPlant",
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
     *                  ref="#/definitions/SeedPlant"
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
        /** @var SeedPlant $seedPlant */
        $seedPlant = $this->seedPlantRepository->find($id, \request()->get('relations'));

        if (empty($seedPlant)) {
            return $this->sendError('Seed Plant not found');
        }

        return $this->sendResponse($seedPlant->toArray(), 'Seed Plant retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateSeedPlantAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/seed_plants/{id}",
     *      summary="Update the specified SeedPlant in storage",
     *      tags={"SeedPlant"},
     *      description="Update SeedPlant",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedPlant",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *         @SWG\Parameter(
     *          name="seed_id",
     *          in="body",
     *          description="SeedPlant that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="plant_id",
     *          in="body",
     *          description="SeedPlant that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedPlant")
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
     *                  ref="#/definitions/SeedPlant"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSeedPlantAPIRequest $request)
    {
        $input = $request->all();

        /** @var SeedPlant $seedPlant */
        $seedPlant = $this->seedPlantRepository->find($id, \request()->get('relations'));

        if (empty($seedPlant)) {
            return $this->sendError('Seed Plant not found');
        }

        $seedPlant = $this->seedPlantRepository->update($input, $id);

        return $this->sendResponse($seedPlant->toArray(), 'SeedPlant updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/seed_plants/{id}",
     *      summary="Remove the specified SeedPlant from storage",
     *      tags={"SeedPlant"},
     *      description="Delete SeedPlant",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedPlant",
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
        /** @var SeedPlant $seedPlant */
        $seedPlant = $this->seedPlantRepository->find($id, \request()->get('relations'));

        if (empty($seedPlant)) {
            return $this->sendError('Seed Plant not found');
        }

        $seedPlant->delete();

        return $this->sendResponse($id, 'Seed Plant deleted successfully');
    }
}
