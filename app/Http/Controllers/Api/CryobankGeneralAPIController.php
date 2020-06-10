<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\CryobankGeneralAPIRequest;
use App\Repositories\CryobankGeneralRepository;
use Exception;
use Illuminate\Http\Request;
use Response;

/**
 * Class CryobankGeneralController
 * @package App\Http\Controllers\Api
 */
class CryobankGeneralAPIController extends AppBaseController
{
    /** @var  CryobankGeneralRepository */
    private $cryobankGeneralRepository;

    public function __construct(CryobankGeneralRepository $cryobankGeneralRepo)
    {
        $this->cryobankGeneralRepository = $cryobankGeneralRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/cryobank_generals",
     *      summary="Get a listing of the CryobankGenerals.",
     *      tags={"CryobankGeneral"},
     *      description="Get all CryobankGenerals",
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
     *                  @SWG\Items(ref="#/definitions/CryobankGeneral")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     * @throws Exception
     */
    public function index(Request $request)
    {
        $cryobankGenerals = $this->cryobankGeneralRepository->all();

        return $this->sendResponse($cryobankGenerals->toArray(), 'CryobankGenerals retrieved successfully');
    }

    /**
     * @param CryobankGeneralAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/cryobank_generals",
     *      summary="Store a newly created CryobankGeneral in storage",
     *      tags={"CryobankGeneral"},
     *      description="Store CryobankGeneral",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/CryobankGeneral")
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
     *                  ref="#/definitions/CryobankGeneral"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(CryobankGeneralAPIRequest $request)
    {
        $input = $request->all();

        $cryobankGeneral = $this->cryobankGeneralRepository->create($input);

        return $this->sendResponse($cryobankGeneral->toArray(), 'CryobankGeneral saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/cryobank_generals/{id}",
     *      summary="Display the specified CryobankGeneral",
     *      tags={"CryobankGeneral"},
     *      description="Get CryobankGeneral",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of CryobankGeneral",
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
     *                  ref="#/definitions/CryobankGeneral"
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
        $cryobankGeneral = $this->cryobankGeneralRepository->find($id);

        if ($cryobankGeneral === null) {
            return $this->sendError('CryobankGeneral not found');
        }

        return $this->sendResponse($cryobankGeneral->toArray(), 'CryobankGeneral retrieved successfully');
    }

    /**
     * @param int $id
     * @param CryobankGeneralAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/cryobank_generals/{id}",
     *      summary="Update the specified CryobankGeneral in storage",
     *      tags={"CryobankGeneral"},
     *      description="Update CryobankGeneral",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of CryobankGeneral",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/CryobankGeneral")
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
     *                  ref="#/definitions/CryobankGeneral"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update($id, CryobankGeneralAPIRequest $request)
    {
        $input = $request->all();

        $cryobankGeneral = $this->cryobankGeneralRepository->find($id);

        if ($cryobankGeneral === null) {
            return $this->sendError('CryobankGeneral not found');
        }

        $cryobankGeneral = $this->cryobankGeneralRepository->update($input, $id);

        return $this->sendResponse($cryobankGeneral->toArray(), 'CryobankGeneral updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws Exception
     * @SWG\Delete(
     *      path="/cryobank_generals/{id}",
     *      summary="Remove the specified CryobankGeneral from storage",
     *      tags={"CryobankGeneral"},
     *      description="Delete CryobankGeneral",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of CryobankGeneral",
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
        $cryobankGeneral = $this->cryobankGeneralRepository->find($id);

        if ($cryobankGeneral === null) {
            return $this->sendError('CryobankGeneral not found');
        }

        $cryobankGeneral->delete();

        return $this->sendResponse($id, 'CryobankGeneral deleted successfully');
    }
}
