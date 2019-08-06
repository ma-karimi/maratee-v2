<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateTransitionAPIRequest;
use App\Http\Requests\Api\UpdateTransitionAPIRequest;
use App\Models\Transition;
use App\Repositories\TransitionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class TransitionController
 * @package App\Http\Controllers\Api
 */

class TransitionAPIController extends AppBaseController
{
    /** @var  TransitionRepository */
    private $transitionRepository;

    public function __construct(TransitionRepository $transitionRepo)
    {
        $this->transitionRepository = $transitionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/transitions",
     *      summary="Get a listing of the Transitions.",
     *      tags={"Transition"},
     *      description="Get all Transitions",
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
     *                  @SWG\Items(ref="#/definitions/Transition")
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
        $transitions = $this->transitionRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($transitions->toArray(), 'Transitions retrieved successfully');
    }

    /**
     * @param CreateTransitionAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/transitions",
     *      summary="Store a newly created Transition in storage",
     *      tags={"Transition"},
     *      description="Store Transition",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="table_name",
     *          in="body",
     *          description="Transition that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Transition")
     *      ),
     *      @SWG\Parameter(
     *          name="field_name",
     *          in="body",
     *          description="Transition that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Transition")
     *      ),
     *      @SWG\Parameter(
     *          name="table_id",
     *          in="body",
     *          description="Transition that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Transition")
     *      ),
     *      @SWG\Parameter(
     *          name="status",
     *          in="body",
     *          description="Transition that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Transition")
     *      ),
     *      @SWG\Parameter(
     *          name="crud_type",
     *          in="body",
     *          description="Transition that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Transition")
     *      ),
     *      @SWG\Parameter(
     *          name="creator_id",
     *          in="body",
     *          description="Transition that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Transition")
     *      ),
     *      @SWG\Parameter(
     *          name="requester_id",
     *          in="body",
     *          description="Transition that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Transition")
     *      ),
     *      @SWG\Parameter(
     *          name="changer_id",
     *          in="body",
     *          description="Transition that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Transition")
     *      ),
     *      @SWG\Parameter(
     *          name="responser_id",
     *          in="body",
     *          description="Transition that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Transition")
     *      ),
     *      @SWG\Parameter(
     *          name="request_date",
     *          in="body",
     *          description="Transition that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Transition")
     *      ),
     *      @SWG\Parameter(
     *          name="change_date",
     *          in="body",
     *          description="Transition that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Transition")
     *      ),
     *      @SWG\Parameter(
     *          name="response_date",
     *          in="body",
     *          description="Transition that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Transition")
     *      ),
     *      @SWG\Parameter(
     *          name="request_status",
     *          in="body",
     *          description="Transition that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Transition")
     *      ),
     *      @SWG\Parameter(
     *          name="previous_value",
     *          in="body",
     *          description="Transition that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Transition")
     *      ),
     *      @SWG\Parameter(
     *          name="next_value",
     *          in="body",
     *          description="Transition that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Transition")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="Transition that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Transition")
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
     *                  ref="#/definitions/Transition"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTransitionAPIRequest $request)
    {
        $input = $request->all();

        $transition = $this->transitionRepository->create($input);

        return $this->sendResponse($transition->toArray(), 'Transition saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/transitions/{id}",
     *      summary="Display the specified Transition",
     *      tags={"Transition"},
     *      description="Get Transition",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Transition",
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
     *                  ref="#/definitions/Transition"
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
        /** @var Transition $transition */
        $transition = $this->transitionRepository->find($id, \request()->get('relations'));

        if (empty($transition)) {
            return $this->sendError('Transition not found');
        }

        return $this->sendResponse($transition->toArray(), 'Transition retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateTransitionAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/transitions/{id}",
     *      summary="Update the specified Transition in storage",
     *      tags={"Transition"},
     *      description="Update Transition",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Transition",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="table_name",
     *          in="body",
     *          description="Transition that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Transition")
     *      ),
     *      @SWG\Parameter(
     *          name="field_name",
     *          in="body",
     *          description="Transition that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Transition")
     *      ),
     *      @SWG\Parameter(
     *          name="table_id",
     *          in="body",
     *          description="Transition that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Transition")
     *      ),
     *      @SWG\Parameter(
     *          name="status",
     *          in="body",
     *          description="Transition that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Transition")
     *      ),
     *      @SWG\Parameter(
     *          name="crud_type",
     *          in="body",
     *          description="Transition that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Transition")
     *      ),
     *      @SWG\Parameter(
     *          name="creator_id",
     *          in="body",
     *          description="Transition that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Transition")
     *      ),
     *      @SWG\Parameter(
     *          name="requester_id",
     *          in="body",
     *          description="Transition that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Transition")
     *      ),
     *      @SWG\Parameter(
     *          name="changer_id",
     *          in="body",
     *          description="Transition that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Transition")
     *      ),
     *      @SWG\Parameter(
     *          name="responser_id",
     *          in="body",
     *          description="Transition that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Transition")
     *      ),
     *      @SWG\Parameter(
     *          name="request_date",
     *          in="body",
     *          description="Transition that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Transition")
     *      ),
     *      @SWG\Parameter(
     *          name="change_date",
     *          in="body",
     *          description="Transition that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Transition")
     *      ),
     *      @SWG\Parameter(
     *          name="response_date",
     *          in="body",
     *          description="Transition that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Transition")
     *      ),
     *      @SWG\Parameter(
     *          name="request_status",
     *          in="body",
     *          description="Transition that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Transition")
     *      ),
     *      @SWG\Parameter(
     *          name="previous_value",
     *          in="body",
     *          description="Transition that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Transition")
     *      ),
     *      @SWG\Parameter(
     *          name="next_value",
     *          in="body",
     *          description="Transition that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Transition")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="Transition that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Transition")
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
     *                  ref="#/definitions/Transition"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTransitionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Transition $transition */
        $transition = $this->transitionRepository->find($id, \request()->get('relations'));

        if (empty($transition)) {
            return $this->sendError('Transition not found');
        }

        $transition = $this->transitionRepository->update($input, $id);

        return $this->sendResponse($transition->toArray(), 'Transition updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/transitions/{id}",
     *      summary="Remove the specified Transition from storage",
     *      tags={"Transition"},
     *      description="Delete Transition",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Transition",
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
        /** @var Transition $transition */
        $transition = $this->transitionRepository->find($id, \request()->get('relations'));

        if (empty($transition)) {
            return $this->sendError('Transition not found');
        }

        $transition->delete();

        return $this->sendResponse($id, 'Transition deleted successfully');
    }
}
