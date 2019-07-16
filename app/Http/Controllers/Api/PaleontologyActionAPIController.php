<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreatePaleontologyActionAPIRequest;
use App\Http\Requests\Api\UpdatePaleontologyActionAPIRequest;
use App\Models\PaleontologyAction;
use App\Repositories\PaleontologyActionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PaleontologyActionController
 * @package App\Http\Controllers\Api
 */

class PaleontologyActionAPIController extends AppBaseController
{
    /** @var  PaleontologyActionRepository */
    private $paleontologyActionRepository;

    public function __construct(PaleontologyActionRepository $paleontologyActionRepo)
    {
        $this->paleontologyActionRepository = $paleontologyActionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/paleontologyActions",
     *      summary="Get a listing of the PaleontologyActions.",
     *      tags={"PaleontologyAction"},
     *      description="Get all PaleontologyActions",
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
     *                  @SWG\Items(ref="#/definitions/PaleontologyAction")
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
        $paleontologyActions = $this->paleontologyActionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($paleontologyActions->toArray(), 'Paleontology Actions retrieved successfully');
    }

    /**
     * @param CreatePaleontologyActionAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/paleontologyActions",
     *      summary="Store a newly created PaleontologyAction in storage",
     *      tags={"PaleontologyAction"},
     *      description="Store PaleontologyAction",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="paleontology_id",
     *          in="body",
     *          description="PaleontologyAction that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PaleontologyAction")
     *      ),
     *      @SWG\Parameter(
     *          name="user_id",
     *          in="body",
     *          description="PaleontologyAction that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PaleontologyAction")
     *      ),
     *      @SWG\Parameter(
     *          name="action_id",
     *          in="body",
     *          description="PaleontologyAction that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PaleontologyAction")
     *      ),
     *      @SWG\Parameter(
     *          name="date",
     *          in="body",
     *          description="PaleontologyAction that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PaleontologyAction")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="PaleontologyAction that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PaleontologyAction")
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
     *                  ref="#/definitions/PaleontologyAction"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePaleontologyActionAPIRequest $request)
    {
        $input = $request->all();

        $paleontologyAction = $this->paleontologyActionRepository->create($input);

        return $this->sendResponse($paleontologyAction->toArray(), 'Paleontology Action saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/paleontologyActions/{id}",
     *      summary="Display the specified PaleontologyAction",
     *      tags={"PaleontologyAction"},
     *      description="Get PaleontologyAction",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of PaleontologyAction",
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
     *                  ref="#/definitions/PaleontologyAction"
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
        /** @var PaleontologyAction $paleontologyAction */
        $paleontologyAction = $this->paleontologyActionRepository->find($id);

        if (empty($paleontologyAction)) {
            return $this->sendError('Paleontology Action not found');
        }

        return $this->sendResponse($paleontologyAction->toArray(), 'Paleontology Action retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePaleontologyActionAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/paleontologyActions/{id}",
     *      summary="Update the specified PaleontologyAction in storage",
     *      tags={"PaleontologyAction"},
     *      description="Update PaleontologyAction",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of PaleontologyAction",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="paleontology_id",
     *          in="body",
     *          description="PaleontologyAction that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PaleontologyAction")
     *      ),
     *      @SWG\Parameter(
     *          name="user_id",
     *          in="body",
     *          description="PaleontologyAction that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PaleontologyAction")
     *      ),
     *      @SWG\Parameter(
     *          name="action_id",
     *          in="body",
     *          description="PaleontologyAction that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PaleontologyAction")
     *      ),
     *      @SWG\Parameter(
     *          name="date",
     *          in="body",
     *          description="PaleontologyAction that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PaleontologyAction")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="PaleontologyAction that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PaleontologyAction")
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
     *                  ref="#/definitions/PaleontologyAction"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePaleontologyActionAPIRequest $request)
    {
        $input = $request->all();

        /** @var PaleontologyAction $paleontologyAction */
        $paleontologyAction = $this->paleontologyActionRepository->find($id);

        if (empty($paleontologyAction)) {
            return $this->sendError('Paleontology Action not found');
        }

        $paleontologyAction = $this->paleontologyActionRepository->update($input, $id);

        return $this->sendResponse($paleontologyAction->toArray(), 'PaleontologyAction updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/paleontologyActions/{id}",
     *      summary="Remove the specified PaleontologyAction from storage",
     *      tags={"PaleontologyAction"},
     *      description="Delete PaleontologyAction",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of PaleontologyAction",
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
        /** @var PaleontologyAction $paleontologyAction */
        $paleontologyAction = $this->paleontologyActionRepository->find($id);

        if (empty($paleontologyAction)) {
            return $this->sendError('Paleontology Action not found');
        }

        $paleontologyAction->delete();

        return $this->sendResponse($id, 'Paleontology Action deleted successfully');
    }
}
