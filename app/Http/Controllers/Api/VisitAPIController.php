<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\CreateVisitAPIRequest;
use App\Http\Requests\Api\UpdateVisitAPIRequest;
use App\Models\Visit;
use App\Repositories\VisitRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class VisitController
 * @package App\Http\Controllers\Api
 */

class VisitAPIController extends AppBaseController
{
    /** @var  VisitRepository */
    private $visitRepository;

    public function __construct(VisitRepository $visitRepo)
    {
        $this->visitRepository = $visitRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/visits",
     *      summary="Get a listing of the Visits.",
     *      tags={"Visit"},
     *      description="Get all Visits",
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
     *                  @SWG\Items(ref="#/definitions/Visit")
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
        $visits = $this->visitRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($visits->toArray(), 'Visits retrieved successfully');
    }

    /**
     * @param CreateVisitAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/visits",
     *      summary="Store a newly created Visit in storage",
     *      tags={"Visit"},
     *      description="Store Visit",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="date",
     *          in="body",
     *          description="Visit that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Visit")
     *      ),
     *     @SWG\Parameter(
     *          name="user_id",
     *          in="body",
     *          description="Visit that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Visit")
     *      ),
     *     @SWG\Parameter(
     *          name="purpose",
     *          in="body",
     *          description="Visit that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Visit")
     *      ),
     *     @SWG\Parameter(
     *          name="peoples",
     *          in="body",
     *          description="Visit that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Visit")
     *      ),
     *     @SWG\Parameter(
     *          name="archives_types",
     *          in="body",
     *          description="Visit that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Visit")
     *      ),
     *     @SWG\Parameter(
     *          name="archive_no",
     *          in="body",
     *          description="Visit that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Visit")
     *      ),
     *     @SWG\Parameter(
     *          name="plantology_id",
     *          in="body",
     *          description="Visit that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Visit")
     *      ),
     *     @SWG\Parameter(
     *          name="media_id",
     *          in="body",
     *          description="Visit that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Visit")
     *      ),
     *     @SWG\Parameter(
     *          name="user_id",
     *          in="body",
     *          description="Visit that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Visit")
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
     *                  ref="#/definitions/Visit"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateVisitAPIRequest $request)
    {
        $input = $request->all();

        $visit = $this->visitRepository->create($input);

        return $this->sendResponse($visit->toArray(), 'Visit saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/visits/{id}",
     *      summary="Display the specified Visit",
     *      tags={"Visit"},
     *      description="Get Visit",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Visit",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="date",
     *          in="body",
     *          description="Visit that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Visit")
     *      ),
     *     @SWG\Parameter(
     *          name="user_id",
     *          in="body",
     *          description="Visit that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Visit")
     *      ),
     *     @SWG\Parameter(
     *          name="purpose",
     *          in="body",
     *          description="Visit that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Visit")
     *      ),
     *     @SWG\Parameter(
     *          name="peoples",
     *          in="body",
     *          description="Visit that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Visit")
     *      ),
     *     @SWG\Parameter(
     *          name="archives_types",
     *          in="body",
     *          description="Visit that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Visit")
     *      ),
     *     @SWG\Parameter(
     *          name="archive_no",
     *          in="body",
     *          description="Visit that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Visit")
     *      ),
     *     @SWG\Parameter(
     *          name="plantology_id",
     *          in="body",
     *          description="Visit that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Visit")
     *      ),
     *     @SWG\Parameter(
     *          name="media_id",
     *          in="body",
     *          description="Visit that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Visit")
     *      ),
     *     @SWG\Parameter(
     *          name="user_id",
     *          in="body",
     *          description="Visit that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Visit")
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
     *                  ref="#/definitions/Visit"
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
        /** @var Visit $visit */
        $visit = $this->visitRepository->find($id);

        if (empty($visit)) {
            return $this->sendError('Visit not found');
        }

        return $this->sendResponse($visit->toArray(), 'Visit retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateVisitAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/visits/{id}",
     *      summary="Update the specified Visit in storage",
     *      tags={"Visit"},
     *      description="Update Visit",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Visit",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Visit that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Visit")
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
     *                  ref="#/definitions/Visit"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateVisitAPIRequest $request)
    {
        $input = $request->all();

        /** @var Visit $visit */
        $visit = $this->visitRepository->find($id);

        if (empty($visit)) {
            return $this->sendError('Visit not found');
        }

        $visit = $this->visitRepository->update($input, $id);

        return $this->sendResponse($visit->toArray(), 'Visit updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/visits/{id}",
     *      summary="Remove the specified Visit from storage",
     *      tags={"Visit"},
     *      description="Delete Visit",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Visit",
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
        /** @var Visit $visit */
        $visit = $this->visitRepository->find($id);

        if (empty($visit)) {
            return $this->sendError('Visit not found');
        }

        $visit->delete();

        return $this->sendResponse($id, 'Visit deleted successfully');
    }
}
