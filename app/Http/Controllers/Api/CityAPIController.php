<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CityAPIRequest;
use App\Models\City;
use App\Models\Organization;
use App\Repositories\CityRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Cache;
use Response;

/**
 * Class CityController
 * @package App\Http\Controllers\Api
 */
class CityAPIController extends AppBaseController
{
    /** @var  CityRepository */
    private $cityRepository;

    public function __construct(CityRepository $cityRepo)
    {
        $this->cityRepository = $cityRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/cities",
     *      summary="Get a listing of the Cities.",
     *      tags={"City"},
     *      description="Get all Cities",
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
     *                  @SWG\Items(ref="#/definitions/City")
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
        $cities = $this->cityRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($cities->toArray(), 'Cities retrieved successfully');
    }

    /**
     * @param CityAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/cities",
     *      summary="Store a newly created City in storage",
     *      tags={"City"},
     *      description="Store City",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name_en",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/City")
     *      ),
     *      @SWG\Parameter(
     *          name="name_fa",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/City")
     *      ),
     *      @SWG\Parameter(
     *          name="province_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/City")
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
     *                  ref="#/definitions/City"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CityAPIRequest $request)
    {
        $input = $request->all();

        $city = $this->cityRepository->create($input);

        return $this->sendResponse($city->toArray(), 'City saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/cities/{id}",
     *      summary="Display the specified City",
     *      tags={"City"},
     *      description="Get City",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of City",
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
     *                  ref="#/definitions/City"
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
        /** @var City $city */
        $city = $this->cityRepository->find($id, \request()->get('relations'));

        if ($city === null) {
            return $this->sendError('City not found');
        }

        return $this->sendResponse($city->toArray(), 'City retrieved successfully');
    }

    /**
     * @param int $id
     * @param CityAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/cities/{id}",
     *      summary="Update the specified City in storage",
     *      tags={"City"},
     *      description="Update City",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of City",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="name_en",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/City")
     *      ),
     *      @SWG\Parameter(
     *          name="name_fa",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/City")
     *      ),
     *      @SWG\Parameter(
     *          name="province_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/City")
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
     *                  ref="#/definitions/City"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update(CityAPIRequest $request, $id)
    {
        $input = $request->all();

        /** @var City $city */
        $city = $this->cityRepository->find($id, \request()->get('relations'));

        if ($city === null) {
            return $this->sendError('City not found');
        }

        $city = $this->cityRepository->update($input, $id);

        return $this->sendResponse($city->toArray(), 'City updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/cities/{id}",
     *      summary="Remove the specified City from storage",
     *      tags={"City"},
     *      description="Delete City",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of City",
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
        /** @var City $city */
        $city = $this->cityRepository->find($id, \request()->get('relations'));

        if ($city === null) {
            return $this->sendError('City not found');
        }

        $city->delete();

        return $this->sendResponse($id, 'City deleted successfully');
    }


    /**
     * @return Response
     *
     * @SWG\Get(
     *      path="/cities/all",
     *      summary="Get a listing of the Cities.",
     *      tags={"Cities"},
     *      description="Get City",
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
     *                  ref="#/definitions/Organization"
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
    public function all()
    {
        /** @var City $city */
        $cities =
             $this->cityRepository->all();


        return $this->sendResponse($cities->toArray(), 'Cities retrieved successfully');
    }
}
