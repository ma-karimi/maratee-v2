<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateActionHubAPIRequest;
use App\Http\Requests\Api\UpdateActionHubAPIRequest;
use App\Models\ActionHub;
use App\Repositories\ActionHubRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ActionHubController
 * @package App\Http\Controllers\Api
 */

class ActionHubAPIController extends AppBaseController
{
    /** @var  ActionHubRepository */
    private $actionHubRepository;

    public function __construct(ActionHubRepository $actionHubRepo)
    {
        $this->actionHubRepository = $actionHubRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/actionHubs",
     *      summary="Get a listing of the ActionHubs.",
     *      tags={"ActionHub"},
     *      description="Get all ActionHubs",
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
     *                  @SWG\Items(ref="#/definitions/ActionHub")
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
        $actionHubs = $this->actionHubRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($actionHubs->toArray(), 'Action Hubs retrieved successfully');
    }

    /**
     * @param CreateActionHubAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/actionHubs",
     *      summary="Store a newly created ActionHub in storage",
     *      tags={"ActionHub"},
     *      description="Store ActionHub",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="ActionHub that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ActionHub")
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
     *                  ref="#/definitions/ActionHub"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateActionHubAPIRequest $request)
    {
        $input = $request->all();
        $actionHub = $this->actionHubRepository->create($input);

        return $this->sendResponse($actionHub->toArray(), 'Action Hub saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/actionHubs/{id}",
     *      summary="Display the specified ActionHub",
     *      tags={"ActionHub"},
     *      description="Get ActionHub",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ActionHub",
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
     *                  ref="#/definitions/ActionHub"
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
        /** @var ActionHub $actionHub */
        $actionHub = $this->actionHubRepository->find($id);

        if (empty($actionHub)) {
            return $this->sendError('Action Hub not found');
        }

        return $this->sendResponse($actionHub->toArray(), 'Action Hub retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateActionHubAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/actionHubs/{id}",
     *      summary="Update the specified ActionHub in storage",
     *      tags={"ActionHub"},
     *      description="Update ActionHub",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ActionHub",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="ActionHub that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ActionHub")
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
     *                  ref="#/definitions/ActionHub"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateActionHubAPIRequest $request)
    {
        $input = $request->all();

        /** @var ActionHub $actionHub */
        $actionHub = $this->actionHubRepository->find($id);

        if (empty($actionHub)) {
            return $this->sendError('Action Hub not found');
        }

        $actionHub = $this->actionHubRepository->update($input, $id);

        return $this->sendResponse($actionHub->toArray(), 'ActionHub updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/actionHubs/{id}",
     *      summary="Remove the specified ActionHub from storage",
     *      tags={"ActionHub"},
     *      description="Delete ActionHub",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ActionHub",
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
        /** @var ActionHub $actionHub */
        $actionHub = $this->actionHubRepository->find($id);

        if (empty($actionHub)) {
            return $this->sendError('Action Hub not found');
        }

        $actionHub->delete();

        return $this->sendResponse($id, 'Action Hub deleted successfully');
    }
}
