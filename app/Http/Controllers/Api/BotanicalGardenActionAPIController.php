<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateBotanicalGardenActionAPIRequest;
use App\Http\Requests\Api\UpdateBotanicalGardenActionAPIRequest;
use App\Models\BotanicalGardenAction;
use App\Repositories\BotanicalGardenActionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class BotanicalGardenActionController
 * @package App\Http\Controllers\Api
 */

class BotanicalGardenActionAPIController extends AppBaseController
{
    /** @var  BotanicalGardenActionRepository */
    private $botanicalGardenActionRepository;

    public function __construct(BotanicalGardenActionRepository $botanicalGardenActionRepo)
    {
        $this->botanicalGardenActionRepository = $botanicalGardenActionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/botanicalGardenActions",
     *      summary="Get a listing of the BotanicalGardenActions.",
     *      tags={"BotanicalGardenAction"},
     *      description="Get all BotanicalGardenActions",
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
     *                  @SWG\Items(ref="#/definitions/BotanicalGardenAction")
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
        $botanicalGardenActions = $this->botanicalGardenActionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($botanicalGardenActions->toArray(), 'Botanical Garden Actions retrieved successfully');
    }

    /**
     * @param CreateBotanicalGardenActionAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/botanicalGardenActions",
     *      summary="Store a newly created BotanicalGardenAction in storage",
     *      tags={"BotanicalGardenAction"},
     *      description="Store BotanicalGardenAction",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="BotanicalGardenAction that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BotanicalGardenAction")
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
     *                  ref="#/definitions/BotanicalGardenAction"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateBotanicalGardenActionAPIRequest $request)
    {
        $input = $request->all();

        $botanicalGardenAction = $this->botanicalGardenActionRepository->create($input);

        return $this->sendResponse($botanicalGardenAction->toArray(), 'Botanical Garden Action saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/botanicalGardenActions/{id}",
     *      summary="Display the specified BotanicalGardenAction",
     *      tags={"BotanicalGardenAction"},
     *      description="Get BotanicalGardenAction",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BotanicalGardenAction",
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
     *                  ref="#/definitions/BotanicalGardenAction"
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
        /** @var BotanicalGardenAction $botanicalGardenAction */
        $botanicalGardenAction = $this->botanicalGardenActionRepository->find($id);

        if (empty($botanicalGardenAction)) {
            return $this->sendError('Botanical Garden Action not found');
        }

        return $this->sendResponse($botanicalGardenAction->toArray(), 'Botanical Garden Action retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateBotanicalGardenActionAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/botanicalGardenActions/{id}",
     *      summary="Update the specified BotanicalGardenAction in storage",
     *      tags={"BotanicalGardenAction"},
     *      description="Update BotanicalGardenAction",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BotanicalGardenAction",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="BotanicalGardenAction that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BotanicalGardenAction")
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
     *                  ref="#/definitions/BotanicalGardenAction"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateBotanicalGardenActionAPIRequest $request)
    {
        $input = $request->all();

        /** @var BotanicalGardenAction $botanicalGardenAction */
        $botanicalGardenAction = $this->botanicalGardenActionRepository->find($id);

        if (empty($botanicalGardenAction)) {
            return $this->sendError('Botanical Garden Action not found');
        }

        $botanicalGardenAction = $this->botanicalGardenActionRepository->update($input, $id);

        return $this->sendResponse($botanicalGardenAction->toArray(), 'BotanicalGardenAction updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/botanicalGardenActions/{id}",
     *      summary="Remove the specified BotanicalGardenAction from storage",
     *      tags={"BotanicalGardenAction"},
     *      description="Delete BotanicalGardenAction",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BotanicalGardenAction",
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
        /** @var BotanicalGardenAction $botanicalGardenAction */
        $botanicalGardenAction = $this->botanicalGardenActionRepository->find($id);

        if (empty($botanicalGardenAction)) {
            return $this->sendError('Botanical Garden Action not found');
        }

        $botanicalGardenAction->delete();

        return $this->sendResponse($id, 'Botanical Garden Action deleted successfully');
    }
}
