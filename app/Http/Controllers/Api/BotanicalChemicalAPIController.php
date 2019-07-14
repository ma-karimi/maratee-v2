<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateBotanicalChemicalAPIRequest;
use App\Http\Requests\Api\UpdateBotanicalChemicalAPIRequest;
use App\Models\BotanicalChemical;
use App\Repositories\BotanicalChemicalRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class BotanicalChemicalController
 * @package App\Http\Controllers\Api
 */

class BotanicalChemicalAPIController extends AppBaseController
{
    /** @var  BotanicalChemicalRepository */
    private $botanicalChemicalRepository;

    public function __construct(BotanicalChemicalRepository $botanicalChemicalRepo)
    {
        $this->botanicalChemicalRepository = $botanicalChemicalRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/botanicalChemicals",
     *      summary="Get a listing of the BotanicalChemicals.",
     *      tags={"BotanicalChemical"},
     *      description="Get all BotanicalChemicals",
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
     *                  @SWG\Items(ref="#/definitions/BotanicalChemical")
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
        $botanicalChemicals = $this->botanicalChemicalRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($botanicalChemicals->toArray(), 'Botanical Chemicals retrieved successfully');
    }

    /**
     * @param CreateBotanicalChemicalAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/botanicalChemicals",
     *      summary="Store a newly created BotanicalChemical in storage",
     *      tags={"BotanicalChemical"},
     *      description="Store BotanicalChemical",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="BotanicalChemical that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BotanicalChemical")
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
     *                  ref="#/definitions/BotanicalChemical"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateBotanicalChemicalAPIRequest $request)
    {
        $input = $request->all();

        $botanicalChemical = $this->botanicalChemicalRepository->create($input);

        return $this->sendResponse($botanicalChemical->toArray(), 'Botanical Chemical saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/botanicalChemicals/{id}",
     *      summary="Display the specified BotanicalChemical",
     *      tags={"BotanicalChemical"},
     *      description="Get BotanicalChemical",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BotanicalChemical",
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
     *                  ref="#/definitions/BotanicalChemical"
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
        /** @var BotanicalChemical $botanicalChemical */
        $botanicalChemical = $this->botanicalChemicalRepository->find($id);

        if (empty($botanicalChemical)) {
            return $this->sendError('Botanical Chemical not found');
        }

        return $this->sendResponse($botanicalChemical->toArray(), 'Botanical Chemical retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateBotanicalChemicalAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/botanicalChemicals/{id}",
     *      summary="Update the specified BotanicalChemical in storage",
     *      tags={"BotanicalChemical"},
     *      description="Update BotanicalChemical",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BotanicalChemical",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="BotanicalChemical that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BotanicalChemical")
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
     *                  ref="#/definitions/BotanicalChemical"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateBotanicalChemicalAPIRequest $request)
    {
        $input = $request->all();

        /** @var BotanicalChemical $botanicalChemical */
        $botanicalChemical = $this->botanicalChemicalRepository->find($id);

        if (empty($botanicalChemical)) {
            return $this->sendError('Botanical Chemical not found');
        }

        $botanicalChemical = $this->botanicalChemicalRepository->update($input, $id);

        return $this->sendResponse($botanicalChemical->toArray(), 'BotanicalChemical updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/botanicalChemicals/{id}",
     *      summary="Remove the specified BotanicalChemical from storage",
     *      tags={"BotanicalChemical"},
     *      description="Delete BotanicalChemical",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BotanicalChemical",
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
        /** @var BotanicalChemical $botanicalChemical */
        $botanicalChemical = $this->botanicalChemicalRepository->find($id);

        if (empty($botanicalChemical)) {
            return $this->sendError('Botanical Chemical not found');
        }

        $botanicalChemical->delete();

        return $this->sendResponse($id, 'Botanical Chemical deleted successfully');
    }
}
