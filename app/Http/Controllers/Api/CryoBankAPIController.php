<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateCryoBankAPIRequest;
use App\Http\Requests\Api\UpdateCryoBankAPIRequest;
use App\Models\CryoBank;
use App\Repositories\CryoBankRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class CryoBankController
 * @package App\Http\Controllers\Api
 */

class CryoBankAPIController extends AppBaseController
{
    /** @var  CryoBankRepository */
    private $cryoBankRepository;

    public function __construct(CryoBankRepository $cryoBankRepo)
    {
        $this->cryoBankRepository = $cryoBankRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/cryoBanks",
     *      summary="Get a listing of the CryoBanks.",
     *      tags={"CryoBank"},
     *      description="Get all CryoBanks",
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
     *                  @SWG\Items(ref="#/definitions/CryoBank")
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
        $cryoBanks = $this->cryoBankRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($cryoBanks->toArray(), 'Cryo Banks retrieved successfully');
    }

    /**
     * @param CreateCryoBankAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/cryoBanks",
     *      summary="Store a newly created CryoBank in storage",
     *      tags={"CryoBank"},
     *      description="Store CryoBank",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="CryoBank that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CryoBank")
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
     *                  ref="#/definitions/CryoBank"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateCryoBankAPIRequest $request)
    {
        $input = $request->all();

        $cryoBank = $this->cryoBankRepository->create($input);

        return $this->sendResponse($cryoBank->toArray(), 'Cryo Bank saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/cryoBanks/{id}",
     *      summary="Display the specified CryoBank",
     *      tags={"CryoBank"},
     *      description="Get CryoBank",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of CryoBank",
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
     *                  ref="#/definitions/CryoBank"
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
        /** @var CryoBank $cryoBank */
        $cryoBank = $this->cryoBankRepository->find($id);

        if (empty($cryoBank)) {
            return $this->sendError('Cryo Bank not found');
        }

        return $this->sendResponse($cryoBank->toArray(), 'Cryo Bank retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateCryoBankAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/cryoBanks/{id}",
     *      summary="Update the specified CryoBank in storage",
     *      tags={"CryoBank"},
     *      description="Update CryoBank",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of CryoBank",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="CryoBank that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CryoBank")
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
     *                  ref="#/definitions/CryoBank"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateCryoBankAPIRequest $request)
    {
        $input = $request->all();

        /** @var CryoBank $cryoBank */
        $cryoBank = $this->cryoBankRepository->find($id);

        if (empty($cryoBank)) {
            return $this->sendError('Cryo Bank not found');
        }

        $cryoBank = $this->cryoBankRepository->update($input, $id);

        return $this->sendResponse($cryoBank->toArray(), 'CryoBank updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/cryoBanks/{id}",
     *      summary="Remove the specified CryoBank from storage",
     *      tags={"CryoBank"},
     *      description="Delete CryoBank",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of CryoBank",
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
        /** @var CryoBank $cryoBank */
        $cryoBank = $this->cryoBankRepository->find($id);

        if (empty($cryoBank)) {
            return $this->sendError('Cryo Bank not found');
        }

        $cryoBank->delete();

        return $this->sendResponse($id, 'Cryo Bank deleted successfully');
    }
}
