<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateTransactionAPIRequest;
use App\Http\Requests\Api\UpdateTransactionAPIRequest;
use App\Models\Transaction;
use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class TransactionController
 * @package App\Http\Controllers\Api
 */
class TransactionAPIController extends AppBaseController
{
    /** @var  TransactionRepository */
    private $transactionRepository;

    public function __construct(TransactionRepository $transactionRepo)
    {
        $this->transactionRepository = $transactionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/transactions",
     *      summary="Get a listing of the Transactions.",
     *      tags={"Transaction"},
     *      description="Get all Transactions",
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
     *                  @SWG\Items(ref="#/definitions/Transaction")
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
        $transactions = $this->transactionRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($transactions->toArray(), 'Transactions retrieved successfully');
    }

    /**
     * @param CreateTransactionAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/transactions",
     *      summary="Store a newly created Transaction in storage",
     *      tags={"Transaction"},
     *      description="Store Transaction",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="member_name",
     *          in="body",
     *          description="Transaction that should be stored",
     *          required=true,
     *          type="integer",
     *          @SWG\Schema(ref="#/definitions/Transaction")
     *      ),
     *      @SWG\Parameter(
     *          name="member_address",
     *          in="body",
     *          description="Transaction that should be stored",
     *          required=true,
     *          type="integer",
     *          @SWG\Schema(ref="#/definitions/Transaction")
     *      ),
     *      @SWG\Parameter(
     *          name="member_phone",
     *          in="body",
     *          description="Transaction that should be stored",
     *          required=true,
     *          type="integer",
     *          @SWG\Schema(ref="#/definitions/Transaction")
     *      ),
     *      @SWG\Parameter(
     *          name="member_email",
     *          in="body",
     *          description="Transaction that should be stored",
     *          required=true,
     *          type="integer",
     *          @SWG\Schema(ref="#/definitions/Transaction")
     *      ),
     *      @SWG\Parameter(
     *          name="organization_id",
     *          in="body",
     *          description="Transaction that should be stored",
     *          required=true,
     *          type="integer",
     *          @SWG\Schema(ref="#/definitions/Transaction")
     *      ),
     *      @SWG\Parameter(
     *          name="type_id",
     *          in="body",
     *          description="1: visit, 2: borrow, 3: exchange, 4:gift, 5:fair 6:expense 7:correspondence",
     *          required=true,
     *          type="integer",
     *          @SWG\Schema(ref="#/definitions/Transaction")
     *      ),
     *      @SWG\Parameter(
     *          name="sample_impression_id",
     *          in="body",
     *          description="boolean",
     *          required=true,
     *          type="integer",
     *          @SWG\Schema(ref="#/definitions/Transaction")
     *      ),
     *      @SWG\Parameter(
     *          name="start_time",
     *          in="body",
     *          description="Transaction that should be stored",
     *          required=true,
     *          type="string",
     *          @SWG\Schema(ref="#/definitions/Transaction")
     *      ),
     *      @SWG\Parameter(
     *          name="end_time",
     *          in="body",
     *          description="Transaction that should be stored",
     *          required=false,
     *          type="string",
     *          @SWG\Schema(ref="#/definitions/Transaction")
     *      ),
     *      @SWG\Parameter(
     *          name="dead_line",
     *          in="body",
     *          description="Transaction that should be stored",
     *          required=false,
     *          type="string",
     *          @SWG\Schema(ref="#/definitions/Transaction")
     *      ),
     *      @SWG\Parameter(
     *          name="department_name",
     *          in="body",
     *          description="Transaction that should be stored",
     *          required=false,
     *          type="integer",
     *          @SWG\Schema(ref="#/definitions/Transaction")
     *      ),
     *      @SWG\Parameter(
     *          name="archive_no",
     *          in="body",
     *          description="Transaction that should be stored",
     *          required=false,
     *          type="string",
     *          @SWG\Schema(ref="#/definitions/Transaction")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="Transaction that should be stored",
     *          required=false,
     *          type="string",
     *          @SWG\Schema(ref="#/definitions/Transaction")
     *      ),
     *      @SWG\Parameter(
     *          name="purpose",
     *          in="body",
     *          description="Transaction that should be stored",
     *          required=false,
     *          type="string",
     *          @SWG\Schema(ref="#/definitions/Transaction")
     *      ),
     *      @SWG\Parameter(
     *          name="visit_id",
     *          in="body",
     *          description="1: Sample, 2: All/Museum",
     *          required=false,
     *          type="integer",
     *          @SWG\Schema(ref="#/definitions/Transaction")
     *      ),
     *      @SWG\Parameter(
     *          name="peoples_no",
     *          in="body",
     *          description="Transaction that should be stored",
     *          required=false,
     *          type="integer",
     *          @SWG\Schema(ref="#/definitions/Transaction")
     *      ),
     *      @SWG\Parameter(
     *          name="person_position",
     *          in="body",
     *          description="Transaction that should be stored",
     *          required=false,
     *          type="string",
     *          @SWG\Schema(ref="#/definitions/Transaction")
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
     *                  ref="#/definitions/Transaction"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTransactionAPIRequest $request)
    {
        $input = $request->all();

        $transaction = $this->transactionRepository->create($input);

        return $this->sendResponse($transaction->toArray(), 'Transaction saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/transactions/{id}",
     *      summary="Display the specified Transaction",
     *      tags={"Transaction"},
     *      description="Get Transaction",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Transaction",
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
     *                  ref="#/definitions/Transaction"
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
        /** @var Transaction $transaction */
        $transaction = $this->transactionRepository->find($id, request()->get('relations'));

