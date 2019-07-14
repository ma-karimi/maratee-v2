<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateBotanicalReproductionAPIRequest;
use App\Http\Requests\Api\UpdateBotanicalReproductionAPIRequest;
use App\Models\BotanicalReproduction;
use App\Repositories\BotanicalReproductionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class BotanicalReproductionController
 * @package App\Http\Controllers\Api
 */

class BotanicalReproductionAPIController extends AppBaseController
{
    /** @var  BotanicalReproductionRepository */
    private $botanicalReproductionRepository;

    public function __construct(BotanicalReproductionRepository $botanicalReproductionRepo)
    {
        $this->botanicalReproductionRepository = $botanicalReproductionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/botanicalReproductions",
     *      summary="Get a listing of the BotanicalReproductions.",
     *      tags={"BotanicalReproduction"},
     *      description="Get all BotanicalReproductions",
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
     *                  @SWG\Items(ref="#/definitions/BotanicalReproduction")
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
        $botanicalReproductions = $this->botanicalReproductionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($botanicalReproductions->toArray(), 'Botanical Reproductions retrieved successfully');
    }

    /**
     * @param CreateBotanicalReproductionAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/botanicalReproductions",
     *      summary="Store a newly created BotanicalReproduction in storage",
     *      tags={"BotanicalReproduction"},
     *      description="Store BotanicalReproduction",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="BotanicalReproduction that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BotanicalReproduction")
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
     *                  ref="#/definitions/BotanicalReproduction"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateBotanicalReproductionAPIRequest $request)
    {
        $input = $request->all();

        $botanicalReproduction = $this->botanicalReproductionRepository->create($input);

        return $this->sendResponse($botanicalReproduction->toArray(), 'Botanical Reproduction saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/botanicalReproductions/{id}",
     *      summary="Display the specified BotanicalReproduction",
     *      tags={"BotanicalReproduction"},
     *      description="Get BotanicalReproduction",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BotanicalReproduction",
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
     *                  ref="#/definitions/BotanicalReproduction"
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
        /** @var BotanicalReproduction $botanicalReproduction */
        $botanicalReproduction = $this->botanicalReproductionRepository->find($id);

        if (empty($botanicalReproduction)) {
            return $this->sendError('Botanical Reproduction not found');
        }

        return $this->sendResponse($botanicalReproduction->toArray(), 'Botanical Reproduction retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateBotanicalReproductionAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/botanicalReproductions/{id}",
     *      summary="Update the specified BotanicalReproduction in storage",
     *      tags={"BotanicalReproduction"},
     *      description="Update BotanicalReproduction",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BotanicalReproduction",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="BotanicalReproduction that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BotanicalReproduction")
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
     *                  ref="#/definitions/BotanicalReproduction"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateBotanicalReproductionAPIRequest $request)
    {
        $input = $request->all();

        /** @var BotanicalReproduction $botanicalReproduction */
        $botanicalReproduction = $this->botanicalReproductionRepository->find($id);

        if (empty($botanicalReproduction)) {
            return $this->sendError('Botanical Reproduction not found');
        }

        $botanicalReproduction = $this->botanicalReproductionRepository->update($input, $id);

        return $this->sendResponse($botanicalReproduction->toArray(), 'BotanicalReproduction updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/botanicalReproductions/{id}",
     *      summary="Remove the specified BotanicalReproduction from storage",
     *      tags={"BotanicalReproduction"},
     *      description="Delete BotanicalReproduction",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BotanicalReproduction",
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
        /** @var BotanicalReproduction $botanicalReproduction */
        $botanicalReproduction = $this->botanicalReproductionRepository->find($id);

        if (empty($botanicalReproduction)) {
            return $this->sendError('Botanical Reproduction not found');
        }

        $botanicalReproduction->delete();

        return $this->sendResponse($id, 'Botanical Reproduction deleted successfully');
    }
}
