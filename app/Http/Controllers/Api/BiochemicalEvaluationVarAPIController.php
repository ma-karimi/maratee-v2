<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateBiochemicalEvaluationVarAPIRequest;
use App\Http\Requests\Api\UpdateBiochemicalEvaluationVarAPIRequest;
use App\Models\BiochemicalEvaluationVar;
use App\Repositories\BiochemicalEvaluationVarRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class BiochemicalEvaluationVarController
 * @package App\Http\Controllers\Api
 */

class BiochemicalEvaluationVarAPIController extends AppBaseController
{
    /** @var  BiochemicalEvaluationVarRepository */
    private $biochemicalEvaluationVarRepository;

    public function __construct(BiochemicalEvaluationVarRepository $biochemicalEvaluationVarRepo)
    {
        $this->biochemicalEvaluationVarRepository = $biochemicalEvaluationVarRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/biochemicalEvaluationVars",
     *      summary="Get a listing of the BiochemicalEvaluationVars.",
     *      tags={"BiochemicalEvaluationVar"},
     *      description="Get all BiochemicalEvaluationVars",
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
     *                  @SWG\Items(ref="#/definitions/BiochemicalEvaluationVar")
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
        $biochemicalEvaluationVars = $this->biochemicalEvaluationVarRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($biochemicalEvaluationVars->toArray(), 'Biochemical Evaluation Vars retrieved successfully');
    }

    /**
     * @param CreateBiochemicalEvaluationVarAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/biochemicalEvaluationVars",
     *      summary="Store a newly created BiochemicalEvaluationVar in storage",
     *      tags={"BiochemicalEvaluationVar"},
     *      description="Store BiochemicalEvaluationVar",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="biochemical_evaluation_id",
     *          in="body",
     *          description="BiochemicalEvaluationVar that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BiochemicalEvaluationVar")
     *      ),
     *      @SWG\Parameter(
     *          name="var_id",
     *          in="body",
     *          description="BiochemicalEvaluationVar that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BiochemicalEvaluationVar")
     *      ),
     *      @SWG\Parameter(
     *          name="value",
     *          in="body",
     *          description="BiochemicalEvaluationVar that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BiochemicalEvaluationVar")
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
     *                  ref="#/definitions/BiochemicalEvaluationVar"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateBiochemicalEvaluationVarAPIRequest $request)
    {
        $input = $request->all();

        $biochemicalEvaluationVar = $this->biochemicalEvaluationVarRepository->create($input);

        return $this->sendResponse($biochemicalEvaluationVar->toArray(), 'Biochemical Evaluation Var saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/biochemicalEvaluationVars/{id}",
     *      summary="Display the specified BiochemicalEvaluationVar",
     *      tags={"BiochemicalEvaluationVar"},
     *      description="Get BiochemicalEvaluationVar",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BiochemicalEvaluationVar",
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
     *                  ref="#/definitions/BiochemicalEvaluationVar"
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
        /** @var BiochemicalEvaluationVar $biochemicalEvaluationVar */
        $biochemicalEvaluationVar = $this->biochemicalEvaluationVarRepository->find($id);

        if (empty($biochemicalEvaluationVar)) {
            return $this->sendError('Biochemical Evaluation Var not found');
        }

        return $this->sendResponse($biochemicalEvaluationVar->toArray(), 'Biochemical Evaluation Var retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateBiochemicalEvaluationVarAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/biochemicalEvaluationVars/{id}",
     *      summary="Update the specified BiochemicalEvaluationVar in storage",
     *      tags={"BiochemicalEvaluationVar"},
     *      description="Update BiochemicalEvaluationVar",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BiochemicalEvaluationVar",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="biochemical_evaluation_id",
     *          in="body",
     *          description="BiochemicalEvaluationVar that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BiochemicalEvaluationVar")
     *      ),
     *      @SWG\Parameter(
     *          name="var_id",
     *          in="body",
     *          description="BiochemicalEvaluationVar that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BiochemicalEvaluationVar")
     *      ),
     *      @SWG\Parameter(
     *          name="value",
     *          in="body",
     *          description="BiochemicalEvaluationVar that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BiochemicalEvaluationVar")
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
     *                  ref="#/definitions/BiochemicalEvaluationVar"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateBiochemicalEvaluationVarAPIRequest $request)
    {
        $input = $request->all();

        /** @var BiochemicalEvaluationVar $biochemicalEvaluationVar */
        $biochemicalEvaluationVar = $this->biochemicalEvaluationVarRepository->find($id);

        if (empty($biochemicalEvaluationVar)) {
            return $this->sendError('Biochemical Evaluation Var not found');
        }

        $biochemicalEvaluationVar = $this->biochemicalEvaluationVarRepository->update($input, $id);

        return $this->sendResponse($biochemicalEvaluationVar->toArray(), 'BiochemicalEvaluationVar updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/biochemicalEvaluationVars/{id}",
     *      summary="Remove the specified BiochemicalEvaluationVar from storage",
     *      tags={"BiochemicalEvaluationVar"},
     *      description="Delete BiochemicalEvaluationVar",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BiochemicalEvaluationVar",
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
        /** @var BiochemicalEvaluationVar $biochemicalEvaluationVar */
        $biochemicalEvaluationVar = $this->biochemicalEvaluationVarRepository->find($id);

        if (empty($biochemicalEvaluationVar)) {
            return $this->sendError('Biochemical Evaluation Var not found');
        }

        $biochemicalEvaluationVar->delete();

        return $this->sendResponse($id, 'Biochemical Evaluation Var deleted successfully');
    }
}
