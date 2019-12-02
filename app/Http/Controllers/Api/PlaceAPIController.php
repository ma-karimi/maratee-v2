<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\PlaceAPIRequest;
use App\Models\Place;
use App\Repositories\PlaceRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class placeController
 * @package App\Http\Controllers\Api
 */

class PlaceAPIController extends AppBaseController
{
    /** @var  PlaceRepository */
    private $placeRepository;

    public function __construct(PlaceRepository $placeRepo)
    {
        $this->placeRepository = $placeRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/places",
     *      summary="Get a listing of the places.",
     *      tags={"place"},
     *      description="Get all places",
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
     *                  @SWG\Items(ref="#/definitions/PlantApplication")
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
        $places = $this->placeRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($places->toArray(), 'Places retrieved successfully');
    }

    /**
     * @param PlaceAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/places",
     *      summary="Store a newly created place in storage",
     *      tags={"place"},
     *      description="Store place",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name_en",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PlantApplication")
     *      ),
     *      @SWG\Parameter(
     *          name="name_fa",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantApplication")
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
     *                  ref="#/definitions/PlantApplication"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(PlaceAPIRequest $request)
    {
        $input = $request->all();

        $place = $this->placeRepository->create($input);

        return $this->sendResponse($place->toArray(), 'Place saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/places/{id}",
     *      summary="Display the specified place",
     *      tags={"place"},
     *      description="Get place",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of place",
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
     *                  ref="#/definitions/PlantApplication"
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
        /** @var Place $place */
        $place = $this->placeRepository->find($id, \request()->get('relations'));

        if ($place === null) {
            return $this->sendError('Place not found');
        }

        return $this->sendResponse($place->toArray(), 'Place retrieved successfully');
    }

    /**
     * @param int $id
     * @param PlaceAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/places/{id}",
     *      summary="Update the specified place in storage",
     *      tags={"place"},
     *      description="Update place",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of place",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="name_en",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PlantApplication")
     *      ),
     *      @SWG\Parameter(
     *          name="name_fa",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantApplication")
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
     *                  ref="#/definitions/PlantApplication"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, PlaceAPIRequest $request)
    {
        $input = $request->all();

        /** @var Place $place */
        $place = $this->placeRepository->find($id, \request()->get('relations'));

        if (empty($place)) {
            return $this->sendError('Place not found');
        }

        $place = $this->placeRepository->update($input, $id);

        return $this->sendResponse($place->toArray(), 'place updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/places/{id}",
     *      summary="Remove the specified place from storage",
     *      tags={"place"},
     *      description="Delete place",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of place",
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
        /** @var Place $place */
        $place = $this->placeRepository->find($id, \request()->get('relations'));

        if (empty($place)) {
            return $this->sendError('Place not found');
        }

        $place->delete();

        return $this->sendResponse($id, 'Place deleted successfully');
    }
}
