<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateReproductionAPIRequest;
use App\Http\Requests\Api\UpdateReproductionAPIRequest;
use App\Models\Reproduction;
use App\Repositories\ReproductionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ReproductionController
 * @package App\Http\Controllers\Api
 */

class ReproductionAPIController extends AppBaseController
{
    /** @var  ReproductionRepository */
    private $reproductionRepository;

    public function __construct(ReproductionRepository $reproductionRepo)
    {
        $this->reproductionRepository = $reproductionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/reproductions",
     *      summary="Get a listing of the Reproductions.",
     *      tags={"Reproduction"},
     *      description="Get all Reproductions",
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
     *                  @SWG\Items(ref="#/definitions/Reproduction")
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
        $reproductions = $this->reproductionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($reproductions->toArray(), 'Reproductions retrieved successfully');
    }

    /**
     * @param CreateReproductionAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/reproductions",
     *      summary="Store a newly created Reproduction in storage",
     *      tags={"Reproduction"},
     *      description="Store Reproduction",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="Reproduction that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Reproduction")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="Reproduction that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Reproduction")
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
     *                  ref="#/definitions/Reproduction"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateReproductionAPIRequest $request)
    {
        $input = $request->all();

        $reproduction = $this->reproductionRepository->create($input);

        return $this->sendResponse($reproduction->toArray(), 'Reproduction saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/reproductions/{id}",
     *      summary="Display the specified Reproduction",
     *      tags={"Reproduction"},
     *      description="Get Reproduction",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Reproduction",
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
     *                  ref="#/definitions/Reproduction"
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
        /** @var Reproduction $reproduction */
        $reproduction = $this->reproductionRepository->find($id);

        if (empty($reproduction)) {
            return $this->sendError('Reproduction not found');
        }

        return $this->sendResponse($reproduction->toArray(), 'Reproduction retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateReproductionAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/reproductions/{id}",
     *      summary="Update the specified Reproduction in storage",
     *      tags={"Reproduction"},
     *      description="Update Reproduction",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Reproduction",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="Reproduction that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Reproduction")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="Reproduction that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Reproduction")
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
     *                  ref="#/definitions/Reproduction"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateReproductionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Reproduction $reproduction */
        $reproduction = $this->reproductionRepository->find($id);

        if (empty($reproduction)) {
            return $this->sendError('Reproduction not found');
        }

        $reproduction = $this->reproductionRepository->update($input, $id);

        return $this->sendResponse($reproduction->toArray(), 'Reproduction updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/reproductions/{id}",
     *      summary="Remove the specified Reproduction from storage",
     *      tags={"Reproduction"},
     *      description="Delete Reproduction",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Reproduction",
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
        /** @var Reproduction $reproduction */
        $reproduction = $this->reproductionRepository->find($id);

        if (empty($reproduction)) {
            return $this->sendError('Reproduction not found');
        }

        $reproduction->delete();

        return $this->sendResponse($id, 'Reproduction deleted successfully');
    }
}
