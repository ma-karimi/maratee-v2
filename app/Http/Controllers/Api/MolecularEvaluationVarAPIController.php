<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateMolecularEvaluationVarAPIRequest;
use App\Http\Requests\Api\UpdateMolecularEvaluationVarAPIRequest;
use App\Models\MolecularEvaluationVar;
use App\Repositories\MolecularEvaluationVarRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class MolecularEvaluationVarController
 * @package App\Http\Controllers\Api
 */

class MolecularEvaluationVarAPIController extends AppBaseController
{
    /** @var  MolecularEvaluationVarRepository */
    private $molecularEvaluationVarRepository;

    public function __construct(MolecularEvaluationVarRepository $molecularEvaluationVarRepo)
    {
        $this->molecularEvaluationVarRepository = $molecularEvaluationVarRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/molecularEvaluationVars",
     *      summary="Get a listing of the MolecularEvaluationVars.",
     *      tags={"MolecularEvaluationVar"},
     *      description="Get all MolecularEvaluationVars",
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
     *                  @SWG\Items(ref="#/definitions/MolecularEvaluationVar")
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
        $molecularEvaluationVars = $this->molecularEvaluationVarRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($molecularEvaluationVars->toArray(), 'Molecular Evaluation Vars retrieved successfully');
    }

    /**
     * @param CreateMolecularEvaluationVarAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/molecularEvaluationVars",
     *      summary="Store a newly created MolecularEvaluationVar in storage",
     *      tags={"MolecularEvaluationVar"},
     *      description="Store MolecularEvaluationVar",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="molecular_evaluation_id",
     *          in="body",
     *          description="MolecularEvaluationVar that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/MolecularEvaluationVar")
     *      ),
     *      @SWG\Parameter(
     *          name="var_id",
     *          in="body",
     *          description="MolecularEvaluationVar that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MolecularEvaluationVar")
     *      ),
     *      @SWG\Parameter(
     *          name="value",
     *          in="body",
     *          description="MolecularEvaluationVar that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MolecularEvaluationVar")
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
     *                  ref="#/definitions/MolecularEvaluationVar"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateMolecularEvaluationVarAPIRequest $request)
    {
        $input = $request->all();

        $molecularEvaluationVar = $this->molecularEvaluationVarRepository->create($input);

        return $this->sendResponse($molecularEvaluationVar->toArray(), 'Molecular Evaluation Var saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/molecularEvaluationVars/{id}",
     *      summary="Display the specified MolecularEvaluationVar",
     *      tags={"MolecularEvaluationVar"},
     *      description="Get MolecularEvaluationVar",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MolecularEvaluationVar",
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
     *                  ref="#/definitions/MolecularEvaluationVar"
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
        /** @var MolecularEvaluationVar $molecularEvaluationVar */
        $molecularEvaluationVar = $this->molecularEvaluationVarRepository->find($id);

        if (empty($molecularEvaluationVar)) {
            return $this->sendError('Molecular Evaluation Var not found');
        }

        return $this->sendResponse($molecularEvaluationVar->toArray(), 'Molecular Evaluation Var retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateMolecularEvaluationVarAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/molecularEvaluationVars/{id}",
     *      summary="Update the specified MolecularEvaluationVar in storage",
     *      tags={"MolecularEvaluationVar"},
     *      description="Update MolecularEvaluationVar",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MolecularEvaluationVar",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="molecular_evaluation_id",
     *          in="body",
     *          description="MolecularEvaluationVar that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/MolecularEvaluationVar")
     *      ),
     *      @SWG\Parameter(
     *          name="var_id",
     *          in="body",
     *          description="MolecularEvaluationVar that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MolecularEvaluationVar")
     *      ),
     *      @SWG\Parameter(
     *          name="value",
     *          in="body",
     *          description="MolecularEvaluationVar that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MolecularEvaluationVar")
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
     *                  ref="#/definitions/MolecularEvaluationVar"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateMolecularEvaluationVarAPIRequest $request)
    {
        $input = $request->all();

        /** @var MolecularEvaluationVar $molecularEvaluationVar */
        $molecularEvaluationVar = $this->molecularEvaluationVarRepository->find($id);

        if (empty($molecularEvaluationVar)) {
            return $this->sendError('Molecular Evaluation Var not found');
        }

        $molecularEvaluationVar = $this->molecularEvaluationVarRepository->update($input, $id);

        return $this->sendResponse($molecularEvaluationVar->toArray(), 'MolecularEvaluationVar updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/molecularEvaluationVars/{id}",
     *      summary="Remove the specified MolecularEvaluationVar from storage",
     *      tags={"MolecularEvaluationVar"},
     *      description="Delete MolecularEvaluationVar",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MolecularEvaluationVar",
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
        /** @var MolecularEvaluationVar $molecularEvaluationVar */
        $molecularEvaluationVar = $this->molecularEvaluationVarRepository->find($id);

        if (empty($molecularEvaluationVar)) {
            return $this->sendError('Molecular Evaluation Var not found');
        }

        $molecularEvaluationVar->delete();

        return $this->sendResponse($id, 'Molecular Evaluation Var deleted successfully');
    }
}
