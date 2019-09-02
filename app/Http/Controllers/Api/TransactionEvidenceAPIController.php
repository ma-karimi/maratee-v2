<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateTransactionEvidenceAPIRequest;
use App\Http\Requests\Api\UpdateTransactionEvidenceAPIRequest;
use App\Models\TransactionEvidence;
use App\Repositories\TransactionEvidenceRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class TransactionEvidenceController
 * @package App\Http\Controllers\Api
 */

class TransactionEvidenceAPIController extends AppBaseController
{
    /** @var  TransactionEvidenceRepository */
    private $transactionEvidenceRepository;

    public function __construct(TransactionEvidenceRepository $transactionEvidenceRepo)
    {
        $this->transactionEvidenceRepository = $transactionEvidenceRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/transaction_evidences",
     *      summary="Get a listing of the TransactionEvidences.",
     *      tags={"TransactionEvidence"},
     *      description="Get all TransactionEvidences",
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
     *                  @SWG\Items(ref="#/definitions/TransactionEvidence")
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
        $transactionEvidences = $this->transactionEvidenceRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($transactionEvidences->toArray(), 'Transaction Evidences retrieved successfully');
    }

    /**
     * @param CreateTransactionEvidenceAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/transaction_evidences",
     *      summary="Store a newly created TransactionEvidence in storage",
     *      tags={"TransactionEvidence"},
     *      description="Store TransactionEvidence",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="transaction_id",
     *          in="body",
     *          description="TransactionEvidence that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/TransactionEvidence")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="TransactionEvidence that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/TransactionEvidence")
     *      ),
     *      @SWG\Parameter(
     *          name="src",
     *          in="body",
     *          description="TransactionEvidence that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/TransactionEvidence")
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
     *                  ref="#/definitions/TransactionEvidence"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTransactionEvidenceAPIRequest $request)
    {
        $input = $request->all();

        $transactionEvidence = $this->transactionEvidenceRepository->create($input);

        return $this->sendResponse($transactionEvidence->toArray(), 'Transaction Evidence saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/transaction_evidences/{id}",
     *      summary="Display the specified TransactionEvidence",
     *      tags={"TransactionEvidence"},
     *      description="Get TransactionEvidence",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of TransactionEvidence",
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
     *                  ref="#/definitions/TransactionEvidence"
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
        /** @var TransactionEvidence $transactionEvidence */
        $transactionEvidence = $this->transactionEvidenceRepository->find($id);

        if (empty($transactionEvidence)) {
            return $this->sendError('Transaction Evidence not found');
        }

        return $this->sendResponse($transactionEvidence->toArray(), 'Transaction Evidence retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateTransactionEvidenceAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/transaction_evidences/{id}",
     *      summary="Update the specified TransactionEvidence in storage",
     *      tags={"TransactionEvidence"},
     *      description="Update TransactionEvidence",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of TransactionEvidence",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="transaction_id",
     *          in="body",
     *          description="TransactionEvidence that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/TransactionEvidence")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="TransactionEvidence that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/TransactionEvidence")
     *      ),
     *      @SWG\Parameter(
     *          name="src",
     *          in="body",
     *          description="TransactionEvidence that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/TransactionEvidence")
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
     *                  ref="#/definitions/TransactionEvidence"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTransactionEvidenceAPIRequest $request)
    {
        $input = $request->all();

        /** @var TransactionEvidence $transactionEvidence */
        $transactionEvidence = $this->transactionEvidenceRepository->find($id);

        if (empty($transactionEvidence)) {
            return $this->sendError('Transaction Evidence not found');
        }

        $transactionEvidence = $this->transactionEvidenceRepository->update($input, $id);

        return $this->sendResponse($transactionEvidence->toArray(), 'TransactionEvidence updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/transaction_evidences/{id}",
     *      summary="Remove the specified TransactionEvidence from storage",
     *      tags={"TransactionEvidence"},
     *      description="Delete TransactionEvidence",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of TransactionEvidence",
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
        /** @var TransactionEvidence $transactionEvidence */
        $transactionEvidence = $this->transactionEvidenceRepository->find($id);

        if (empty($transactionEvidence)) {
            return $this->sendError('Transaction Evidence not found');
        }

        $transactionEvidence->delete();

        return $this->sendResponse($id, 'Transaction Evidence deleted successfully');
    }
}