        if (empty($transaction)) {
            return $this->sendError('Transaction not found');
        }

        return $this->sendResponse($transaction->toArray(), 'Transaction retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateTransactionAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/transactions/{id}",
     *      summary="Update the specified Transaction in storage",
     *      tags={"Transaction"},
     *      description="Update Transaction",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Transaction",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="member_name",
     *          in="body",
     *          description="Transaction that should be stored",
     *          required=true,
     *          type="integer",
     *          @SWG\Schema(ref="#/definitions/Transaction")
     *      ),
     *      @SWG\Parameter(
     *          name="member_address",
     *          in="body",
     *          description="Transaction that should be stored",
     *          required=true,
     *          type="integer",
     *          @SWG\Schema(ref="#/definitions/Transaction")
     *      ),
     *      @SWG\Parameter(
     *          name="member_phone",
     *          in="body",
     *          description="Transaction that should be stored",
     *          required=true,
     *          type="integer",
     *          @SWG\Schema(ref="#/definitions/Transaction")
     *      ),
     *      @SWG\Parameter(
     *          name="member_email",
     *          in="body",
     *          description="Transaction that should be stored",
     *          required=true,
     *          type="integer",
     *          @SWG\Schema(ref="#/definitions/Transaction")
     *      ),
     *      @SWG\Parameter(
     *          name="organization_id",
     *          in="body",
     *          description="Transaction that should be stored",
     *          required=true,
     *          type="integer",
     *          @SWG\Schema(ref="#/definitions/Transaction")
     *      ),
     *      @SWG\Parameter(
     *          name="type_id",
     *          in="body",
     *          description="1: visit, 2: borrow, 3: exchange, 4:gift, 5:fair 6:expense 7:correspondence",
     *          required=true,
     *          type="integer",
     *          @SWG\Schema(ref="#/definitions/Transaction")
     *      ),
     *      @SWG\Parameter(
     *          name="start_time",
     *          in="body",
     *          description="Transaction that should be stored",
     *          required=true,
     *          type="string",
     *          @SWG\Schema(ref="#/definitions/Transaction")
     *      ),
     *      @SWG\Parameter(
     *          name="end_time",
     *          in="body",
     *          description="Transaction that should be stored",
     *          required=false,
     *          type="string",
     *          @SWG\Schema(ref="#/definitions/Transaction")
     *      ),
     *      @SWG\Parameter(
     *          name="dead_line",
     *          in="body",
     *          description="Transaction that should be stored",
     *          required=false,
     *          type="string",
     *          @SWG\Schema(ref="#/definitions/Transaction")
     *      ),
     *      @SWG\Parameter(
     *          name="department_name",
     *          in="body",
     *          description="Transaction that should be stored",
     *          required=false,
     *          type="integer",
     *          @SWG\Schema(ref="#/definitions/Transaction")
     *      ),
     *      @SWG\Parameter(
     *          name="archive_no",
     *          in="body",
     *          description="Transaction that should be stored",
     *          required=false,
     *          type="string",
     *          @SWG\Schema(ref="#/definitions/Transaction")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="Transaction that should be stored",
     *          required=false,
     *          type="string",
     *          @SWG\Schema(ref="#/definitions/Transaction")
     *      ),
     *      @SWG\Parameter(
     *          name="purpose",
     *          in="body",
     *          description="Transaction that should be stored",
     *          required=false,
     *          type="string",
     *          @SWG\Schema(ref="#/definitions/Transaction")
     *      ),
     *      @SWG\Parameter(
     *          name="visit_id",
     *          in="body",
     *          description="1: Sample, 2: All/Museum",
     *          required=false,
     *          type="integer",
     *          @SWG\Schema(ref="#/definitions/Transaction")
     *      ),
     *      @SWG\Parameter(
     *          name="peoples_no",
     *          in="body",
     *          description="Transaction that should be stored",
     *          required=false,
     *          type="integer",
     *          @SWG\Schema(ref="#/definitions/Transaction")
     *      ),
     *      @SWG\Parameter(
     *          name="person_position",
     *          in="body",
     *          description="Transaction that should be stored",
     *          required=false,
     *          type="string",
     *          @SWG\Schema(ref="#/definitions/Transaction")
     *      ),
     *      @SWG\Parameter(
     *          name="sample_impression_id",
     *          in="body",
     *          description="boolean",
     *          required=true,
     *          type="integer",
     *          @SWG\Schema(ref="#/definitions/Transaction")
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
     *                  ref="#/definitions/Transaction"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTransactionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Transaction $transaction */
        $transaction = $this->transactionRepository->find($id,request()->get('relations'));

        if (empty($transaction)) {
            return $this->sendError('Transaction not found');
        }

        $transaction = $this->transactionRepository->update($input, $id);

        return $this->sendResponse($transaction->toArray(), 'Transaction updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/transactions/{id}",
     *      summary="Remove the specified Transaction from storage",
     *      tags={"Transaction"},
     *      description="Delete Transaction",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Transaction",
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
        /** @var Transaction $transaction */
        $transaction = $this->transactionRepository->find($id, request()->get('relations'));

        if (empty($transaction)) {
            return $this->sendError('Transaction not found');
        }

        $transaction->delete();

        return $this->sendResponse($id, 'Transaction deleted successfully');
    }
}
