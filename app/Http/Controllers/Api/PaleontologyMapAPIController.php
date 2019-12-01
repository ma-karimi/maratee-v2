<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Paleontology\PaleontologyMapAPIRequest;
use App\Models\PaleontologyMap;
use App\Repositories\PaleontologyMapRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PaleontologyMapAPIController
 * @package App\Http\Controllers\Api
 */

class PaleontologyMapAPIController extends AppBaseController
{
    /** @var  PaleontologyMapRepository */
    private $paleontologyMapRepository;

    public function __construct(PaleontologyMapRepository $paleontologyMapRepo)
    {
        $this->paleontologyMapRepository = $paleontologyMapRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @throws \Exception
     * @SWG\Get(
     *      path="/paleontology_maps",
     *      summary="Get a listing of the Maps.",
     *      tags={"Map"},
     *      description="Get all Maps",
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
     *                  @SWG\Items(ref="#/definitions/PaleontologyMap")
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
        $maps = $this->paleontologyMapRepository->all(
            [],
            $request->get('per_page'),
            $request->except('per_page'),
            $this->getFieldRelation()
        );

        return $this->sendResponse($maps->toArray(), 'Paleontology Maps retrieved successfully');
    }

    /**
     * @param PaleontologyMapAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/paleontology_maps",
     *      summary="Store a newly created Map in storage",
     *      tags={"Map"},
     *      description="Store Map",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="reference",
     *          in="body",
     *          description="Map that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PaleontologyMap")
     *      ),
     *      @SWG\Parameter(
     *          name="file",
     *          in="body",
     *          description="Map that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PaleontologyMap")
     *      ),
     *      @SWG\Parameter(
     *          name="year",
     *          in="body",
     *          description="Map that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PaleontologyMap")
     *      ),
     *      @SWG\Parameter(
     *          name="scale",
     *          in="body",
     *          description="Map that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PaleontologyMap")
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
     *                  ref="#/definitions/PaleontologyMap"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(PaleontologyMapAPIRequest $request)
    {
        $input = $request->all();

        $map = $this->paleontologyMapRepository->create($input);

        return $this->sendResponse($map->toArray(), 'Paleontology Map saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/paleontology_maps/{id}",
     *      summary="Display the specified Map",
     *      tags={"Map"},
     *      description="Get Map",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Map",
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
     *                  ref="#/definitions/PaleontologyMap"
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
        /** @var PaleontologyMap $map */
        $map = $this->paleontologyMapRepository->find($id, $this->getFieldRelation());

        if ($map === null) {
            return $this->sendError('Paleontology Map not found');
        }

        return $this->sendResponse($map->toArray(), 'Paleontology Map retrieved successfully');
    }

    /**
     * @param int $id
     * @param PaleontologyMapAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/paleontology_maps/{id}",
     *      summary="Update the specified Map in storage",
     *      tags={"Map"},
     *      description="Update Map",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Map",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="reference",
     *          in="body",
     *          description="Map that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PaleontologyMap")
     *      ),
     *      @SWG\Parameter(
     *          name="file",
     *          in="body",
     *          description="Map that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PaleontologyMap")
     *      ),
     *      @SWG\Parameter(
     *          name="year",
     *          in="body",
     *          description="Map that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PaleontologyMap")
     *      ),
     *      @SWG\Parameter(
     *          name="scale",
     *          in="body",
     *          description="Map that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PaleontologyMap")
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
     *                  ref="#/definitions/PaleontologyMap"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, PaleontologyMapAPIRequest $request)
    {

        /** @var PaleontologyMap $map */
        $map = $this->paleontologyMapRepository->find($id);

        if ($map === null) {
            return $this->sendError('Paleontology Map not found');
        }

        $map = $this->paleontologyMapRepository->update($request, $id);

        return $this->sendResponse($map->toArray(), 'Paleontology Map updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/paleontology_maps/{id}",
     *      summary="Remove the specified Map from storage",
     *      tags={"Map"},
     *      description="Delete Map",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Map",
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
        /** @var PaleontologyMap $map */
        $map = $this->paleontologyMapRepository->find($id);

        if ($map === null) {
            return $this->sendError('Paleontology Map not found');
        }

        $map->delete();

        return $this->sendResponse($id, 'Paleontology Map deleted successfully');
    }

    /**
     * @return array
     */
    private function getFieldRelation(): array
    {
        return ['paleontology', 'media'];
    }
}
