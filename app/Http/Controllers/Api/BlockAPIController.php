<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateBlockAPIRequest;
use App\Http\Requests\Api\UpdateBlockAPIRequest;
use App\Models\Block;
use App\Repositories\BlockRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class BlockController
 * @package App\Http\Controllers\Api
 */

class BlockAPIController extends AppBaseController
{
    /** @var  BlockRepository */
    private $blockRepository;

    public function __construct(BlockRepository $blockRepo)
    {
        $this->blockRepository = $blockRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/blocks",
     *      summary="Get a listing of the Blocks.",
     *      tags={"Block"},
     *      description="Get all Blocks",
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
     *                  @SWG\Items(ref="#/definitions/Block")
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
        $blocks = $this->blockRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($blocks->toArray(), 'Blocks retrieved successfully');
    }

    /**
     * @param CreateBlockAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/blocks",
     *      summary="Store a newly created Block in storage",
     *      tags={"Block"},
     *      description="Store Block",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="station_id",
     *          in="body",
     *          description="Block that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Block")
     *      ),
     *      @SWG\Parameter(
     *          name="number",
     *          in="body",
     *          description="Block that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Block")
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
     *                  ref="#/definitions/Block"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateBlockAPIRequest $request)
    {
        $input = $request->all();

        $block = $this->blockRepository->create($input);

        return $this->sendResponse($block->toArray(), 'Block saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/blocks/{id}",
     *      summary="Display the specified Block",
     *      tags={"Block"},
     *      description="Get Block",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Block",
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
     *                  ref="#/definitions/Block"
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
        /** @var Block $block */
        $block = $this->blockRepository->find($id);

        if (empty($block)) {
            return $this->sendError('Block not found');
        }

        return $this->sendResponse($block->toArray(), 'Block retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateBlockAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/blocks/{id}",
     *      summary="Update the specified Block in storage",
     *      tags={"Block"},
     *      description="Update Block",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Block",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="station_id",
     *          in="body",
     *          description="Block that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Block")
     *      ),
     *      @SWG\Parameter(
     *          name="number",
     *          in="body",
     *          description="Block that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Block")
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
     *                  ref="#/definitions/Block"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateBlockAPIRequest $request)
    {
        $input = $request->all();

        /** @var Block $block */
        $block = $this->blockRepository->find($id);

        if (empty($block)) {
            return $this->sendError('Block not found');
        }

        $block = $this->blockRepository->update($input, $id);

        return $this->sendResponse($block->toArray(), 'Block updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/blocks/{id}",
     *      summary="Remove the specified Block from storage",
     *      tags={"Block"},
     *      description="Delete Block",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Block",
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
        /** @var Block $block */
        $block = $this->blockRepository->find($id);

        if (empty($block)) {
            return $this->sendError('Block not found');
        }

        $block->delete();

        return $this->sendResponse($id, 'Block deleted successfully');
    }
}
