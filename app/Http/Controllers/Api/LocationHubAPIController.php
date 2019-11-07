<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\LocationHubAPIRequest;
use App\Models\Location;
use App\Repositories\LocationHubRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class LocationHubAPIController
 * @package App\Http\Controllers\Api
 */
class LocationHubAPIController extends AppBaseController
{
    /** @var  LocationHubRepository */
    private $locationHubRepository;

    public function __construct(LocationHubRepository $locationHubRepo)
    {
        $this->locationHubRepository = $locationHubRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/location_hubs",
     *      summary="Get a listing of the Locations.",
     *      tags={"Location"},
     *      description="Get all Locations",
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
     *                  @SWG\Items(ref="#/definitions/Location")
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
        $location_hubs = $this->locationHubRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($location_hubs->toArray(), 'Locations retrieved successfully');
    }

    /**
     * @param LocationHubAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/location_hubs",
     *      summary="Store a newly created Location in storage",
     *      tags={"Location"},
     *      description="Store Location",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="location_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/LocationHub")
     *      ),
     *      @SWG\Parameter(
     *          name="locationable_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/LocationHub")
     *      ),
     *      @SWG\Parameter(
     *          name="locationable_type",
     *          in="body",
     *          required=false,
     *          description="cryo_bank, action, location, user, media, plant",
     *          @SWG\Schema(ref="#/definitions/LocationHub")
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
     *                  ref="#/definitions/Location"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(LocationHubAPIRequest $request)
    {
        $input = $request->all();

        $location = $this->locationHubRepository->create($input);

        return $this->sendResponse($location->toArray(), 'Location saved successfully');
    }



    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/location_hubs/{id}",
     *      summary="Remove the specified Location from storage",
     *      tags={"Location"},
     *      description="Delete Location",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Location",
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
        /** @var Location $location */
        $location = $this->locationHubRepository->find($id, \request()->get('relations'));

        if ($location === null) {
            return $this->sendError('Location not found');
        }

        $location->delete();

        return $this->sendResponse($id, 'Location deleted successfully');
    }
}
