<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\GardenAPIRequest;
use App\Models\Garden;
use App\Repositories\GardenRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class GardenController
 * @package App\Http\Controllers\Api
 */

class GardenAPIController extends AppBaseController
{
    /** @var  GardenRepository */
    private $gardenRepository;

    public function __construct(GardenRepository $gardenRepo)
    {
        $this->gardenRepository = $gardenRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/gardens",
     *      summary="Get a listing of the Gardens.",
     *      tags={"Garden"},
     *      description="Get all Gardens",
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
     *                  @SWG\Items(ref="#/definitions/Garden")
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
        $gardens = $this->gardenRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($gardens->toArray(), 'Gardens retrieved successfully');
    }

    /**
     * @param GardenAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/gardens",
     *      summary="Store a newly created Garden in storage",
     *      tags={"Garden"},
     *      description="Store Garden",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          required=true,
     *          type="string",
     *          @SWG\Schema(ref="#/definitions/Garden")
     *      ),
     *      @SWG\Parameter(
     *          name="region",
     *          in="body",
     *          required=false,
     *          type="string",
     *          @SWG\Schema(ref="#/definitions/Garden")
     *      ),
     *      @SWG\Parameter(
     *          name="section",
     *          in="body",
     *          required=false,
     *          type="string",
     *          @SWG\Schema(ref="#/definitions/Garden")
     *      ),
     *      @SWG\Parameter(
     *          name="number",
     *          in="body",
     *          required=false,
     *          type="number",
     *          @SWG\Schema(ref="#/definitions/Garden")
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
     *                  ref="#/definitions/Garden"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(GardenAPIRequest $request)
    {
        $input = $request->all();

        $garden = $this->gardenRepository->create($input);

        return $this->sendResponse($garden->toArray(), 'Garden saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/gardens/{id}",
     *      summary="Display the specified Garden",
     *      tags={"Garden"},
     *      description="Get Garden",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Garden",
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
     *                  ref="#/definitions/Garden"
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
        /** @var Garden $garden */
        $garden = $this->gardenRepository->find($id, \request()->get('relations'));

        if ($garden === null) {
            return $this->sendError('Garden not found');
        }

        return $this->sendResponse($garden->toArray(), 'Garden retrieved successfully');
    }

    /**
     * @param int $id
     * @param GardenAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/gardens/{id}",
     *      summary="Update the specified Garden in storage",
     *      tags={"Garden"},
     *      description="Update Garden",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Garden",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          required=true,
     *          type="string",
     *          @SWG\Schema(ref="#/definitions/Garden")
     *      ),
     *      @SWG\Parameter(
     *          name="region",
     *          in="body",
     *          required=false,
     *          type="string",
     *          @SWG\Schema(ref="#/definitions/Garden")
     *      ),
     *      @SWG\Parameter(
     *          name="section",
     *          in="body",
     *          required=false,
     *          type="string",
     *          @SWG\Schema(ref="#/definitions/Garden")
     *      ),
     *      @SWG\Parameter(
     *          name="number",
     *          in="body",
     *          required=false,
     *          type="number",
     *          @SWG\Schema(ref="#/definitions/Garden")
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
     *                  ref="#/definitions/Garden"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, GardenAPIRequest $request)
    {
        $input = $request->all();

        /** @var Garden $garden */
        $garden = $this->gardenRepository->find($id, \request()->get('relations'));

        if ($garden === null) {
            return $this->sendError('Garden not found');
        }

        $garden = $this->gardenRepository->update($input, $id);

        return $this->sendResponse($garden->toArray(), 'Garden updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/gardens/{id}",
     *      summary="Remove the specified Garden from storage",
     *      tags={"Garden"},
     *      description="Delete Garden",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Garden",
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
        /** @var Garden $garden */
        $garden = $this->gardenRepository->find($id, \request()->get('relations'));

        if ($garden === null) {
            return $this->sendError('Garden not found');
        }

        $garden->delete();

        return $this->sendResponse($id, 'Garden deleted successfully');
    }
}
