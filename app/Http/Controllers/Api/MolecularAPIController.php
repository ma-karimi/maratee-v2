<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateMolecularAPIRequest;
use App\Http\Requests\Api\UpdateMolecularAPIRequest;
use App\Models\Molecular;
use App\Repositories\MolecularRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class MolecularController
 * @package App\Http\Controllers\Api
 */

class MolecularAPIController extends AppBaseController
{
    /** @var  MolecularRepository */
    private $molecularRepository;

    public function __construct(MolecularRepository $molecularRepo)
    {
        $this->molecularRepository = $molecularRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/moleculars",
     *      summary="Get a listing of the Moleculars.",
     *      tags={"Molecular"},
     *      description="Get all Moleculars",
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
     *                  @SWG\Items(ref="#/definitions/Molecular")
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
        $moleculars = $this->molecularRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($moleculars->toArray(), 'Moleculars retrieved successfully');
    }

    /**
     * @param CreateMolecularAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/moleculars",
     *      summary="Store a newly created Molecular in storage",
     *      tags={"Molecular"},
     *      description="Store Molecular",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Molecular that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Molecular")
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
     *                  ref="#/definitions/Molecular"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateMolecularAPIRequest $request)
    {
        $input = $request->all();

        $molecular = $this->molecularRepository->create($input);

        return $this->sendResponse($molecular->toArray(), 'Molecular saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/moleculars/{id}",
     *      summary="Display the specified Molecular",
     *      tags={"Molecular"},
     *      description="Get Molecular",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Molecular",
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
     *                  ref="#/definitions/Molecular"
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
        /** @var Molecular $molecular */
        $molecular = $this->molecularRepository->find($id);

        if (empty($molecular)) {
            return $this->sendError('Molecular not found');
        }

        return $this->sendResponse($molecular->toArray(), 'Molecular retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateMolecularAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/moleculars/{id}",
     *      summary="Update the specified Molecular in storage",
     *      tags={"Molecular"},
     *      description="Update Molecular",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Molecular",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Molecular that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Molecular")
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
     *                  ref="#/definitions/Molecular"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateMolecularAPIRequest $request)
    {
        $input = $request->all();

        /** @var Molecular $molecular */
        $molecular = $this->molecularRepository->find($id);

        if (empty($molecular)) {
            return $this->sendError('Molecular not found');
        }

        $molecular = $this->molecularRepository->update($input, $id);

        return $this->sendResponse($molecular->toArray(), 'Molecular updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/moleculars/{id}",
     *      summary="Remove the specified Molecular from storage",
     *      tags={"Molecular"},
     *      description="Delete Molecular",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Molecular",
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
        /** @var Molecular $molecular */
        $molecular = $this->molecularRepository->find($id);

        if (empty($molecular)) {
            return $this->sendError('Molecular not found');
        }

        $molecular->delete();

        return $this->sendResponse($id, 'Molecular deleted successfully');
    }
}
