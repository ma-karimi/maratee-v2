<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\CreateStationAPIRequest;
use App\Http\Requests\Api\UpdateStationAPIRequest;
use App\Models\Station;
use App\Repositories\StationRepository;
use Exception;
use Illuminate\Http\Request;
use Response;

/**
 * Class StationController
 * @package App\Http\Controllers\Api
 */
class StationAPIController extends AppBaseController
{
    /** @var  StationRepository */
    private $stationRepository;

    public function __construct(StationRepository $stationRepo)
    {
        $this->stationRepository = $stationRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/stations",
     *      summary="Get a listing of the Stations.",
     *      tags={"Station"},
     *      description="Get all Stations",
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
     *                  @SWG\Items(ref="#/definitions/Station")
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
        $stations = $this->stationRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($stations->toArray(), 'Stations retrieved successfully');
    }

    /**
     * @param CreateStationAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/stations",
     *      summary="Store a newly created Station in storage",
     *      tags={"Station"},
     *      description="Store Station",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="location_id",
     *          in="body",
     *          description="Station that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Station")
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="Station that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Station")
     *      ),
     *      @SWG\Parameter(
     *          name="code",
     *          in="body",
     *          description="Station that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Station")
     *      ),
     *      @SWG\Parameter(
     *          name="type",
     *          in="body",
     *          description="Station that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Station")
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
     *                  ref="#/definitions/Station"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateStationAPIRequest $request)
    {
        $input = $request->all();

        $station = $this->stationRepository->create($input);

        return $this->sendResponse($station->toArray(), 'Station saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/stations/{id}",
     *      summary="Display the specified Station",
     *      tags={"Station"},
     *      description="Get Station",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Station",
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
     *                  ref="#/definitions/Station"
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
        /** @var Station $station */
        $station = $this->stationRepository->find($id);

        if (empty($station)) {
            return $this->sendError('Station not found');
        }

        return $this->sendResponse($station->toArray(), 'Station retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateStationAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/stations/{id}",
     *      summary="Update the specified Station in storage",
     *      tags={"Station"},
     *      description="Update Station",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Station",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="location_id",
     *          in="body",
     *          description="Station that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Station")
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="Station that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Station")
     *      ),
     *      @SWG\Parameter(
     *          name="code",
     *          in="body",
     *          description="Station that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Station")
     *      ),
     *      @SWG\Parameter(
     *          name="type",
     *          in="body",
     *          description="Station that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Station")
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
     *                  ref="#/definitions/Station"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateStationAPIRequest $request)
    {
        $input = $request->all();

        /** @var Station $station */
        $station = $this->stationRepository->find($id);

        if (empty($station)) {
            return $this->sendError('Station not found');
        }

        $station = $this->stationRepository->update($input, $id);

        return $this->sendResponse($station->toArray(), 'Station updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/stations/{id}",
     *      summary="Remove the specified Station from storage",
     *      tags={"Station"},
     *      description="Delete Station",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Station",
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
     * @throws Exception
     */
    public function destroy($id)
    {
        /** @var Station $station */
        $station = $this->stationRepository->find($id);

        if (empty($station)) {
            return $this->sendError('Station not found');
        }

        $station->delete();

        return $this->sendResponse($id, 'Station deleted successfully');
    }
}
