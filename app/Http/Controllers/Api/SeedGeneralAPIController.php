<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateSeedGeneralAPIRequest;
use App\Http\Requests\Api\UpdateSeedGeneralAPIRequest;
use App\Models\SeedGeneral;
use App\Repositories\SeedGeneralRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SeedGeneralController
 * @package App\Http\Controllers\Api
 */

class SeedGeneralAPIController extends AppBaseController
{
    /** @var  SeedGeneralRepository */
    private $seedGeneralRepository;

    public function __construct(SeedGeneralRepository $seedGeneralRepo)
    {
        $this->seedGeneralRepository = $seedGeneralRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/seed_generals",
     *      summary="Get a listing of the SeedGenerals.",
     *      tags={"SeedGeneral"},
     *      description="Get all SeedGenerals",
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
     *                  @SWG\Items(ref="#/definitions/SeedGeneral")
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
        $seedGenerals = $this->seedGeneralRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($seedGenerals->toArray(), 'Seed Generals retrieved successfully');
    }

    /**
     * @param CreateSeedGeneralAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/seed_generals",
     *      summary="Store a newly created SeedGeneral in storage",
     *      tags={"SeedGeneral"},
     *      description="Store SeedGeneral",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="SeedGeneral that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedGeneral")
     *      ),
     *      @SWG\Parameter(
     *          name="type",
     *          in="body",
     *          description="SeedGeneral that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedGeneral")
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
     *                  ref="#/definitions/SeedGeneral"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSeedGeneralAPIRequest $request)
    {
        $input = $request->all();

        $seedGeneral = $this->seedGeneralRepository->create($input);

        return $this->sendResponse($seedGeneral->toArray(), 'Seed General saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/seed_generals/{id}",
     *      summary="Display the specified SeedGeneral",
     *      tags={"SeedGeneral"},
     *      description="Get SeedGeneral",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedGeneral",
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
     *                  ref="#/definitions/SeedGeneral"
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
        /** @var SeedGeneral $seedGeneral */
        $seedGeneral = $this->seedGeneralRepository->find($id);

        if (empty($seedGeneral)) {
            return $this->sendError('Seed General not found');
        }

        return $this->sendResponse($seedGeneral->toArray(), 'Seed General retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateSeedGeneralAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/seed_generals/{id}",
     *      summary="Update the specified SeedGeneral in storage",
     *      tags={"SeedGeneral"},
     *      description="Update SeedGeneral",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedGeneral",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="SeedGeneral that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedGeneral")
     *      ),
     *      @SWG\Parameter(
     *          name="type",
     *          in="body",
     *          description="SeedGeneral that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedGeneral")
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
     *                  ref="#/definitions/SeedGeneral"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSeedGeneralAPIRequest $request)
    {
        $input = $request->all();

        /** @var SeedGeneral $seedGeneral */
        $seedGeneral = $this->seedGeneralRepository->find($id);

        if (empty($seedGeneral)) {
            return $this->sendError('Seed General not found');
        }

        $seedGeneral = $this->seedGeneralRepository->update($input, $id);

        return $this->sendResponse($seedGeneral->toArray(), 'SeedGeneral updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/seed_generals/{id}",
     *      summary="Remove the specified SeedGeneral from storage",
     *      tags={"SeedGeneral"},
     *      description="Delete SeedGeneral",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedGeneral",
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
        /** @var SeedGeneral $seedGeneral */
        $seedGeneral = $this->seedGeneralRepository->find($id);

        if (empty($seedGeneral)) {
            return $this->sendError('Seed General not found');
        }

        $seedGeneral->delete();

        return $this->sendResponse($id, 'Seed General deleted successfully');
    }
}
