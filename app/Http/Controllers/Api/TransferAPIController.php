<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateTransferAPIRequest;
use App\Http\Requests\Api\UpdateTransferAPIRequest;
use App\Models\Transfer;
use App\Repositories\TransferRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class TransferAPIController
 * @package App\Http\Controllers\Api
 */

class TransferAPIController extends AppBaseController
{
    /** @var  TransferRepository */
    private $transferRepository;

    public function __construct(TransferRepository $transferRepo)
    {
        $this->transferRepository = $transferRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/transfers",
     *      summary="Get a listing of the Transfers.",
     *      tags={"Transfer"},
     *      description="Get all Transfers",
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
     *                  @SWG\Items(ref="#/definitions/Transfer")
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
        $transfers = $this->transferRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($transfers->toArray(), 'Transfers retrieved successfully');
    }

    /**
     * @param CreateTransferAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/transfers",
     *      summary="Store a newly created Transfer in storage",
     *      tags={"Transfer"},
     *      description="Store Transfer",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="entitiable_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Transfer")
     *      ),
     *      @SWG\Parameter(
     *          name="entitiable_type",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Transfer")
     *      ),
     *      @SWG\Parameter(
     *          name="transferable_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Transfer")
     *      ),
     *      @SWG\Parameter(
     *          name="transferable_type",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Transfer")
     *      ),
     *      @SWG\Parameter(
     *          name="media_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Transfer")
     *      ),
     *      @SWG\Parameter(
     *          name="credential_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Transfer")
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
     *                  ref="#/definitions/Transfer"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTransferAPIRequest $request)
    {
        $input = $request->all();

        $transfer = $this->transferRepository->create($input);

        return $this->sendResponse($transfer->toArray(), 'Transfer saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/transfers/{id}",
     *      summary="Display the specified Transfer",
     *      tags={"Transfer"},
     *      description="Get Transfer",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Transfer",
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
     *                  ref="#/definitions/Transfer"
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
        /** @var Transfer $transfer */
        $transfer = $this->transferRepository->find($id, \request()->get('relations'));

        if ($transfer === null) {
            return $this->sendError('Transfer not found');
        }

        return $this->sendResponse($transfer->toArray(), 'Transfer retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateTransferAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/transfers/{id}",
     *      summary="Update the specified Transfer in storage",
     *      tags={"Transfer"},
     *      description="Update Transfer",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Transfer",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="entitiable_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Transfer")
     *      ),
     *      @SWG\Parameter(
     *          name="entitiable_type",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Transfer")
     *      ),
     *      @SWG\Parameter(
     *          name="transferable_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Transfer")
     *      ),
     *      @SWG\Parameter(
     *          name="transferable_type",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Transfer")
     *      ),
     *      @SWG\Parameter(
     *          name="media_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Transfer")
     *      ),
     *      @SWG\Parameter(
     *          name="credential_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Transfer")
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
     *                  ref="#/definitions/Transfer"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTransferAPIRequest $request)
    {
        $input = $request->all();

        /** @var Transfer $transfer */
        $transfer = $this->transferRepository->find($id, \request()->get('relations'));

        if ($transfer === null) {
            return $this->sendError('Transfer not found');
        }

        $transfer = $this->transferRepository->update($input, $id);

        return $this->sendResponse($transfer->toArray(), 'Transfer updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/transfers/{id}",
     *      summary="Remove the specified Transfer from storage",
     *      tags={"Transfer"},
     *      description="Delete Transfer",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Transfer",
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
        /** @var Transfer $transfer */
        $transfer = $this->transferRepository->find($id, \request()->get('relations'));

        if ($transfer === null) {
            return $this->sendError('Transfer not found');
        }

        $transfer->delete();

        return $this->sendResponse($id, 'Transfer deleted successfully');
    }
}
