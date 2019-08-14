<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreatePropagationAPIRequest;
use App\Http\Requests\Api\UpdatePropagationAPIRequest;
use App\Models\Propagation;
use App\Repositories\PropagationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PropagationController
 * @package App\Http\Controllers\Api
 */

class PropagationAPIController extends AppBaseController
{
    /** @var  PropagationRepository */
    private $propagationRepository;

    public function __construct(PropagationRepository $propagationRepo)
    {
        $this->propagationRepository = $propagationRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/propagations",
     *      summary="Get a listing of the Propagations.",
     *      tags={"Propagation"},
     *      description="Get all Propagations",
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
     *                  @SWG\Items(ref="#/definitions/Propagation")
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
        $propagations = $this->propagationRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($propagations->toArray(), 'Propagations retrieved successfully');
    }

    /**
     * @param CreatePropagationAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/propagations",
     *      summary="Store a newly created Propagation in storage",
     *      tags={"Propagation"},
     *      description="Store Propagation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="Propagation that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Propagation")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="Propagation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Propagation")
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
     *                  ref="#/definitions/Propagation"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePropagationAPIRequest $request)
    {
        $input = $request->all();

        $propagation = $this->propagationRepository->create($input);

        return $this->sendResponse($propagation->toArray(), 'Propagation saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/propagations/{id}",
     *      summary="Display the specified Propagation",
     *      tags={"Propagation"},
     *      description="Get Propagation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Propagation",
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
     *                  ref="#/definitions/Propagation"
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
        /** @var Propagation $propagation */
        $propagation = $this->propagationRepository->find($id, \request()->get('relations'));

        if (empty($propagation)) {
            return $this->sendError('Propagation not found');
        }

        return $this->sendResponse($propagation->toArray(), 'Propagation retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePropagationAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/propagations/{id}",
     *      summary="Update the specified Propagation in storage",
     *      tags={"Propagation"},
     *      description="Update Propagation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Propagation",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="Propagation that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Propagation")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="Propagation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Propagation")
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
     *                  ref="#/definitions/Propagation"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePropagationAPIRequest $request)
    {
        $input = $request->all();

        /** @var Propagation $propagation */
        $propagation = $this->propagationRepository->find($id, \request()->get('relations'));

        if (empty($propagation)) {
            return $this->sendError('Propagation not found');
        }

        $propagation = $this->propagationRepository->update($input, $id);

        return $this->sendResponse($propagation->toArray(), 'Propagation updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/propagations/{id}",
     *      summary="Remove the specified Propagation from storage",
     *      tags={"Propagation"},
     *      description="Delete Propagation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Propagation",
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
        /** @var Propagation $propagation */
        $propagation = $this->propagationRepository->find($id, \request()->get('relations'));

        if (empty($propagation)) {
            return $this->sendError('Propagation not found');
        }

        $propagation->delete();

        return $this->sendResponse($id, 'Propagation deleted successfully');
    }
}
