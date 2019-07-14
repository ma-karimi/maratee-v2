<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateSeedAPIRequest;
use App\Http\Requests\Api\UpdateSeedAPIRequest;
use App\Models\Seed;
use App\Repositories\SeedRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SeedController
 * @package App\Http\Controllers\Api
 */

class SeedAPIController extends AppBaseController
{
    /** @var  SeedRepository */
    private $seedRepository;

    public function __construct(SeedRepository $seedRepo)
    {
        $this->seedRepository = $seedRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/seeds",
     *      summary="Get a listing of the Seeds.",
     *      tags={"Seed"},
     *      description="Get all Seeds",
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
     *                  @SWG\Items(ref="#/definitions/Seed")
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
        $seeds = $this->seedRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($seeds->toArray(), 'Seeds retrieved successfully');
    }

    /**
     * @param CreateSeedAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/seeds",
     *      summary="Store a newly created Seed in storage",
     *      tags={"Seed"},
     *      description="Store Seed",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
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
     *                  ref="#/definitions/Seed"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSeedAPIRequest $request)
    {
        $input = $request->all();

        $seed = $this->seedRepository->create($input);

        return $this->sendResponse($seed->toArray(), 'Seed saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/seeds/{id}",
     *      summary="Display the specified Seed",
     *      tags={"Seed"},
     *      description="Get Seed",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Seed",
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
     *                  ref="#/definitions/Seed"
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
        /** @var Seed $seed */
        $seed = $this->seedRepository->find($id);

        if (empty($seed)) {
            return $this->sendError('Seed not found');
        }

        return $this->sendResponse($seed->toArray(), 'Seed retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateSeedAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/seeds/{id}",
     *      summary="Update the specified Seed in storage",
     *      tags={"Seed"},
     *      description="Update Seed",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Seed",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Seed that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
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
     *                  ref="#/definitions/Seed"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSeedAPIRequest $request)
    {
        $input = $request->all();

        /** @var Seed $seed */
        $seed = $this->seedRepository->find($id);

        if (empty($seed)) {
            return $this->sendError('Seed not found');
        }

        $seed = $this->seedRepository->update($input, $id);

        return $this->sendResponse($seed->toArray(), 'Seed updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/seeds/{id}",
     *      summary="Remove the specified Seed from storage",
     *      tags={"Seed"},
     *      description="Delete Seed",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Seed",
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
        /** @var Seed $seed */
        $seed = $this->seedRepository->find($id);

        if (empty($seed)) {
            return $this->sendError('Seed not found');
        }

        $seed->delete();

        return $this->sendResponse($id, 'Seed deleted successfully');
    }
}
