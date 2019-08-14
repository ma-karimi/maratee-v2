<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateBlockTraitAPIRequest;
use App\Http\Requests\Api\UpdateBlockTraitAPIRequest;
use App\Models\BlockTrait;
use App\Repositories\BlockTraitRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class BlockTraitController
 * @package App\Http\Controllers\Api
 */

class BlockTraitAPIController extends AppBaseController
{
    /** @var  BlockTraitRepository */
    private $blockTraitRepository;

    public function __construct(BlockTraitRepository $blockTraitRepo)
    {
        $this->blockTraitRepository = $blockTraitRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/blockTraits",
     *      summary="Get a listing of the BlockTraits.",
     *      tags={"BlockTrait"},
     *      description="Get all BlockTraits",
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
     *                  @SWG\Items(ref="#/definitions/BlockTrait")
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
        $blockTraits = $this->blockTraitRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($blockTraits->toArray(), 'Block Traits retrieved successfully');
    }

    /**
     * @param CreateBlockTraitAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/blockTraits",
     *      summary="Store a newly created BlockTrait in storage",
     *      tags={"BlockTrait"},
     *      description="Store BlockTrait",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="block_id",
     *          in="body",
     *          description="BlockTrait that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BlockTrait")
     *      ),
     *      @SWG\Parameter(
     *          name="soil_id",
     *          in="body",
     *          description="BlockTrait that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BlockTrait")
     *      ),
     *      @SWG\Parameter(
     *          name="water_source",
     *          in="body",
     *          description="BlockTrait that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BlockTrait")
     *      ),
     *      @SWG\Parameter(
     *          name="irrigation_system",
     *          in="body",
     *          description="BlockTrait that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BlockTrait")
     *      ),
     *      @SWG\Parameter(
     *          name="irrigation_circuit",
     *          in="body",
     *          description="BlockTrait that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BlockTrait")
     *      ),
     *      @SWG\Parameter(
     *          name="irrigation_time",
     *          in="body",
     *          description="BlockTrait that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BlockTrait")
     *      ),
     *      @SWG\Parameter(
     *          name="flow_rate",
     *          in="body",
     *          description="BlockTrait that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BlockTrait")
     *      ),
     *      @SWG\Parameter(
     *          name="water_ph",
     *          in="body",
     *          description="BlockTrait that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BlockTrait")
     *      ),
     *      @SWG\Parameter(
     *          name="water_ec",
     *          in="body",
     *          description="BlockTrait that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BlockTrait")
     *      ),
     *      @SWG\Parameter(
     *          name="excel_url",
     *          in="body",
     *          description="BlockTrait that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BlockTrait")
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
     *                  ref="#/definitions/BlockTrait"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateBlockTraitAPIRequest $request)
    {
        $input = $request->all();

        $blockTrait = $this->blockTraitRepository->create($input);

        return $this->sendResponse($blockTrait->toArray(), 'Block Trait saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/blockTraits/{id}",
     *      summary="Display the specified BlockTrait",
     *      tags={"BlockTrait"},
     *      description="Get BlockTrait",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BlockTrait",
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
     *                  ref="#/definitions/BlockTrait"
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
        /** @var BlockTrait $blockTrait */
        $blockTrait = $this->blockTraitRepository->find($id);

        if (empty($blockTrait)) {
            return $this->sendError('Block Trait not found');
        }

        return $this->sendResponse($blockTrait->toArray(), 'Block Trait retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateBlockTraitAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/blockTraits/{id}",
     *      summary="Update the specified BlockTrait in storage",
     *      tags={"BlockTrait"},
     *      description="Update BlockTrait",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BlockTrait",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="soil_id",
     *          in="body",
     *          description="BlockTrait that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BlockTrait")
     *      ),
     *      @SWG\Parameter(
     *          name="water_source",
     *          in="body",
     *          description="BlockTrait that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BlockTrait")
     *      ),
     *      @SWG\Parameter(
     *          name="irrigation_system",
     *          in="body",
     *          description="BlockTrait that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BlockTrait")
     *      ),
     *      @SWG\Parameter(
     *          name="irrigation_circuit",
     *          in="body",
     *          description="BlockTrait that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BlockTrait")
     *      ),
     *      @SWG\Parameter(
     *          name="irrigation_time",
     *          in="body",
     *          description="BlockTrait that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BlockTrait")
     *      ),
     *      @SWG\Parameter(
     *          name="flow_rate",
     *          in="body",
     *          description="BlockTrait that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BlockTrait")
     *      ),
     *      @SWG\Parameter(
     *          name="water_ph",
     *          in="body",
     *          description="BlockTrait that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BlockTrait")
     *      ),
     *      @SWG\Parameter(
     *          name="water_ec",
     *          in="body",
     *          description="BlockTrait that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BlockTrait")
     *      ),
     *      @SWG\Parameter(
     *          name="excel_url",
     *          in="body",
     *          description="BlockTrait that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BlockTrait")
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
     *                  ref="#/definitions/BlockTrait"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateBlockTraitAPIRequest $request)
    {
        $input = $request->all();

        /** @var BlockTrait $blockTrait */
        $blockTrait = $this->blockTraitRepository->find($id);

        if (empty($blockTrait)) {
            return $this->sendError('Block Trait not found');
        }

        $blockTrait = $this->blockTraitRepository->update($input, $id);

        return $this->sendResponse($blockTrait->toArray(), 'BlockTrait updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/blockTraits/{id}",
     *      summary="Remove the specified BlockTrait from storage",
     *      tags={"BlockTrait"},
     *      description="Delete BlockTrait",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BlockTrait",
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
        /** @var BlockTrait $blockTrait */
        $blockTrait = $this->blockTraitRepository->find($id);

        if (empty($blockTrait)) {
            return $this->sendError('Block Trait not found');
        }

        $blockTrait->delete();

        return $this->sendResponse($id, 'Block Trait deleted successfully');
    }
}
