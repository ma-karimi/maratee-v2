<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateChemicalAPIRequest;
use App\Http\Requests\Api\UpdateChemicalAPIRequest;
use App\Models\Chemical;
use App\Repositories\ChemicalRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ChemicalController
 * @package App\Http\Controllers\Api
 */

class ChemicalAPIController extends AppBaseController
{
    /** @var  ChemicalRepository */
    private $chemicalRepository;

    public function __construct(ChemicalRepository $chemicalRepo)
    {
        $this->chemicalRepository = $chemicalRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/chemicals",
     *      summary="Get a listing of the Chemicals.",
     *      tags={"Chemical"},
     *      description="Get all Chemicals",
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
     *                  @SWG\Items(ref="#/definitions/Chemical")
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
        $chemicals = $this->chemicalRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($chemicals->toArray(), 'Chemicals retrieved successfully');
    }

    /**
     * @param CreateChemicalAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/chemicals",
     *      summary="Store a newly created Chemical in storage",
     *      tags={"Chemical"},
     *      description="Store Chemical",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Chemical")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Chemical")
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
     *                  ref="#/definitions/Chemical"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateChemicalAPIRequest $request)
    {
        $input = $request->all();

        $chemical = $this->chemicalRepository->create($input);

        return $this->sendResponse($chemical->toArray(), 'Chemical saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/chemicals/{id}",
     *      summary="Display the specified Chemical",
     *      tags={"Chemical"},
     *      description="Get Chemical",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Chemical",
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
     *                  ref="#/definitions/Chemical"
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
        /** @var Chemical $chemical */
        $chemical = $this->chemicalRepository->find($id);

        if (empty($chemical)) {
            return $this->sendError('Chemical not found');
        }

        return $this->sendResponse($chemical->toArray(), 'Chemical retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateChemicalAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/chemicals/{id}",
     *      summary="Update the specified Chemical in storage",
     *      tags={"Chemical"},
     *      description="Update Chemical",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Chemical",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Chemical")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Chemical")
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
     *                  ref="#/definitions/Chemical"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateChemicalAPIRequest $request)
    {
        $input = $request->all();

        /** @var Chemical $chemical */
        $chemical = $this->chemicalRepository->find($id);

        if ($chemical === null) {
            return $this->sendError('Chemical not found');
        }

        $chemical = $this->chemicalRepository->update($input, $id);

        return $this->sendResponse($chemical->toArray(), 'Chemical updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/chemicals/{id}",
     *      summary="Remove the specified Chemical from storage",
     *      tags={"Chemical"},
     *      description="Delete Chemical",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Chemical",
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
        /** @var Chemical $chemical */
        $chemical = $this->chemicalRepository->find($id);

        if ($chemical === null) {
            return $this->sendError('Chemical not found');
        }

        $chemical->delete();

        return $this->sendResponse($id, 'Chemical deleted successfully');
    }
}
