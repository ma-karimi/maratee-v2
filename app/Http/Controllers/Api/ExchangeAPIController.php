<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateExchangeAPIRequest;
use App\Http\Requests\Api\UpdateExchangeAPIRequest;
use App\Models\Exchange;
use App\Repositories\ExchangeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ExchangeController
 * @package App\Http\Controllers\Api
 */

class ExchangeAPIController extends AppBaseController
{
    /** @var  ExchangeRepository */
    private $exchangeRepository;

    public function __construct(ExchangeRepository $exchangeRepo)
    {
        $this->exchangeRepository = $exchangeRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/exchanges",
     *      summary="Get a listing of the Exchanges.",
     *      tags={"Exchange"},
     *      description="Get all Exchanges",
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
     *                  @SWG\Items(ref="#/definitions/Exchange")
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
        $exchanges = $this->exchangeRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($exchanges->toArray(), 'Exchanges retrieved successfully');
    }

    /**
     * @param CreateExchangeAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/exchanges",
     *      summary="Store a newly created Exchange in storage",
     *      tags={"Exchange"},
     *      description="Store Exchange",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="send_herbarium_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Exchange")
     *      ),
     *      @SWG\Parameter(
     *          name="send_date",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Exchange")
     *      ),
     *      @SWG\Parameter(
     *          name="receive_date",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Exchange")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Exchange")
     *      ),
     *      @SWG\Parameter(
     *          name="receive_herbarium_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Exchange")
     *      ),
     *      @SWG\Parameter(
     *          name="send_sheet_no",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Exchange")
     *      ),
     *      @SWG\Parameter(
     *          name="send_sample_no",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Exchange")
     *      ),
     *      @SWG\Parameter(
     *          name="receive_sheet_no",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Exchange")
     *      ),
     *      @SWG\Parameter(
     *          name="receive_sample_no",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Exchange")
     *      ),
     *      @SWG\Parameter(
     *          name="send_type",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Exchange")
     *      ),
     *      @SWG\Parameter(
     *          name="receive_type",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Exchange")
     *      ),
     *      @SWG\Parameter(
     *          name="send_paleontology_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Exchange")
     *      ),
     *      @SWG\Parameter(
     *          name="receive_paleontology_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Exchange")
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
     *                  ref="#/definitions/Exchange"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateExchangeAPIRequest $request)
    {
        $input = $request->all();

        $exchange = $this->exchangeRepository->create($input);

        return $this->sendResponse($exchange->toArray(), 'Exchange saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/exchanges/{id}",
     *      summary="Display the specified Exchange",
     *      tags={"Exchange"},
     *      description="Get Exchange",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Exchange",
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
     *                  ref="#/definitions/Exchange"
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
        /** @var Exchange $exchange */
        $exchange = $this->exchangeRepository->find($id, \request()->get('relations'));

        if ($exchange === null) {
            return $this->sendError('Exchange not found');
        }

        return $this->sendResponse($exchange->toArray(), 'Exchange retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateExchangeAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/exchanges/{id}",
     *      summary="Update the specified Exchange in storage",
     *      tags={"Exchange"},
     *      description="Update Exchange",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Exchange",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="send_herbarium_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Exchange")
     *      ),
     *      @SWG\Parameter(
     *          name="send_date",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Exchange")
     *      ),
     *      @SWG\Parameter(
     *          name="receive_date",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Exchange")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Exchange")
     *      ),
     *      @SWG\Parameter(
     *          name="receive_herbarium_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Exchange")
     *      ),
     *      @SWG\Parameter(
     *          name="send_sheet_no",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Exchange")
     *      ),
     *      @SWG\Parameter(
     *          name="send_sample_no",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Exchange")
     *      ),
     *      @SWG\Parameter(
     *          name="receive_sheet_no",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Exchange")
     *      ),
     *      @SWG\Parameter(
     *          name="receive_sample_no",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Exchange")
     *      ),
     *      @SWG\Parameter(
     *          name="send_type",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Exchange")
     *      ),
     *      @SWG\Parameter(
     *          name="receive_type",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Exchange")
     *      ),
     *      @SWG\Parameter(
     *          name="send_paleontology_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Exchange")
     *      ),
     *      @SWG\Parameter(
     *          name="receive_paleontology_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Exchange")
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
     *                  ref="#/definitions/Exchange"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateExchangeAPIRequest $request)
    {
        $input = $request->all();

        /** @var Exchange $exchange */
        $exchange = $this->exchangeRepository->find($id, \request()->get('relations'));

        if ($exchange === null) {
            return $this->sendError('Exchange not found');
        }

        $exchange = $this->exchangeRepository->update($input, $id);

        return $this->sendResponse($exchange->toArray(), 'Exchange updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/exchanges/{id}",
     *      summary="Remove the specified Exchange from storage",
     *      tags={"Exchange"},
     *      description="Delete Exchange",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Exchange",
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
        /** @var Exchange $exchange */
        $exchange = $this->exchangeRepository->find($id, \request()->get('relations'));

        if ($exchange === null) {
            return $this->sendError('Exchange not found');
        }

        $exchange->delete();

        return $this->sendResponse($id, 'Exchange deleted successfully');
    }
}
