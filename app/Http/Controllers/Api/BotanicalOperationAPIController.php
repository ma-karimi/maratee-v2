<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateBotanicalOperationAPIRequest;
use App\Http\Requests\Api\UpdateBotanicalOperationAPIRequest;
use App\Http\Resources\BotanicalOperationResource;
use App\Models\BotanicalOperation;
use App\Repositories\BotanicalOperationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class BotanicalOperationController
 * @package App\Http\Controllers\Api
 */

class BotanicalOperationAPIController extends AppBaseController
{
    /** @var  BotanicalOperationRepository */
    private $botanicalOperationRepository;

    public function __construct(BotanicalOperationRepository $botanicalOperationRepo)
    {
        $this->botanicalOperationRepository = $botanicalOperationRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/botanical_garden_actions",
     *      summary="Get a listing of the BotanicalOperations.",
     *      tags={"BotanicalOperation"},
     *      description="Get all BotanicalOperations",
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
     *                  @SWG\Items(ref="#/definitions/BotanicalOperation")
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
        $botanicalOperations = $this->botanicalOperationRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );
       // $botanicalOperations=BotanicalOperationResource::collection($botanicalOperations);
        return $this->sendResponse($botanicalOperations, 'Botanical Garden Actions retrieved successfully');
    }

    /**
     * @param CreateBotanicalOperationAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/botanical_garden_actions",
     *      summary="Store a newly created BotanicalOperation in storage",
     *      tags={"BotanicalOperation"},
     *      description="Store BotanicalOperation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="botanical_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BotanicalOperation")
     *      ),
     *      @SWG\Parameter(
     *          name="planting_action_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BotanicalOperation")
     *      ),
     *      @SWG\Parameter(
     *          name="from_soil_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BotanicalOperation")
     *      ),
     *      @SWG\Parameter(
     *          name="from_lighting_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BotanicalOperation")
     *      ),
     *      @SWG\Parameter(
     *          name="from_garden_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BotanicalOperation")
     *      ),
     *      @SWG\Parameter(
     *          name="to_soil_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BotanicalOperation")
     *      ),
     *      @SWG\Parameter(
     *          name="to_lighting_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BotanicalOperation")
     *      ),
     *      @SWG\Parameter(
     *          name="to_garden_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BotanicalOperation")
     *      ),
     *      @SWG\Parameter(
     *          name="date",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BotanicalOperation")
     *      ),
     *      @SWG\Parameter(
     *          name="initial_place_type",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BotanicalOperation")
     *      ),
     *      @SWG\Parameter(
     *          name="destination_place_type",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BotanicalOperation")
     *      ),
     *      @SWG\Parameter(
     *          name="initial_place_condition",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BotanicalOperation")
     *      ),
     *      @SWG\Parameter(
     *          name="destination_place_condition",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BotanicalOperation")
     *      ),
     *      @SWG\Parameter(
     *          name="treatment",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BotanicalOperation")
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
     *                  ref="#/definitions/BotanicalOperation"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateBotanicalOperationAPIRequest $request)
    {
        $input = $request->all();

        $botanicalOperation = $this->botanicalOperationRepository->create($input);

        return $this->sendResponse($botanicalOperation->toArray(), 'Botanical Garden Action saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/botanical_garden_actions/{id}",
     *      summary="Display the specified BotanicalOperation",
     *      tags={"BotanicalOperation"},
     *      description="Get BotanicalOperation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BotanicalOperation",
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
     *                  ref="#/definitions/BotanicalOperation"
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
        /** @var BotanicalOperation $botanicalOperation */
        $botanicalOperation = $this->botanicalOperationRepository->find($id, \request()->get('relations'));

        if ($botanicalOperation === null) {
            return $this->sendError('Botanical Garden Action not found');
        }

        return $this->sendResponse($botanicalOperation->toArray(), 'Botanical Garden Action retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateBotanicalOperationAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/botanical_garden_actions/{id}",
     *      summary="Update the specified BotanicalOperation in storage",
     *      tags={"BotanicalOperation"},
     *      description="Update BotanicalOperation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BotanicalOperation",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="BotanicalOperation that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BotanicalOperation")
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
     *                  ref="#/definitions/BotanicalOperation"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateBotanicalOperationAPIRequest $request)
    {
        $input = $request->all();

        /** @var BotanicalOperation $botanicalOperation */
        $botanicalOperation = $this->botanicalOperationRepository->find($id, \request()->get('relations'));

        if ($botanicalOperation === null) {
            return $this->sendError('Botanical Garden Action not found');
        }

        $botanicalOperation = $this->botanicalOperationRepository->update($input, $id);

        return $this->sendResponse($botanicalOperation->toArray(), 'BotanicalOperation updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/botanical_garden_actions/{id}",
     *      summary="Remove the specified BotanicalOperation from storage",
     *      tags={"BotanicalOperation"},
     *      description="Delete BotanicalOperation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BotanicalOperation",
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
        /** @var BotanicalOperation $botanicalOperation */
        $botanicalOperation = $this->botanicalOperationRepository->find($id, \request()->get('relations'));

        if (empty($botanicalOperation)) {
            return $this->sendError('Botanical Garden Action not found');
        }

        $botanicalOperation->delete();

        return $this->sendResponse($id, 'Botanical Garden Action deleted successfully');
    }
}
