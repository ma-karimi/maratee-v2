<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\CreateLocationAPIRequest;
use App\Http\Requests\Api\UpdateLocationAPIRequest;
use App\Models\Location;
use App\Repositories\LocationRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class LocationController
 * @package App\Http\Controllers\Api
 */
class LocationAPIController extends AppBaseController
{
    /** @var  LocationRepository */
    private $locationRepository;

    public function __construct(LocationRepository $locationRepo)
    {
        $this->locationRepository = $locationRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/locations",
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
     */
    public function index(Request $request)
    {
        $locations = $this->locationRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($locations->toArray(), 'Locations retrieved successfully');
    }

    /**
     * @param CreateLocationAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/locations",
     *      summary="Store a newly created Location in storage",
     *      tags={"Location"},
     *      description="Store Location",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="address",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Location")
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Location")
     *      ),
     *      @SWG\Parameter(
     *          name="region_name",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Location")
     *      ),
     *      @SWG\Parameter(
     *          name="village_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Location")
     *      ),
     *      @SWG\Parameter(
     *          name="city_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Location")
     *      ),
     *      @SWG\Parameter(
     *          name="altitude",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Location")
     *      ),
     *      @SWG\Parameter(
     *          name="point",
     *          in="body",
     *          description="Lat and Lng",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Location")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Location")
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
    public function store(CreateLocationAPIRequest $request)
    {
        $input = $request->all();

        $location = $this->locationRepository->create($input);

        return $this->sendResponse($location->toArray(), 'Location saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/locations/{id}",
     *      summary="Display the specified Location",
     *      tags={"Location"},
     *      description="Get Location",
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
    public function show($id)
    {
        /** @var Location $location */
        $location = $this->locationRepository->find($id, ['city', 'village']);

        if ($location === null) {
            return $this->sendError('Location not found');
        }

        return $this->sendResponse($location->toArray(), 'Location retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateLocationAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/locations/{id}",
     *      summary="Update the specified Location in storage",
     *      tags={"Location"},
     *      description="Update Location",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Location",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="address",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Location")
     *      ),
     *      @SWG\Parameter(
     *          name="village_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Location")
     *      ),
     *      @SWG\Parameter(
     *          name="city_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Location")
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Location")
     *      ),
     *      @SWG\Parameter(
     *          name="region_name",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Location")
     *      ),
     *      @SWG\Parameter(
     *          name="altitude",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Location")
     *      ),
     *      @SWG\Parameter(
     *          name="point",
     *          in="body",
     *          description="Lat and Lng",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Location")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Location")
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
    public function update($id, UpdateLocationAPIRequest $request)
    {
        $input = $request->all();

        /** @var Location $location */
        $location = $this->locationRepository->find($id);

        if ($location === null) {
            return $this->sendError('Location not found');
        }

        $location = $this->locationRepository->update($input, $id);

        return $this->sendResponse($location->toArray(), 'Location updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/locations/{id}",
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
        $location = $this->locationRepository->find($id);

        if ($location === null) {
            return $this->sendError('Location not found');
        }

        $location->delete();

        return $this->sendResponse($id, 'Location deleted successfully');
    }
}
