<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\ActorAPIRequest;
use App\Repositories\ActorRepository;
use Exception;
use Illuminate\Http\Request;


/**
 * Class ActorController
 * @package App\Http\Controllers\Api
 */
class ActorAPIController extends AppBaseController
{
    /** @var  ActorRepository */
    private $actorRepository;

    public function __construct(ActorRepository $actorRepository)
    {
        $this->actorRepository = $actorRepository;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/actors",
     *      summary="Get a listing of the Actors.",
     *      tags={"Actor"},
     *      description="Get all Actors",
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
     *                  @SWG\Items(ref="#/definitions/Actor")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     * @throws Exception
     */
    public function index(Request $request)
    {
        $actors = $this->actorRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($actors->toArray(), 'Actors retrieved successfully');
    }

    /**
     * @param ActorAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/actors",
     *      summary="Store a newly created Actor in storage",
     *      tags={"Actor"},
     *      description="Store Actor",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Actor")
     *      ),
     *      @SWG\Parameter(
     *          name="user_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Actor")
     *      ),
     *      @SWG\Parameter(
     *          name="cellphone",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Actor")
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
     *                  ref="#/definitions/Actor"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(ActorAPIRequest $request)
    {
        $input = $request->all();

        $actor = $this->actorRepository->create($input);

        return $this->sendResponse($actor->toArray(), 'Actor saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/actors/{id}",
     *      summary="Display the specified Actor",
     *      tags={"Actor"},
     *      description="Get Actor",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Actor",
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
     *                  ref="#/definitions/Actor"
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
        /** @var Actor $actor */
        $actor = $this->actorRepository->find($id, \request()->get('relations'));

        if ($actor === null) {
            return $this->sendError('Actor not found');
        }

        return $this->sendResponse($actor->toArray(), 'Actor retrieved successfully');
    }

    /**
     * @param int $id
     * @param ActorAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/actors/{id}",
     *      summary="Update the specified Actor in storage",
     *      tags={"Actor"},
     *      description="Update Actor",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Actor",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Actor")
     *      ),
     *      @SWG\Parameter(
     *          name="user_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Actor")
     *      ),
     *      @SWG\Parameter(
     *          name="cellphone",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Actor")
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
     *                  ref="#/definitions/Actor"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, ActorAPIRequest $request)
    {
        $input = $request->all();

        /** @var Actor $actor */
        $actor = $this->actorRepository->find($id, \request()->get('relations'));

        if ($actor === null) {
            return $this->sendError('Actor not found');
        }

        $actor = $this->actorRepository->update($input, $id);

        return $this->sendResponse($actor->toArray(), 'Actor updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws Exception
     * @SWG\Delete(
     *      path="/actors/{id}",
     *      summary="Remove the specified Actor from storage",
     *      tags={"Actor"},
     *      description="Delete Actor",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Actor",
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
        /** @var Actor $actor */
        $actor = $this->actorRepository->find($id, \request()->get('relations'));

        if ($actor === null) {
            return $this->sendError('Actor not found');
        }

        $actor->delete();

        return $this->sendResponse($id, 'Actor deleted successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @throws Exception
     * @SWG\Get(
     *      path="/actors/all",
     *      summary="get all Actor Grouped By ",
     *      tags={"Taxonomy"},
     *      description="get all Actor Grouped By ",
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
     *                  @SWG\Items(ref="#/definitions/Actor")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function all(Request $request)
    {
        $taxonomies = $this->actorRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($taxonomies->toArray(), 'Actors retrieved successfully');
    }
}
