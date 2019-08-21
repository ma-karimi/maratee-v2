<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateTransferMediaAPIRequest;
use App\Http\Requests\Api\UpdateTransferMediaAPIRequest;
use App\Models\Transfer;
use App\Repositories\TransferMediaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class TransferMediaAPIController
 * @package App\Http\Controllers\Api
 */

class TransferMediaAPIController extends AppBaseController
{
    /** @var  TransferMediaRepository */
    private $transferMediaRepository;

    public function __construct(TransferMediaRepository $transferMediaRepo)
    {
        $this->transferMediaRepository = $transferMediaRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/transfer_medias",
     *      summary="Get a listing of the TransferMedias.",
     *      tags={"TransferMedia"},
     *      description="Get all TransferMedias",
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
     *                  @SWG\Items(ref="#/definitions/TransferMedia")
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
        $transferMedias = $this->transferMediaRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($transferMedias->toArray(), 'TransferMedias retrieved successfully');
    }

    /**
     * @param CreateTransferMediaAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/transfer_medias",
     *      summary="Store a newly created TransferMedia in storage",
     *      tags={"TransferMedia"},
     *      description="Store TransferMedia",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="entitiable_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/TransferMedia")
     *      ),
     *      @SWG\Parameter(
     *          name="entitiable_type",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/TransferMedia")
     *      ),
     *      @SWG\Parameter(
     *          name="transferable_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/TransferMedia")
     *      ),
     *      @SWG\Parameter(
     *          name="transferable_type",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/TransferMedia")
     *      ),
     *      @SWG\Parameter(
     *          name="media_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/TransferMedia")
     *      ),
     *      @SWG\Parameter(
     *          name="credential_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/TransferMedia")
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
     *                  ref="#/definitions/TransferMedia"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTransferMediaAPIRequest $request)
    {
        $input = $request->all();

        $transferMedia = $this->transferMediaRepository->create($input);

        return $this->sendResponse($transferMedia->toArray(), 'TransferMedia saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/transfer_medias/{id}",
     *      summary="Display the specified TransferMedia",
     *      tags={"TransferMedia"},
     *      description="Get TransferMedia",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of TransferMedia",
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
     *                  ref="#/definitions/TransferMedia"
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
        /** @var Transfer $transferMedia */
        $transferMedia = $this->transferMediaRepository->find($id, \request()->get('relations'));

        if ($transferMedia === null) {
            return $this->sendError('TransferMedia not found');
        }

        return $this->sendResponse($transferMedia->toArray(), 'TransferMedia retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateTransferMediaAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/transfer_medias/{id}",
     *      summary="Update the specified TransferMedia in storage",
     *      tags={"TransferMedia"},
     *      description="Update TransferMedia",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of TransferMedia",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="entitiable_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/TransferMedia")
     *      ),
     *      @SWG\Parameter(
     *          name="entitiable_type",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/TransferMedia")
     *      ),
     *      @SWG\Parameter(
     *          name="transferable_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/TransferMedia")
     *      ),
     *      @SWG\Parameter(
     *          name="transferable_type",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/TransferMedia")
     *      ),
     *      @SWG\Parameter(
     *          name="media_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/TransferMedia")
     *      ),
     *      @SWG\Parameter(
     *          name="credential_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/TransferMedia")
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
     *                  ref="#/definitions/TransferMedia"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTransferMediaAPIRequest $request)
    {
        $input = $request->all();

        /** @var Transfer $transferMedia */
        $transferMedia = $this->transferMediaRepository->find($id, \request()->get('relations'));

        if ($transferMedia === null) {
            return $this->sendError('TransferMedia not found');
        }

        $transferMedia = $this->transferMediaRepository->update($input, $id);

        return $this->sendResponse($transferMedia->toArray(), 'TransferMedia updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/transfer_medias/{id}",
     *      summary="Remove the specified TransferMedia from storage",
     *      tags={"TransferMedia"},
     *      description="Delete TransferMedia",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of TransferMedia",
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
        /** @var Transfer $transferMedia */
        $transferMedia = $this->transferMediaRepository->find($id, \request()->get('relations'));

        if ($transferMedia === null) {
            return $this->sendError('TransferMedia not found');
        }

        $transferMedia->delete();

        return $this->sendResponse($id, 'TransferMedia deleted successfully');
    }
}
