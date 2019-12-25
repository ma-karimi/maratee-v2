<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\InternalHabitatApiRequest;
use App\Models\InternalHabitat;
use App\Repositories\InternalHabitatRepository;
use Exception;
use Illuminate\Http\Request;
use Response;

/**
 * Class InternalHabitatController
 * @package App\Http\Controllers\Api
 */
class InternalHabitatAPIController extends AppBaseController
{
    /** @var  InternalHabitatRepository */
    private $internalHabitatRepository;

    public function __construct(InternalHabitatRepository $internalHabitatRepo)
    {
        $this->internalHabitatRepository = $internalHabitatRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/internal_habitats",
     *      summary="Get a listing of the InternalHabitats.",
     *      tags={"InternalHabitat"},
     *      description="Get all InternalHabitats",
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
     *                  @SWG\Items(ref="#/definitions/InternalHabitat")
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
        $internalHabitats = $this->internalHabitatRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($internalHabitats->toArray(), 'InternalHabitats retrieved successfully');
    }

    /**
     * @param InternalHabitatApiRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/internal_habitats",
     *      summary="Store a newly created InternalHabitat in storage",
     *      tags={"InternalHabitat"},
     *      description="Store InternalHabitat",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          required=true,
     *          type="string",
     *          @SWG\Schema(ref="#/definitions/InternalHabitat")
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
     *                  ref="#/definitions/InternalHabitat"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(InternalHabitatApiRequest $request)
    {
        $input = $request->all();

        $internalHabitat = $this->internalHabitatRepository->create($input);

        return $this->sendResponse($internalHabitat->toArray(), 'InternalHabitat saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/internal_habitats/{id}",
     *      summary="Display the specified InternalHabitat",
     *      tags={"InternalHabitat"},
     *      description="Get InternalHabitat",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of InternalHabitat",
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
     *                  ref="#/definitions/InternalHabitat"
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
        /** @var InternalHabitat $internalHabitat */
        $internalHabitat = $this->internalHabitatRepository->find($id, \request()->get('relations'));

        if ($internalHabitat === null) {
            return $this->sendError('InternalHabitat not found');
        }

        return $this->sendResponse($internalHabitat->toArray(), 'InternalHabitat retrieved successfully');
    }

    /**
     * @param int $id
     * @param InternalHabitatApiRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/internal_habitats/{id}",
     *      summary="Update the specified InternalHabitat in storage",
     *      tags={"InternalHabitat"},
     *      description="Update InternalHabitat",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of InternalHabitat",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          required=true,
     *          type="string",
     *          @SWG\Schema(ref="#/definitions/InternalHabitat")
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
     *                  ref="#/definitions/InternalHabitat"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, InternalHabitatApiRequest $request)
    {
        $input = $request->all();

        /** @var InternalHabitat $internalHabitat */
        $internalHabitat = $this->internalHabitatRepository->find($id, \request()->get('relations'));

        if ($internalHabitat === null) {
            return $this->sendError('InternalHabitat not found');
        }

        $internalHabitat = $this->internalHabitatRepository->update($input, $id);

        return $this->sendResponse($internalHabitat->toArray(), 'InternalHabitat updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws Exception
     * @SWG\Delete(
     *      path="/internal_habitats/{id}",
     *      summary="Remove the specified InternalHabitat from storage",
     *      tags={"InternalHabitat"},
     *      description="Delete InternalHabitat",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of InternalHabitat",
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
        /** @var InternalHabitat $internalHabitat */
        $internalHabitat = $this->internalHabitatRepository->find($id, \request()->get('relations'));

        if ($internalHabitat === null) {
            return $this->sendError('InternalHabitat not found');
        }

        $internalHabitat->delete();

        return $this->sendResponse($id, 'InternalHabitat deleted successfully');
    }
}
