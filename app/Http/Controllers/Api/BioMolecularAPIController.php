<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateBioMolecularAPIRequest;
use App\Http\Requests\Api\UpdateBioMolecularAPIRequest;
use App\Models\BioMolecular;
use App\Repositories\BioMolecularRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class BioMolecularController
 * @package App\Http\Controllers\Api
 */

class BioMolecularAPIController extends AppBaseController
{
    /** @var  BioMolecularRepository */
    private $bioMolecularRepository;

    public function __construct(BioMolecularRepository $bioMolecularRepo)
    {
        $this->bioMolecularRepository = $bioMolecularRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/bio_moleculars",
     *      summary="Get a listing of the BioMoleculars.",
     *      tags={"BioMolecular"},
     *      description="Get all BioMoleculars",
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
     *                  @SWG\Items(ref="#/definitions/BioMolecular")
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
        $bioMoleculars = $this->bioMolecularRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($bioMoleculars->toArray(), 'Bio Moleculars retrieved successfully');
    }

    /**
     * @param CreateBioMolecularAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/bio_moleculars",
     *      summary="Store a newly created BioMolecular in storage",
     *      tags={"BioMolecular"},
     *      description="Store BioMolecular",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="technology_id",
     *          in="body",
     *          description="BioMolecular that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BioMolecular")
     *      ),
     *      @SWG\Parameter(
     *          name="seed_feature_id",
     *          in="body",
     *          description="BioMolecular that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BioMolecular")
     *      ),
     *      @SWG\Parameter(
     *          name="block_id",
     *          in="body",
     *          description="BioMolecular that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BioMolecular")
     *      ),
     *      @SWG\Parameter(
     *          name="value",
     *          in="body",
     *          description="BioMolecular that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BioMolecular")
     *      ),
     *      @SWG\Parameter(
     *          name="repeat",
     *          in="body",
     *          description="BioMolecular that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BioMolecular")
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
     *                  ref="#/definitions/BioMolecular"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateBioMolecularAPIRequest $request)
    {
        $input = $request->all();

        $bioMolecular = $this->bioMolecularRepository->create($input);

        return $this->sendResponse($bioMolecular->toArray(), 'Bio Molecular saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/bio_moleculars/{id}",
     *      summary="Display the specified BioMolecular",
     *      tags={"BioMolecular"},
     *      description="Get BioMolecular",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BioMolecular",
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
     *                  ref="#/definitions/BioMolecular"
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
        /** @var BioMolecular $bioMolecular */
        $bioMolecular = $this->bioMolecularRepository->find($id, \request()->get('relations'));

        if ($bioMolecular === null) {
            return $this->sendError('Bio Molecular not found');
        }

        return $this->sendResponse($bioMolecular->toArray(), 'Bio Molecular retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateBioMolecularAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/bio_moleculars/{id}",
     *      summary="Update the specified BioMolecular in storage",
     *      tags={"BioMolecular"},
     *      description="Update BioMolecular",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BioMolecular",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="technology_id",
     *          in="body",
     *          description="BioMolecular that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BioMolecular")
     *      ),
     *      @SWG\Parameter(
     *          name="seed_feature_id",
     *          in="body",
     *          description="BioMolecular that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BioMolecular")
     *      ),
     *      @SWG\Parameter(
     *          name="block_id",
     *          in="body",
     *          description="BioMolecular that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BioMolecular")
     *      ),
     *      @SWG\Parameter(
     *          name="value",
     *          in="body",
     *          description="BioMolecular that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BioMolecular")
     *      ),
     *      @SWG\Parameter(
     *          name="repeat",
     *          in="body",
     *          description="BioMolecular that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BioMolecular")
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
     *                  ref="#/definitions/BioMolecular"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateBioMolecularAPIRequest $request)
    {
        $input = $request->all();

        /** @var BioMolecular $bioMolecular */
        $bioMolecular = $this->bioMolecularRepository->find($id, \request()->get('relations'));

        if ($bioMolecular === null) {
            return $this->sendError('Bio Molecular not found');
        }

        $bioMolecular = $this->bioMolecularRepository->update($input, $id);

        return $this->sendResponse($bioMolecular->toArray(), 'BioMolecular updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/bio_moleculars/{id}",
     *      summary="Remove the specified BioMolecular from storage",
     *      tags={"BioMolecular"},
     *      description="Delete BioMolecular",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BioMolecular",
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
        /** @var BioMolecular $bioMolecular */
        $bioMolecular = $this->bioMolecularRepository->find($id, \request()->get('relations'));

        if ($bioMolecular === null) {
            return $this->sendError('Bio Molecular not found');
        }

        $bioMolecular->delete();

        return $this->sendResponse($id, 'Bio Molecular deleted successfully');
    }
}
