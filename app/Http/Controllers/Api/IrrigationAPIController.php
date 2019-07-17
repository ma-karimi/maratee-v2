<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateIrrigationAPIRequest;
use App\Http\Requests\Api\UpdateIrrigationAPIRequest;
use App\Models\Irrigation;
use App\Repositories\IrrigationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class IrrigationController
 * @package App\Http\Controllers\Api
 */

class IrrigationAPIController extends AppBaseController
{
    /** @var  IrrigationRepository */
    private $irrigationRepository;

    public function __construct(IrrigationRepository $irrigationRepo)
    {
        $this->irrigationRepository = $irrigationRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/irrigations",
     *      summary="Get a listing of the Irrigations.",
     *      tags={"Irrigation"},
     *      description="Get all Irrigations",
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
     *                  @SWG\Items(ref="#/definitions/Irrigation")
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
        $irrigations = $this->irrigationRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($irrigations->toArray(), 'Irrigations retrieved successfully');
    }

    /**
     * @param CreateIrrigationAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/irrigations",
     *      summary="Store a newly created Irrigation in storage",
     *      tags={"Irrigation"},
     *      description="Store Irrigation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="type",
     *          in="body",
     *          description="Irrigation that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Irrigation")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="Irrigation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Irrigation")
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
     *                  ref="#/definitions/Irrigation"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateIrrigationAPIRequest $request)
    {
        $input = $request->all();

        $irrigation = $this->irrigationRepository->create($input);

        return $this->sendResponse($irrigation->toArray(), 'Irrigation saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/irrigations/{id}",
     *      summary="Display the specified Irrigation",
     *      tags={"Irrigation"},
     *      description="Get Irrigation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Irrigation",
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
     *                  ref="#/definitions/Irrigation"
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
        /** @var Irrigation $irrigation */
        $irrigation = $this->irrigationRepository->find($id);

        if ($irrigation === null) {
            return $this->sendError('Irrigation not found');
        }

        return $this->sendResponse($irrigation->toArray(), 'Irrigation retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateIrrigationAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/irrigations/{id}",
     *      summary="Update the specified Irrigation in storage",
     *      tags={"Irrigation"},
     *      description="Update Irrigation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Irrigation",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="type",
     *          in="body",
     *          description="Irrigation that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Irrigation")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="Irrigation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Irrigation")
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
     *                  ref="#/definitions/Irrigation"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateIrrigationAPIRequest $request)
    {
        $input = $request->all();

        /** @var Irrigation $irrigation */
        $irrigation = $this->irrigationRepository->find($id);

        if ($irrigation === null) {
            return $this->sendError('Irrigation not found');
        }

        $irrigation = $this->irrigationRepository->update($input, $id);

        return $this->sendResponse($irrigation->toArray(), 'Irrigation updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/irrigations/{id}",
     *      summary="Remove the specified Irrigation from storage",
     *      tags={"Irrigation"},
     *      description="Delete Irrigation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Irrigation",
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
        /** @var Irrigation $irrigation */
        $irrigation = $this->irrigationRepository->find($id);

        if (empty($irrigation)) {
            return $this->sendError('Irrigation not found');
        }

        $irrigation->delete();

        return $this->sendResponse($id, 'Irrigation deleted successfully');
    }
}
