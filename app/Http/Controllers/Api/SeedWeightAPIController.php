<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateSeedWeightAPIRequest;
use App\Http\Requests\Api\UpdateSeedWeightAPIRequest;
use App\Models\SeedWeight;
use App\Repositories\SeedWeightRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SeedWeightController
 * @package App\Http\Controllers\Api
 */

class SeedWeightAPIController extends AppBaseController
{
    /** @var  SeedWeightRepository */
    private $seedWeightRepository;

    public function __construct(SeedWeightRepository $seedWeightRepo)
    {
        $this->seedWeightRepository = $seedWeightRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/seed_weights",
     *      summary="Get a listing of the SeedWeights.",
     *      tags={"SeedWeight"},
     *      description="Get all SeedWeights",
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
     *                  @SWG\Items(ref="#/definitions/SeedWeight")
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
        $seedWeights = $this->seedWeightRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($seedWeights->toArray(), 'Seed Weights retrieved successfully');
    }

    /**
     * @param CreateSeedWeightAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/seed_weights",
     *      summary="Store a newly created SeedWeight in storage",
     *      tags={"SeedWeight"},
     *      description="Store SeedWeight",
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
     *                  ref="#/definitions/SeedWeight"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSeedWeightAPIRequest $request)
    {
        $input = $request->all();

        $seedWeight = $this->seedWeightRepository->create($input);

        return $this->sendResponse($seedWeight->toArray(), 'Seed Weight saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/seed_weights/{id}",
     *      summary="Display the specified SeedWeight",
     *      tags={"SeedWeight"},
     *      description="Get SeedWeight",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedWeight",
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
     *                  ref="#/definitions/SeedWeight"
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
        /** @var SeedWeight $seedWeight */
        $seedWeight = $this->seedWeightRepository->find($id, \request()->get('relations'));

        if (empty($seedWeight)) {
            return $this->sendError('Seed Weight not found');
        }

        return $this->sendResponse($seedWeight->toArray(), 'Seed Weight retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateSeedWeightAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/seed_weights/{id}",
     *      summary="Update the specified SeedWeight in storage",
     *      tags={"SeedWeight"},
     *      description="Update SeedWeight",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedWeight",
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
     *                  ref="#/definitions/SeedWeight"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSeedWeightAPIRequest $request)
    {
        $input = $request->all();

        /** @var SeedWeight $seedWeight */
        $seedWeight = $this->seedWeightRepository->find($id, \request()->get('relations'));

        if (empty($seedWeight)) {
            return $this->sendError('Seed Weight not found');
        }

        $seedWeight = $this->seedWeightRepository->update($input, $id);

        return $this->sendResponse($seedWeight->toArray(), 'SeedWeight updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/seed_weights/{id}",
     *      summary="Remove the specified SeedWeight from storage",
     *      tags={"SeedWeight"},
     *      description="Delete SeedWeight",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedWeight",
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
        /** @var SeedWeight $seedWeight */
        $seedWeight = $this->seedWeightRepository->find($id, \request()->get('relations'));

        if (empty($seedWeight)) {
            return $this->sendError('Seed Weight not found');
        }

        $seedWeight->delete();

        return $this->sendResponse($id, 'Seed Weight deleted successfully');
    }
}
