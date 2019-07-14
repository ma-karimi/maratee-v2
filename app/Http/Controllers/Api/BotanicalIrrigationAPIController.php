<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateBotanicalIrrigationAPIRequest;
use App\Http\Requests\Api\UpdateBotanicalIrrigationAPIRequest;
use App\Models\BotanicalIrrigation;
use App\Repositories\BotanicalIrrigationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class BotanicalIrrigationController
 * @package App\Http\Controllers\Api
 */

class BotanicalIrrigationAPIController extends AppBaseController
{
    /** @var  BotanicalIrrigationRepository */
    private $botanicalIrrigationRepository;

    public function __construct(BotanicalIrrigationRepository $botanicalIrrigationRepo)
    {
        $this->botanicalIrrigationRepository = $botanicalIrrigationRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/botanicalIrrigations",
     *      summary="Get a listing of the BotanicalIrrigations.",
     *      tags={"BotanicalIrrigation"},
     *      description="Get all BotanicalIrrigations",
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
     *                  @SWG\Items(ref="#/definitions/BotanicalIrrigation")
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
        $botanicalIrrigations = $this->botanicalIrrigationRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($botanicalIrrigations->toArray(), 'Botanical Irrigations retrieved successfully');
    }

    /**
     * @param CreateBotanicalIrrigationAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/botanicalIrrigations",
     *      summary="Store a newly created BotanicalIrrigation in storage",
     *      tags={"BotanicalIrrigation"},
     *      description="Store BotanicalIrrigation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="BotanicalIrrigation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BotanicalIrrigation")
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
     *                  ref="#/definitions/BotanicalIrrigation"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateBotanicalIrrigationAPIRequest $request)
    {
        $input = $request->all();

        $botanicalIrrigation = $this->botanicalIrrigationRepository->create($input);

        return $this->sendResponse($botanicalIrrigation->toArray(), 'Botanical Irrigation saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/botanicalIrrigations/{id}",
     *      summary="Display the specified BotanicalIrrigation",
     *      tags={"BotanicalIrrigation"},
     *      description="Get BotanicalIrrigation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BotanicalIrrigation",
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
     *                  ref="#/definitions/BotanicalIrrigation"
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
        /** @var BotanicalIrrigation $botanicalIrrigation */
        $botanicalIrrigation = $this->botanicalIrrigationRepository->find($id);

        if (empty($botanicalIrrigation)) {
            return $this->sendError('Botanical Irrigation not found');
        }

        return $this->sendResponse($botanicalIrrigation->toArray(), 'Botanical Irrigation retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateBotanicalIrrigationAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/botanicalIrrigations/{id}",
     *      summary="Update the specified BotanicalIrrigation in storage",
     *      tags={"BotanicalIrrigation"},
     *      description="Update BotanicalIrrigation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BotanicalIrrigation",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="BotanicalIrrigation that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BotanicalIrrigation")
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
     *                  ref="#/definitions/BotanicalIrrigation"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateBotanicalIrrigationAPIRequest $request)
    {
        $input = $request->all();

        /** @var BotanicalIrrigation $botanicalIrrigation */
        $botanicalIrrigation = $this->botanicalIrrigationRepository->find($id);

        if (empty($botanicalIrrigation)) {
            return $this->sendError('Botanical Irrigation not found');
        }

        $botanicalIrrigation = $this->botanicalIrrigationRepository->update($input, $id);

        return $this->sendResponse($botanicalIrrigation->toArray(), 'BotanicalIrrigation updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/botanicalIrrigations/{id}",
     *      summary="Remove the specified BotanicalIrrigation from storage",
     *      tags={"BotanicalIrrigation"},
     *      description="Delete BotanicalIrrigation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BotanicalIrrigation",
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
        /** @var BotanicalIrrigation $botanicalIrrigation */
        $botanicalIrrigation = $this->botanicalIrrigationRepository->find($id);

        if (empty($botanicalIrrigation)) {
            return $this->sendError('Botanical Irrigation not found');
        }

        $botanicalIrrigation->delete();

        return $this->sendResponse($id, 'Botanical Irrigation deleted successfully');
    }
}
