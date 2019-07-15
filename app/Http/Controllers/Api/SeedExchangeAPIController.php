<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateSeedExchangeAPIRequest;
use App\Http\Requests\Api\UpdateSeedExchangeAPIRequest;
use App\Models\SeedExchange;
use App\Repositories\SeedExchangeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SeedExchangeController
 * @package App\Http\Controllers\Api
 */

class SeedExchangeAPIController extends AppBaseController
{
    /** @var  SeedExchangeRepository */
    private $seedExchangeRepository;

    public function __construct(SeedExchangeRepository $seedExchangeRepo)
    {
        $this->seedExchangeRepository = $seedExchangeRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/seedExchanges",
     *      summary="Get a listing of the SeedExchanges.",
     *      tags={"SeedExchange"},
     *      description="Get all SeedExchanges",
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
     *                  @SWG\Items(ref="#/definitions/SeedExchange")
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
        $seedExchanges = $this->seedExchangeRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($seedExchanges->toArray(), 'Seed Exchanges retrieved successfully');
    }

    /**
     * @param CreateSeedExchangeAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/seedExchanges",
     *      summary="Store a newly created SeedExchange in storage",
     *      tags={"SeedExchange"},
     *      description="Store SeedExchange",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="SeedExchange that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedExchange")
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
     *                  ref="#/definitions/SeedExchange"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSeedExchangeAPIRequest $request)
    {
        $input = $request->all();

        $seedExchange = $this->seedExchangeRepository->create($input);

        return $this->sendResponse($seedExchange->toArray(), 'Seed Exchange saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/seedExchanges/{id}",
     *      summary="Display the specified SeedExchange",
     *      tags={"SeedExchange"},
     *      description="Get SeedExchange",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedExchange",
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
     *                  ref="#/definitions/SeedExchange"
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
        /** @var SeedExchange $seedExchange */
        $seedExchange = $this->seedExchangeRepository->find($id);

        if (empty($seedExchange)) {
            return $this->sendError('Seed Exchange not found');
        }

        return $this->sendResponse($seedExchange->toArray(), 'Seed Exchange retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateSeedExchangeAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/seedExchanges/{id}",
     *      summary="Update the specified SeedExchange in storage",
     *      tags={"SeedExchange"},
     *      description="Update SeedExchange",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedExchange",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="SeedExchange that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedExchange")
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
     *                  ref="#/definitions/SeedExchange"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSeedExchangeAPIRequest $request)
    {
        $input = $request->all();

        /** @var SeedExchange $seedExchange */
        $seedExchange = $this->seedExchangeRepository->find($id);

        if (empty($seedExchange)) {
            return $this->sendError('Seed Exchange not found');
        }

        $seedExchange = $this->seedExchangeRepository->update($input, $id);

        return $this->sendResponse($seedExchange->toArray(), 'SeedExchange updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/seedExchanges/{id}",
     *      summary="Remove the specified SeedExchange from storage",
     *      tags={"SeedExchange"},
     *      description="Delete SeedExchange",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedExchange",
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
        /** @var SeedExchange $seedExchange */
        $seedExchange = $this->seedExchangeRepository->find($id);

        if (empty($seedExchange)) {
            return $this->sendError('Seed Exchange not found');
        }

        $seedExchange->delete();

        return $this->sendResponse($id, 'Seed Exchange deleted successfully');
    }
}
