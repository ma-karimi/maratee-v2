<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreatePaleontologyDocumentAPIRequest;
use App\Http\Requests\Api\UpdatePaleontologyDocumentAPIRequest;
use App\Models\PaleontologyDocument;
use App\Repositories\PaleontologyDocumentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PaleontologyDocumentController
 * @package App\Http\Controllers\Api
 */

class PaleontologyDocumentAPIController extends AppBaseController
{
    /** @var  PaleontologyDocumentRepository */
    private $paleontologyDocumentRepository;

    public function __construct(PaleontologyDocumentRepository $paleontologyDocumentRepo)
    {
        $this->paleontologyDocumentRepository = $paleontologyDocumentRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/paleontologyDocuments",
     *      summary="Get a listing of the PaleontologyDocuments.",
     *      tags={"PaleontologyDocument"},
     *      description="Get all PaleontologyDocuments",
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
     *                  @SWG\Items(ref="#/definitions/PaleontologyDocument")
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
        $paleontologyDocuments = $this->paleontologyDocumentRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($paleontologyDocuments->toArray(), 'Paleontology Documents retrieved successfully');
    }

    /**
     * @param CreatePaleontologyDocumentAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/paleontologyDocuments",
     *      summary="Store a newly created PaleontologyDocument in storage",
     *      tags={"PaleontologyDocument"},
     *      description="Store PaleontologyDocument",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="paleontology_id",
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
     *                  ref="#/definitions/PaleontologyDocument"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePaleontologyDocumentAPIRequest $request)
    {
        $input = $request->all();

        $paleontologyDocument = $this->paleontologyDocumentRepository->create($input);

        return $this->sendResponse($paleontologyDocument->toArray(), 'Paleontology Document saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/paleontologyDocuments/{id}",
     *      summary="Display the specified PaleontologyDocument",
     *      tags={"PaleontologyDocument"},
     *      description="Get PaleontologyDocument",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of PaleontologyDocument",
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
     *                  ref="#/definitions/PaleontologyDocument"
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
        /** @var PaleontologyDocument $paleontologyDocument */
        $paleontologyDocument = $this->paleontologyDocumentRepository->find($id);

        if (empty($paleontologyDocument)) {
            return $this->sendError('Paleontology Document not found');
        }

        return $this->sendResponse($paleontologyDocument->toArray(), 'Paleontology Document retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePaleontologyDocumentAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/paleontologyDocuments/{id}",
     *      summary="Update the specified PaleontologyDocument in storage",
     *      tags={"PaleontologyDocument"},
     *      description="Update PaleontologyDocument",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of PaleontologyDocument",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="paleontology_id",
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
     *                  ref="#/definitions/PaleontologyDocument"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePaleontologyDocumentAPIRequest $request)
    {
        $input = $request->all();

        /** @var PaleontologyDocument $paleontologyDocument */
        $paleontologyDocument = $this->paleontologyDocumentRepository->find($id);

        if (empty($paleontologyDocument)) {
            return $this->sendError('Paleontology Document not found');
        }

        $paleontologyDocument = $this->paleontologyDocumentRepository->update($input, $id);

        return $this->sendResponse($paleontologyDocument->toArray(), 'PaleontologyDocument updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/paleontologyDocuments/{id}",
     *      summary="Remove the specified PaleontologyDocument from storage",
     *      tags={"PaleontologyDocument"},
     *      description="Delete PaleontologyDocument",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of PaleontologyDocument",
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
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var PaleontologyDocument $paleontologyDocument */
        $paleontologyDocument = $this->paleontologyDocumentRepository->find($id);

        if (empty($paleontologyDocument)) {
            return $this->sendError('Paleontology Document not found');
        }

        $paleontologyDocument->delete();

        return $this->sendResponse($id, 'Paleontology Document deleted successfully');
    }
}
