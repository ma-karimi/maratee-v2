<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\GeographicalAPIRequest;
use App\Repositories\GeographicalRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class GeographicalController
 * @package App\Http\Controllers\Api
 */

class GeographicalAPIController extends AppBaseController
{
    /** @var  GeographicalRepository */
    private $geographicalRepository;

    public function __construct(GeographicalRepository $geographicalRepo)
    {
        $this->geographicalRepository = $geographicalRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/geographicals",
     *      summary="Get a listing of the Geographicals.",
     *      tags={"Geographical"},
     *      description="Get all Geographicals",
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
     *                  @SWG\Items(ref="#/definitions/Geographical")
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
        $geographicals = $this->geographicalRepository->all(
            [],
            null,
            null,
            $request->get('relations')
        );

        return $this->sendResponse($geographicals->toArray(), 'Geographicals retrieved successfully');
    }

    /**
     * @param GeographicalAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/geographicals",
     *      summary="Store a newly created Geographical in storage",
     *      tags={"Geographical"},
     *      description="Store Geographical",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Geographical")
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
     *                  ref="#/definitions/Geographical"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(GeographicalAPIRequest $request)
    {
        $input = $request->all();

        $geographical = $this->geographicalRepository->create($input);

        return $this->sendResponse($geographical->toArray(), 'Geographical saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/geographicals/{id}",
     *      summary="Display the specified Geographical",
     *      tags={"Geographical"},
     *      description="Get Geographical",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Geographical",
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
     *                  ref="#/definitions/Geographical"
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
        $geographical = $this->geographicalRepository->find($id, \request()->get('relations'));

        if ($geographical === null) {
            return $this->sendError('Geographical not found');
        }

        return $this->sendResponse($geographical->toArray(), 'Geographical retrieved successfully');
    }

    /**
     * @param int $id
     * @param GeographicalAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/geographicals/{id}",
     *      summary="Update the specified Geographical in storage",
     *      tags={"Geographical"},
     *      description="Update Geographical",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Geographical",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Geographical")
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
     *                  ref="#/definitions/Geographical"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, GeographicalAPIRequest $request)
    {
        $input = $request->all();

        $geographical = $this->geographicalRepository->find($id, \request()->get('relations'));

        if ($geographical === null) {
            return $this->sendError('Geographical not found');
        }

        $geographical = $this->geographicalRepository->update($input, $id);

        return $this->sendResponse($geographical->toArray(), 'Geographical updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/geographicals/{id}",
     *      summary="Remove the specified Geographical from storage",
     *      tags={"Geographical"},
     *      description="Delete Geographical",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Geographical",
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
        $geographical = $this->geographicalRepository->find($id, \request()->get('relations'));

        if ($geographical === null) {
            return $this->sendError('Geographical not found');
        }

        $geographical->delete();

        return $this->sendResponse($id, 'Geographical deleted successfully');
    }
}
