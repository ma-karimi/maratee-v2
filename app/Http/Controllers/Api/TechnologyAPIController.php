<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateTechnologyAPIRequest;
use App\Http\Requests\Api\UpdateTechnologyAPIRequest;
use App\Models\Technology;
use App\Repositories\TechnologyRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class TechnologyController
 * @package App\Http\Controllers\Api
 */

class TechnologyAPIController extends AppBaseController
{
    /** @var  TechnologyRepository */
    private $technologyRepository;

    public function __construct(TechnologyRepository $technologyRepo)
    {
        $this->technologyRepository = $technologyRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/technologys",
     *      summary="Get a listing of the Technologys.",
     *      tags={"Technology"},
     *      description="Get all Technologys",
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
     *                  @SWG\Items(ref="#/definitions/Technology")
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
        $technologys = $this->technologyRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($technologys->toArray(), 'Technology s retrieved successfully');
    }

    /**
     * @param CreateTechnologyAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/technologys",
     *      summary="Store a newly created Technology in storage",
     *      tags={"Technology"},
     *      description="Store Technology",
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
     *                  ref="#/definitions/Technology"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTechnologyAPIRequest $request)
    {
        $input = $request->all();

        $technology = $this->technologyRepository->create($input);

        return $this->sendResponse($technology->toArray(), 'Technology  saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/technologys/{id}",
     *      summary="Display the specified Technology",
     *      tags={"Technology"},
     *      description="Get Technology",
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
     *                  ref="#/definitions/Technology"
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
        /** @var Technology $technology */
        $technology = $this->technologyRepository->find($id, \request()->get('relations'));

        if (empty($technology)) {
            return $this->sendError('Technology  not found');
        }

        return $this->sendResponse($technology->toArray(), 'Technology  retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateTechnologyAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/technologys/{id}",
     *      summary="Update the specified Technology in storage",
     *      tags={"Technology"},
     *      description="Update Technology",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Technology",
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
     *                  ref="#/definitions/Technology"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTechnologyAPIRequest $request)
    {
        $input = $request->all();

        /** @var Technology $technology */
        $technology = $this->technologyRepository->find($id, \request()->get('relations'));

        if (empty($technology)) {
            return $this->sendError('Technology  not found');
        }

        $technology = $this->technologyRepository->update($input, $id);

        return $this->sendResponse($technology->toArray(), 'Technology updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/technologys/{id}",
     *      summary="Remove the specified Technology from storage",
     *      tags={"Technology"},
     *      description="Delete Technology",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Technology",
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
        /** @var Technology $technology */
        $technology = $this->technologyRepository->find($id, \request()->get('relations'));

        if (empty($technology)) {
            return $this->sendError('Technology  not found');
        }

        $technology->delete();

        return $this->sendResponse($id, 'Technology  deleted successfully');
    }
}
