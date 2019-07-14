<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateBotanicalAPIRequest;
use App\Http\Requests\Api\UpdateBotanicalAPIRequest;
use App\Models\Botanical;
use App\Repositories\BotanicalRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class BotanicalController
 * @package App\Http\Controllers\Api
 */

class BotanicalAPIController extends AppBaseController
{
    /** @var  BotanicalRepository */
    private $botanicalRepository;

    public function __construct(BotanicalRepository $botanicalRepo)
    {
        $this->botanicalRepository = $botanicalRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/botanicals",
     *      summary="Get a listing of the Botanicals.",
     *      tags={"Botanical"},
     *      description="Get all Botanicals",
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
     *                  @SWG\Items(ref="#/definitions/Botanical")
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
        $botanicals = $this->botanicalRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($botanicals->toArray(), 'Botanicals retrieved successfully');
    }

    /**
     * @param CreateBotanicalAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/botanicals",
     *      summary="Store a newly created Botanical in storage",
     *      tags={"Botanical"},
     *      description="Store Botanical",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Botanical that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
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
     *                  ref="#/definitions/Botanical"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateBotanicalAPIRequest $request)
    {
        $input = $request->all();

        $botanical = $this->botanicalRepository->create($input);

        return $this->sendResponse($botanical->toArray(), 'Botanical saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/botanicals/{id}",
     *      summary="Display the specified Botanical",
     *      tags={"Botanical"},
     *      description="Get Botanical",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Botanical",
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
     *                  ref="#/definitions/Botanical"
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
        /** @var Botanical $botanical */
        $botanical = $this->botanicalRepository->find($id);

        if (empty($botanical)) {
            return $this->sendError('Botanical not found');
        }

        return $this->sendResponse($botanical->toArray(), 'Botanical retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateBotanicalAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/botanicals/{id}",
     *      summary="Update the specified Botanical in storage",
     *      tags={"Botanical"},
     *      description="Update Botanical",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Botanical",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Botanical that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
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
     *                  ref="#/definitions/Botanical"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateBotanicalAPIRequest $request)
    {
        $input = $request->all();

        /** @var Botanical $botanical */
        $botanical = $this->botanicalRepository->find($id);

        if (empty($botanical)) {
            return $this->sendError('Botanical not found');
        }

        $botanical = $this->botanicalRepository->update($input, $id);

        return $this->sendResponse($botanical->toArray(), 'Botanical updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/botanicals/{id}",
     *      summary="Remove the specified Botanical from storage",
     *      tags={"Botanical"},
     *      description="Delete Botanical",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Botanical",
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
        /** @var Botanical $botanical */
        $botanical = $this->botanicalRepository->find($id);

        if (empty($botanical)) {
            return $this->sendError('Botanical not found');
        }

        $botanical->delete();

        return $this->sendResponse($id, 'Botanical deleted successfully');
    }
}
