<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\BotanicalPropagationAPIRequest;
use App\Models\BotanicalPropagation;
use App\Repositories\BotanicalPropagationRepository;
use Exception;
use Illuminate\Http\Request;
use Response;

/**
 * Class BotanicalPropagationController
 * @package App\Http\Controllers\Api
 */
class BotanicalPropagationAPIController extends AppBaseController
{
    /** @var  BotanicalPropagationRepository */
    private $botanicalPropagationRepository;

    public function __construct(BotanicalPropagationRepository $botanicalPropagationRepo)
    {
        $this->botanicalPropagationRepository = $botanicalPropagationRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/botanical_propagations",
     *      summary="Get a listing of the BotanicalPropagations.",
     *      tags={"BotanicalPropagation"},
     *      description="Get all BotanicalPropagations",
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
     *                  @SWG\Items(ref="#/definitions/BotanicalPropagation")
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
        $botanicalPropagations = $this->botanicalPropagationRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($botanicalPropagations->toArray(), 'Botanical Propagations retrieved successfully');
    }

    /**
     * @param BotanicalPropagationAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/botanical_propagations",
     *      summary="Store a newly created BotanicalPropagation in storage",
     *      tags={"BotanicalPropagation"},
     *      description="Store BotanicalPropagation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="botanical_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BotanicalPropagation")
     *      ),
     *      @SWG\Parameter(
     *          name="propagation_method_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BotanicalPropagation")
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
     *                  ref="#/definitions/BotanicalPropagation"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(BotanicalPropagationAPIRequest $request)
    {
        $input = $request->all();

        $botanicalPropagation = $this->botanicalPropagationRepository->create($input);

        return $this->sendResponse($botanicalPropagation->toArray(), 'Botanical Propagation saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/botanical_propagations/{id}",
     *      summary="Display the specified BotanicalPropagation",
     *      tags={"BotanicalPropagation"},
     *      description="Get BotanicalPropagation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BotanicalPropagation",
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
     *                  ref="#/definitions/BotanicalPropagation"
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
        /** @var BotanicalPropagation $botanicalPropagation */
        $botanicalPropagation = $this->botanicalPropagationRepository->find($id, \request()->get('relations'));

        if ($botanicalPropagation === null) {
            return $this->sendError('Botanical Propagation not found');
        }

        return $this->sendResponse($botanicalPropagation->toArray(), 'Botanical Propagation retrieved successfully');
    }

    /**
     * @param int $id
     * @param BotanicalPropagationAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/botanical_propagations/{id}",
     *      summary="Update the specified BotanicalPropagation in storage",
     *      tags={"BotanicalPropagation"},
     *      description="Update BotanicalPropagation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BotanicalPropagation",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="botanical_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BotanicalPropagation")
     *      ),
     *      @SWG\Parameter(
     *          name="propagation_method_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BotanicalPropagation")
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
     *                  ref="#/definitions/BotanicalPropagation"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, BotanicalPropagationAPIRequest $request)
    {
        $input = $request->all();

        /** @var BotanicalPropagation $botanicalPropagation */
        $botanicalPropagation = $this->botanicalPropagationRepository->find($id, \request()->get('relations'));

        if ($botanicalPropagation === null) {
            return $this->sendError('Botanical Propagation not found');
        }

        $botanicalPropagation = $this->botanicalPropagationRepository->update($input, $id);

        return $this->sendResponse($botanicalPropagation->toArray(), 'BotanicalPropagation updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws Exception
     * @SWG\Delete(
     *      path="/botanical_propagations/{id}",
     *      summary="Remove the specified BotanicalPropagation from storage",
     *      tags={"BotanicalPropagation"},
     *      description="Delete BotanicalPropagation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BotanicalPropagation",
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
        /** @var BotanicalPropagation $botanicalPropagation */
        $botanicalPropagation = $this->botanicalPropagationRepository->find($id, \request()->get('relations'));

        if ($botanicalPropagation === null) {
            return $this->sendError('Botanical Propagation not found');
        }

        $botanicalPropagation->delete();

        return $this->sendResponse($id, 'Botanical Propagation deleted successfully');
    }
}
