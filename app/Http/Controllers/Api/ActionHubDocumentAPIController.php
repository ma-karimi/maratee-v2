<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\CreateActionHubDocumentAPIRequest;
use App\Http\Requests\Api\UpdateActionHubDocumentAPIRequest;
use App\Models\ActionHubDocument;
use App\Repositories\ActionHubDocumentRepository;
use Exception;
use Illuminate\Http\Request;
use Response;

/**
 * Class ActionHubDocumentController
 * @package App\Http\Controllers\Api
 */
class ActionHubDocumentAPIController extends AppBaseController
{
    /** @var  ActionHubDocumentRepository */
    private $actionHubDocumentRepository;

    public function __construct(ActionHubDocumentRepository $actionHubDocumentRepo)
    {
        $this->actionHubDocumentRepository = $actionHubDocumentRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/actionHubDocuments",
     *      summary="Get a listing of the ActionHubDocuments.",
     *      tags={"ActionHubDocument"},
     *      description="Get all ActionHubDocuments",
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
     *                  @SWG\Items(ref="#/definitions/ActionHubDocument")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     * @throws Exception
     */
    public function index(Request $request)
    {
        $actionHubDocuments = $this->actionHubDocumentRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($actionHubDocuments->toArray(), 'Action Hub Documents retrieved successfully');
    }

    /**
     * @param CreateActionHubDocumentAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/actionHubDocuments",
     *      summary="Store a newly created ActionHubDocument in storage",
     *      tags={"ActionHubDocument"},
     *      description="Store ActionHubDocument",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="action_hub_id",
     *          in="body",
     *          description="PaleontologyDocument that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PaleontologyDocument")
     *      ),
     *      @SWG\Parameter(
     *          name="src",
     *          in="body",
     *          description="PaleontologyDocument that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PaleontologyDocument")
     *      ),
     *      @SWG\Parameter(
     *          name="src_description",
     *          in="body",
     *          description="PaleontologyDocument that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PaleontologyDocument")
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
     *                  ref="#/definitions/ActionHubDocument"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateActionHubDocumentAPIRequest $request)
    {
        $input = $request->all();

        $actionHubDocument = $this->actionHubDocumentRepository->create($input);

        return $this->sendResponse($actionHubDocument->toArray(), 'Action Hub Document saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/actionHubDocuments/{id}",
     *      summary="Display the specified ActionHubDocument",
     *      tags={"ActionHubDocument"},
     *      description="Get ActionHubDocument",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ActionHubDocument",
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
     *                  ref="#/definitions/ActionHubDocument"
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
        /** @var ActionHubDocument $actionHubDocument */
        $actionHubDocument = $this->actionHubDocumentRepository->find($id);

        if (empty($actionHubDocument)) {
            return $this->sendError('Action Hub Document not found');
        }

        return $this->sendResponse($actionHubDocument->toArray(), 'Action Hub Document retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateActionHubDocumentAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/actionHubDocuments/{id}",
     *      summary="Update the specified ActionHubDocument in storage",
     *      tags={"ActionHubDocument"},
     *      description="Update ActionHubDocument",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ActionHubDocument",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="action_hub_id",
     *          in="body",
     *          description="PaleontologyDocument that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PaleontologyDocument")
     *      ),
     *      @SWG\Parameter(
     *          name="src",
     *          in="body",
     *          description="PaleontologyDocument that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PaleontologyDocument")
     *      ),
     *      @SWG\Parameter(
     *          name="src_description",
     *          in="body",
     *          description="PaleontologyDocument that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PaleontologyDocument")
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
     *                  ref="#/definitions/ActionHubDocument"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateActionHubDocumentAPIRequest $request)
    {
        $input = $request->all();

        /** @var ActionHubDocument $actionHubDocument */
        $actionHubDocument = $this->actionHubDocumentRepository->find($id);

        if (empty($actionHubDocument)) {
            return $this->sendError('Action Hub Document not found');
        }

        $actionHubDocument = $this->actionHubDocumentRepository->update($input, $id);

        return $this->sendResponse($actionHubDocument->toArray(), 'ActionHubDocument updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/actionHubDocuments/{id}",
     *      summary="Remove the specified ActionHubDocument from storage",
     *      tags={"ActionHubDocument"},
     *      description="Delete ActionHubDocument",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ActionHubDocument",
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
     * @throws Exception
     */
    public function destroy($id)
    {
        /** @var ActionHubDocument $actionHubDocument */
        $actionHubDocument = $this->actionHubDocumentRepository->find($id);

        if (empty($actionHubDocument)) {
            return $this->sendError('Action Hub Document not found');
        }

        $actionHubDocument->delete();

        return $this->sendResponse($id, 'Action Hub Document deleted successfully');
    }
}
