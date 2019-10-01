<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateGeologyAgeAPIRequest;
use App\Http\Requests\Api\UpdateGeologyAgeAPIRequest;
use App\Models\GeologyAge;
use App\Repositories\GeologyAgeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class GeologyAgeController
 * @package App\Http\Controllers\Api
 */

class GeologyAgeAPIController extends AppBaseController
{
    /** @var  GeologyAgeRepository */
    private $geologyAgeRepository;

    public function __construct(GeologyAgeRepository $geologyAgeRepo)
    {
        $this->geologyAgeRepository = $geologyAgeRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/geologyAges",
     *      summary="Get a listing of the GeologyAges.",
     *      tags={"GeologyAge"},
     *      description="Get all GeologyAges",
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
     *                  @SWG\Items(ref="#/definitions/GeologyAge")
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
        $geologyAges = $this->geologyAgeRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($geologyAges->toArray(), 'Geology Ages retrieved successfully');
    }

    /**
     * @param GeologyAgeAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/geologyAges",
     *      summary="Store a newly created GeologyAge in storage",
     *      tags={"GeologyAge"},
     *      description="Store GeologyAge",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="era",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/GeologyAge")
     *      ),
     *      @SWG\Parameter(
     *          name="period",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/GeologyAge")
     *      ),
     *      @SWG\Parameter(
     *          name="epoch",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/GeologyAge")
     *      ),
     *      @SWG\Parameter(
     *          name="stage",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/GeologyAge")
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
     *                  ref="#/definitions/GeologyAge"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(GeologyAgeAPIRequest $request)
    {
        $input = $request->all();

        $geologyAge = $this->geologyAgeRepository->create($input);

        return $this->sendResponse($geologyAge->toArray(), 'Geology Age saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/geologyAges/{id}",
     *      summary="Display the specified GeologyAge",
     *      tags={"GeologyAge"},
     *      description="Get GeologyAge",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of GeologyAge",
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
     *                  ref="#/definitions/GeologyAge"
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
        /** @var GeologyAge $geologyAge */
        $geologyAge = $this->geologyAgeRepository->find($id, \request()->get('relations'));

        if ($geologyAge === null) {
            return $this->sendError('Geology Age not found');
        }

        return $this->sendResponse($geologyAge->toArray(), 'Geology Age retrieved successfully');
    }

    /**
     * @param int $id
     * @param GeologyAgeAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/geologyAges/{id}",
     *      summary="Update the specified GeologyAge in storage",
     *      tags={"GeologyAge"},
     *      description="Update GeologyAge",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of GeologyAge",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="era",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/GeologyAge")
     *      ),
     *      @SWG\Parameter(
     *          name="period",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/GeologyAge")
     *      ),
     *      @SWG\Parameter(
     *          name="epoch",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/GeologyAge")
     *      ),
     *      @SWG\Parameter(
     *          name="stage",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/GeologyAge")
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
     *                  ref="#/definitions/GeologyAge"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update(GeologyAgeAPIRequest $request, $id)
    {
        $input = $request->all();

        /** @var GeologyAge $geologyAge */
        $geologyAge = $this->geologyAgeRepository->find($id, \request()->get('relations'));

        if ($geologyAge === null) {
            return $this->sendError('Geology Age not found');
        }

        $geologyAge = $this->geologyAgeRepository->update($input, $id);

        return $this->sendResponse($geologyAge->toArray(), 'GeologyAge updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/geologyAges/{id}",
     *      summary="Remove the specified GeologyAge from storage",
     *      tags={"GeologyAge"},
     *      description="Delete GeologyAge",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of GeologyAge",
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
        /** @var GeologyAge $geologyAge */
        $geologyAge = $this->geologyAgeRepository->find($id, \request()->get('relations'));

        if ($geologyAge === null) {
            return $this->sendError('Geology Age not found');
        }

        $geologyAge->delete();

        return $this->sendResponse($id, 'Geology Age deleted successfully');
    }
}
