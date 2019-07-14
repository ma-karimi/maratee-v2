<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateSeedMolecularAPIRequest;
use App\Http\Requests\Api\UpdateSeedMolecularAPIRequest;
use App\Models\SeedMolecular;
use App\Repositories\SeedMolecularRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SeedMolecularController
 * @package App\Http\Controllers\Api
 */

class SeedMolecularAPIController extends AppBaseController
{
    /** @var  SeedMolecularRepository */
    private $seedMolecularRepository;

    public function __construct(SeedMolecularRepository $seedMolecularRepo)
    {
        $this->seedMolecularRepository = $seedMolecularRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/seedMoleculars",
     *      summary="Get a listing of the SeedMoleculars.",
     *      tags={"SeedMolecular"},
     *      description="Get all SeedMoleculars",
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
     *                  @SWG\Items(ref="#/definitions/SeedMolecular")
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
        $seedMoleculars = $this->seedMolecularRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($seedMoleculars->toArray(), 'Seed Moleculars retrieved successfully');
    }

    /**
     * @param CreateSeedMolecularAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/seedMoleculars",
     *      summary="Store a newly created SeedMolecular in storage",
     *      tags={"SeedMolecular"},
     *      description="Store SeedMolecular",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="SeedMolecular that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedMolecular")
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
     *                  ref="#/definitions/SeedMolecular"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSeedMolecularAPIRequest $request)
    {
        $input = $request->all();

        $seedMolecular = $this->seedMolecularRepository->create($input);

        return $this->sendResponse($seedMolecular->toArray(), 'Seed Molecular saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/seedMoleculars/{id}",
     *      summary="Display the specified SeedMolecular",
     *      tags={"SeedMolecular"},
     *      description="Get SeedMolecular",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedMolecular",
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
     *                  ref="#/definitions/SeedMolecular"
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
        /** @var SeedMolecular $seedMolecular */
        $seedMolecular = $this->seedMolecularRepository->find($id);

        if (empty($seedMolecular)) {
            return $this->sendError('Seed Molecular not found');
        }

        return $this->sendResponse($seedMolecular->toArray(), 'Seed Molecular retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateSeedMolecularAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/seedMoleculars/{id}",
     *      summary="Update the specified SeedMolecular in storage",
     *      tags={"SeedMolecular"},
     *      description="Update SeedMolecular",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedMolecular",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="SeedMolecular that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedMolecular")
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
     *                  ref="#/definitions/SeedMolecular"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSeedMolecularAPIRequest $request)
    {
        $input = $request->all();

        /** @var SeedMolecular $seedMolecular */
        $seedMolecular = $this->seedMolecularRepository->find($id);

        if (empty($seedMolecular)) {
            return $this->sendError('Seed Molecular not found');
        }

        $seedMolecular = $this->seedMolecularRepository->update($input, $id);

        return $this->sendResponse($seedMolecular->toArray(), 'SeedMolecular updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/seedMoleculars/{id}",
     *      summary="Remove the specified SeedMolecular from storage",
     *      tags={"SeedMolecular"},
     *      description="Delete SeedMolecular",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedMolecular",
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
        /** @var SeedMolecular $seedMolecular */
        $seedMolecular = $this->seedMolecularRepository->find($id);

        if (empty($seedMolecular)) {
            return $this->sendError('Seed Molecular not found');
        }

        $seedMolecular->delete();

        return $this->sendResponse($id, 'Seed Molecular deleted successfully');
    }
}
