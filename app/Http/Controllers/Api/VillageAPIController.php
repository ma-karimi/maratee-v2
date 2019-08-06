<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateVillageAPIRequest;
use App\Http\Requests\Api\UpdateVillageAPIRequest;
use App\Models\Village;
use App\Repositories\VillageRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class VillageController
 * @package App\Http\Controllers\Api
 */

class VillageAPIController extends AppBaseController
{
    /** @var  VillageRepository */
    private $villageRepository;

    public function __construct(VillageRepository $villageRepo)
    {
        $this->villageRepository = $villageRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/villages",
     *      summary="Get a listing of the Villages.",
     *      tags={"Village"},
     *      description="Get all Villages",
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
     *                  @SWG\Items(ref="#/definitions/Village")
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
        $villages = $this->villageRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($villages->toArray(), 'Villages retrieved successfully');
    }

    /**
     * @param CreateVillageAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/villages",
     *      summary="Store a newly created Village in storage",
     *      tags={"Village"},
     *      description="Store Village",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="Village that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Village")
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
     *                  ref="#/definitions/Village"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateVillageAPIRequest $request)
    {
        $input = $request->all();

        $village = $this->villageRepository->create($input);

        return $this->sendResponse($village->toArray(), 'Village saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/villages/{id}",
     *      summary="Display the specified Village",
     *      tags={"Village"},
     *      description="Get Village",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Village",
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
     *                  ref="#/definitions/Village"
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
        /** @var Village $village */
        $village = $this->villageRepository->find($id, \request()->get('relations'));

        if (empty($village)) {
            return $this->sendError('Village not found');
        }

        return $this->sendResponse($village->toArray(), 'Village retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateVillageAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/villages/{id}",
     *      summary="Update the specified Village in storage",
     *      tags={"Village"},
     *      description="Update Village",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Village",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="Village that should be updated",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Village")
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
     *                  ref="#/definitions/Village"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateVillageAPIRequest $request)
    {
        $input = $request->all();

        /** @var Village $village */
        $village = $this->villageRepository->find($id, \request()->get('relations'));

        if (empty($village)) {
            return $this->sendError('Village not found');
        }

        $village = $this->villageRepository->update($input, $id);

        return $this->sendResponse($village->toArray(), 'Village updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/villages/{id}",
     *      summary="Remove the specified Village from storage",
     *      tags={"Village"},
     *      description="Delete Village",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Village",
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
        /** @var Village $village */
        $village = $this->villageRepository->find($id, \request()->get('relations'));

        if (empty($village)) {
            return $this->sendError('Village not found');
        }

        $village->delete();

        return $this->sendResponse($id, 'Village deleted successfully');
    }
}
