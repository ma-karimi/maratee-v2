<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateTransferCredentialAPIRequest;
use App\Http\Requests\Api\UpdateTransferCredentialAPIRequest;
use App\Models\TransferCredential;
use App\Repositories\TransferCredentialRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class TransferCredentialAPIController
 * @package App\Http\Controllers\Api
 */

class TransferCredentialAPIController extends AppBaseController
{
    /** @var  TransferCredentialRepository */
    private $transferCredentialRepository;

    public function __construct(TransferCredentialRepository $transferCredentialRepo)
    {
        $this->transferCredentialRepository = $transferCredentialRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/transfer_credentials",
     *      summary="Get a listing of the TransferCredentials.",
     *      tags={"TransferCredential"},
     *      description="Get all TransferCredentials",
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
     *                  @SWG\Items(ref="#/definitions/TransferCredential")
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
        $transferCredentials = $this->transferCredentialRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($transferCredentials->toArray(), 'TransferCredentials retrieved successfully');
    }

    /**
     * @param CreateTransferCredentialAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/transfer_credentials",
     *      summary="Store a newly created TransferCredential in storage",
     *      tags={"TransferCredential"},
     *      description="Store TransferCredential",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="entitiable_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/TransferCredential")
     *      ),
     *      @SWG\Parameter(
     *          name="entitiable_type",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/TransferCredential")
     *      ),
     *      @SWG\Parameter(
     *          name="transferable_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/TransferCredential")
     *      ),
     *      @SWG\Parameter(
     *          name="transferable_type",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/TransferCredential")
     *      ),
     *      @SWG\Parameter(
     *          name="media_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/TransferCredential")
     *      ),
     *      @SWG\Parameter(
     *          name="credential_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/TransferCredential")
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
     *                  ref="#/definitions/TransferCredential"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTransferCredentialAPIRequest $request)
    {
        $input = $request->all();

        $transferCredential = $this->transferCredentialRepository->create($input);

        return $this->sendResponse($transferCredential->toArray(), 'TransferCredential saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/transfer_credentials/{id}",
     *      summary="Display the specified TransferCredential",
     *      tags={"TransferCredential"},
     *      description="Get TransferCredential",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of TransferCredential",
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
     *                  ref="#/definitions/TransferCredential"
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
        /** @var TransferCredential $transferCredential */
        $transferCredential = $this->transferCredentialRepository->find($id, \request()->get('relations'));

        if ($transferCredential === null) {
            return $this->sendError('TransferCredential not found');
        }

        return $this->sendResponse($transferCredential->toArray(), 'TransferCredential retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateTransferCredentialAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/transfer_credentials/{id}",
     *      summary="Update the specified TransferCredential in storage",
     *      tags={"TransferCredential"},
     *      description="Update TransferCredential",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of TransferCredential",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="entitiable_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/TransferCredential")
     *      ),
     *      @SWG\Parameter(
     *          name="entitiable_type",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/TransferCredential")
     *      ),
     *      @SWG\Parameter(
     *          name="transferable_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/TransferCredential")
     *      ),
     *      @SWG\Parameter(
     *          name="transferable_type",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/TransferCredential")
     *      ),
     *      @SWG\Parameter(
     *          name="media_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/TransferCredential")
     *      ),
     *      @SWG\Parameter(
     *          name="credential_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/TransferCredential")
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
     *                  ref="#/definitions/TransferCredential"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTransferCredentialAPIRequest $request)
    {
        $input = $request->all();

        /** @var TransferCredential $transferCredential */
        $transferCredential = $this->transferCredentialRepository->find($id, \request()->get('relations'));

        if ($transferCredential === null) {
            return $this->sendError('TransferCredential not found');
        }

        $transferCredential = $this->transferCredentialRepository->update($input, $id);

        return $this->sendResponse($transferCredential->toArray(), 'TransferCredential updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/transfer_credentials/{id}",
     *      summary="Remove the specified TransferCredential from storage",
     *      tags={"TransferCredential"},
     *      description="Delete TransferCredential",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of TransferCredential",
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
        /** @var TransferCredential $transferCredential */
        $transferCredential = $this->transferCredentialRepository->find($id, \request()->get('relations'));

        if ($transferCredential === null) {
            return $this->sendError('TransferCredential not found');
        }

        $transferCredential->delete();

        return $this->sendResponse($id, 'TransferCredential deleted successfully');
    }
}
