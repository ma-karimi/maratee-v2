<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateCryoBankActionAPIRequest;
use App\Http\Requests\Api\UpdateCryoBankActionAPIRequest;
use App\Models\CryoBankAction;
use App\Repositories\CryoBankActionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class CryoBankActionController
 * @package App\Http\Controllers\Api
 */

class CryoBankActionAPIController extends AppBaseController
{
    /** @var  CryoBankActionRepository */
    private $cryoBankActionRepository;

    public function __construct(CryoBankActionRepository $cryoBankActionRepo)
    {
        $this->cryoBankActionRepository = $cryoBankActionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/cryo_bank_actions",
     *      summary="Get a listing of the CryoBankActions.",
     *      tags={"CryoBankAction"},
     *      description="Get all CryoBankActions",
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
     *                  @SWG\Items(ref="#/definitions/CryoBankAction")
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
        $cryoBankActions = $this->cryoBankActionRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($cryoBankActions->toArray(), 'Cryo Bank Actions retrieved successfully');
    }

    /**
     * @param CreateCryoBankActionAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/cryo_bank_actions",
     *      summary="Store a newly created CryoBankAction in storage",
     *      tags={"CryoBankAction"},
     *      description="Store CryoBankAction",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="cryo_bank_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/CryoBankAction")
     *      ),
     *      @SWG\Parameter(
     *          name="action_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/CryoBankAction")
     *      ),
     *      @SWG\Parameter(
     *          name="location_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/CryoBankAction")
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
     *                  ref="#/definitions/CryoBankAction"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateCryoBankActionAPIRequest $request)
    {
        $input = $request->all();

        $cryoBankAction = $this->cryoBankActionRepository->create($input);

        return $this->sendResponse($cryoBankAction->toArray(), 'Cryo Bank Action saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/cryo_bank_actions/{id}",
     *      summary="Display the specified CryoBankAction",
     *      tags={"CryoBankAction"},
     *      description="Get CryoBankAction",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of CryoBankAction",
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
     *                  ref="#/definitions/CryoBankAction"
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
        /** @var CryoBankAction $cryoBankAction */
        $cryoBankAction = $this->cryoBankActionRepository->find($id, \request()->get('relations'));

        if ($cryoBankAction === null) {
            return $this->sendError('Cryo Bank Action not found');
        }

        return $this->sendResponse($cryoBankAction->toArray(), 'Cryo Bank Action retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateCryoBankActionAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/cryo_bank_actions/{id}",
     *      summary="Update the specified CryoBankAction in storage",
     *      tags={"CryoBankAction"},
     *      description="Update CryoBankAction",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of CryoBankAction",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="cryo_bank_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/CryoBankAction")
     *      ),
     *      @SWG\Parameter(
     *          name="action_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/CryoBankAction")
     *      ),
     *      @SWG\Parameter(
     *          name="location_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/CryoBankAction")
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
     *                  ref="#/definitions/CryoBankAction"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateCryoBankActionAPIRequest $request)
    {
        $input = $request->all();

        /** @var CryoBankAction $cryoBankAction */
        $cryoBankAction = $this->cryoBankActionRepository->find($id, \request()->get('relations'));

        if ($cryoBankAction === null) {
            return $this->sendError('Cryo Bank Action not found');
        }

        $cryoBankAction = $this->cryoBankActionRepository->update($input, $id);

        return $this->sendResponse($cryoBankAction->toArray(), 'CryoBankAction updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/cryo_bank_actions/{id}",
     *      summary="Remove the specified CryoBankAction from storage",
     *      tags={"CryoBankAction"},
     *      description="Delete CryoBankAction",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of CryoBankAction",
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
        /** @var CryoBankAction $cryoBankAction */
        $cryoBankAction = $this->cryoBankActionRepository->find($id, \request()->get('relations'));

        if ($cryoBankAction === null) {
            return $this->sendError('Cryo Bank Action not found');
        }

        $cryoBankAction->delete();

        return $this->sendResponse($id, 'Cryo Bank Action deleted successfully');
    }
}
