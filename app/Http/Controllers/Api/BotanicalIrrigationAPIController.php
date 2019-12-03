<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Botanical\BotanicalIrrigationAPIRequest;
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
     *      path="/botanical_irrigations",
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
     * @throws \Exception
     */
    public function index(Request $request)
    {
        $botanicalIrrigations = $this->botanicalIrrigationRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($botanicalIrrigations->toArray(), 'Botanical Irrigations retrieved successfully');
    }

    /**
     * @param BotanicalIrrigationAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/botanical_irrigations",
     *      summary="Store a newly created BotanicalIrrigation in storage",
     *      tags={"BotanicalIrrigation"},
     *      description="Store BotanicalIrrigation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="botanical_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BotanicalIrrigation")
     *      ),
     *      @SWG\Parameter(
     *          name="irrigation_id",
     *          in="body",
     *          description="[1 => 'mist', 2 => 'sprinkler', 3 => 'drip', 4 => 'manual', 5 => 'pot watering', 6=>'none']"
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BotanicalIrrigation")
     *      ),
     *      @SWG\Parameter(
     *          name="requirement_id",
     *          description="[1 => 'sparse', 2 => 'moderate', 3 => 'heavy']",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BotanicalIrrigation")
     *      ),
     *      @SWG\Parameter(
     *          name="irrigation_time_id",
     *           description="[1 => 'indifferent', 2 => 'morning', 3 => 'day', 4 => 'evening', 5 => 'night']",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BotanicalIrrigation")
     *      ),
     *      @SWG\Parameter(
     *          name="spring_time",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BotanicalIrrigation")
     *      ),
     *      @SWG\Parameter(
     *          name="autumn_time",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BotanicalIrrigation")
     *      ),
     *      @SWG\Parameter(
     *          name="summer_time",
     *          in="body",
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
    public function store(BotanicalIrrigationAPIRequest $request)
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
     *      path="/botanical_irrigations/{id}",
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
        $botanicalIrrigation = $this->botanicalIrrigationRepository->find($id, \request()->get('relations'));

        if ($botanicalIrrigation === null) {
            return $this->sendError('Botanical Irrigation not found');
        }

        return $this->sendResponse($botanicalIrrigation->toArray(), 'Botanical Irrigation retrieved successfully');
    }

    /**
     * @param int $id
     * @param BotanicalIrrigationAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/botanical_irrigations/{id}",
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
     *          name="botanical_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BotanicalIrrigation")
     *      ),
     *      @SWG\Parameter(
     *          name="irrigation_id",
     *          in="body",
     *          description="[1 => 'mist', 2 => 'sprinkler', 3 => 'drip', 4 => 'manual', 5 => 'pot watering', 6=>'none']"
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BotanicalIrrigation")
     *      ),
     *      @SWG\Parameter(
     *          name="requirement_id",
     *          description="[1 => 'sparse', 2 => 'moderate', 3 => 'heavy']",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BotanicalIrrigation")
     *      ),
     *      @SWG\Parameter(
     *          name="irrigation_time_id",
     *           description="[1 => 'indifferent', 2 => 'morning', 3 => 'day', 4 => 'evening', 5 => 'night']",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BotanicalIrrigation")
     *      ),
     *      @SWG\Parameter(
     *          name="spring_time",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BotanicalIrrigation")
     *      ),
     *      @SWG\Parameter(
     *          name="autumn_time",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BotanicalIrrigation")
     *      ),
     *      @SWG\Parameter(
     *          name="summer_time",
     *          in="body",
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
    public function update($id, BotanicalIrrigationAPIRequest $request)
    {
        $input = $request->all();

        /** @var BotanicalIrrigation $botanicalIrrigation */
        $botanicalIrrigation = $this->botanicalIrrigationRepository->find($id, \request()->get('relations'));

        if ($botanicalIrrigation === null) {
            return $this->sendError('Botanical Irrigation not found');
        }

        $botanicalIrrigation = $this->botanicalIrrigationRepository->update($input, $id);

        return $this->sendResponse($botanicalIrrigation->toArray(), 'BotanicalIrrigation updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/botanical_irrigations/{id}",
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
        $botanicalIrrigation = $this->botanicalIrrigationRepository->find($id, \request()->get('relations'));

        if ($botanicalIrrigation === null) {
            return $this->sendError('Botanical Irrigation not found');
        }

        $botanicalIrrigation->delete();

        return $this->sendResponse($id, 'Botanical Irrigation deleted successfully');
    }
}
