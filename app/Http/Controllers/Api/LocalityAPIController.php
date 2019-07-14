<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateLocalityAPIRequest;
use App\Http\Requests\Api\UpdateLocalityAPIRequest;
use App\Models\Locality;
use App\Repositories\LocalityRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class LocalityController
 * @package App\Http\Controllers\Api
 */

class LocalityAPIController extends AppBaseController
{
    /** @var  LocalityRepository */
    private $localityRepository;

    public function __construct(LocalityRepository $localityRepo)
    {
        $this->localityRepository = $localityRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/localities",
     *      summary="Get a listing of the Localities.",
     *      tags={"Locality"},
     *      description="Get all Localities",
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
     *                  @SWG\Items(ref="#/definitions/Locality")
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
        $localities = $this->localityRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($localities->toArray(), 'Localities retrieved successfully');
    }

    /**
     * @param CreateLocalityAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/localities",
     *      summary="Store a newly created Locality in storage",
     *      tags={"Locality"},
     *      description="Store Locality",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Locality that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Locality")
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
     *                  ref="#/definitions/Locality"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateLocalityAPIRequest $request)
    {
        $input = $request->all();

        $locality = $this->localityRepository->create($input);

        return $this->sendResponse($locality->toArray(), 'Locality saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/localities/{id}",
     *      summary="Display the specified Locality",
     *      tags={"Locality"},
     *      description="Get Locality",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Locality",
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
     *                  ref="#/definitions/Locality"
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
        /** @var Locality $locality */
        $locality = $this->localityRepository->find($id);

        if (empty($locality)) {
            return $this->sendError('Locality not found');
        }

        return $this->sendResponse($locality->toArray(), 'Locality retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateLocalityAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/localities/{id}",
     *      summary="Update the specified Locality in storage",
     *      tags={"Locality"},
     *      description="Update Locality",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Locality",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Locality that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Locality")
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
     *                  ref="#/definitions/Locality"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateLocalityAPIRequest $request)
    {
        $input = $request->all();

        /** @var Locality $locality */
        $locality = $this->localityRepository->find($id);

        if (empty($locality)) {
            return $this->sendError('Locality not found');
        }

        $locality = $this->localityRepository->update($input, $id);

        return $this->sendResponse($locality->toArray(), 'Locality updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/localities/{id}",
     *      summary="Remove the specified Locality from storage",
     *      tags={"Locality"},
     *      description="Delete Locality",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Locality",
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
        /** @var Locality $locality */
        $locality = $this->localityRepository->find($id);

        if (empty($locality)) {
            return $this->sendError('Locality not found');
        }

        $locality->delete();

        return $this->sendResponse($id, 'Locality deleted successfully');
    }
}
