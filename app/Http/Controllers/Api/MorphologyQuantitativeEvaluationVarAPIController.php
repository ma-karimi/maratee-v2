<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\MorphologyQuantitativeEvaluationVarAPIRequest;
use App\Models\MorphologyQuantitativeEvaluationVar;
use App\Repositories\MorphologyQuantitativeEvaluationVarRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Response;

/**
 * Class MorphologyQuantitativeEvaluationVarController
 * @package App\Http\Controllers\Api
 */
class MorphologyQuantitativeEvaluationVarAPIController extends AppBaseController
{
    /** @var  MorphologyQuantitativeEvaluationVarRepository */
    private $morphologyQuantitativeEvaluationVarRepository;

    public function __construct(MorphologyQuantitativeEvaluationVarRepository $morphologyQuantitativeEvaluationVarRepo)
    {
        $this->morphologyQuantitativeEvaluationVarRepository = $morphologyQuantitativeEvaluationVarRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/morphology/quantitative_evaluation_vars",
     *      summary="Get a listing of the MorphologyQuantitativeEvaluationVars.",
     *      tags={"MorphologyQuantitativeEvaluationVar"},
     *      description="Get all MorphologyQuantitativeEvaluationVars",
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
     *                  @SWG\Items(ref="#/definitions/MorphologyQuantitativeEvaluationVar")
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
        $morphologyQuantitativeEvaluationVars = $this->morphologyQuantitativeEvaluationVarRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($morphologyQuantitativeEvaluationVars->toArray(), 'Morphology Quantitative Evaluation Vars retrieved successfully');
    }

    /**
     * @param MorphologyQuantitativeEvaluationVarAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/morphology/quantitative_evaluation_vars",
     *      summary="Store a newly created MorphologyQuantitativeEvaluationVar in storage",
     *      tags={"MorphologyQuantitativeEvaluationVar"},
     *      description="Store MorphologyQuantitativeEvaluationVar",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="MorphologyQuantitativeEvaluationVar that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MorphologyQuantitativeEvaluationVar")
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
     *                  ref="#/definitions/MorphologyQuantitativeEvaluationVar"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     * @throws ValidationException
     */
    public function store(MorphologyQuantitativeEvaluationVarAPIRequest $request)
    {
        $input = $request->all();

        $morphologyQuantitativeEvaluationVar = $this->morphologyQuantitativeEvaluationVarRepository->create($input);

        return $this->sendResponse($morphologyQuantitativeEvaluationVar->toArray(), 'Morphology Quantitative Evaluation Var saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/morphology/quantitative_evaluation_vars/{id}",
     *      summary="Display the specified MorphologyQuantitativeEvaluationVar",
     *      tags={"MorphologyQuantitativeEvaluationVar"},
     *      description="Get MorphologyQuantitativeEvaluationVar",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MorphologyQuantitativeEvaluationVar",
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
     *                  ref="#/definitions/MorphologyQuantitativeEvaluationVar"
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
        /** @var MorphologyQuantitativeEvaluationVar $morphologyQuantitativeEvaluationVar */
        $morphologyQuantitativeEvaluationVar = $this->morphologyQuantitativeEvaluationVarRepository->find($id);

        if (empty($morphologyQuantitativeEvaluationVar)) {
            return $this->sendError('Morphology Quantitative Evaluation Var not found');
        }

        return $this->sendResponse($morphologyQuantitativeEvaluationVar->toArray(), 'Morphology Quantitative Evaluation Var retrieved successfully');
    }

    /**
     * @param int $id
     * @param MorphologyQuantitativeEvaluationVarAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/morphology/quantitative_evaluation_vars/{id}",
     *      summary="Update the specified MorphologyQuantitativeEvaluationVar in storage",
     *      tags={"MorphologyQuantitativeEvaluationVar"},
     *      description="Update MorphologyQuantitativeEvaluationVar",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MorphologyQuantitativeEvaluationVar",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="MorphologyQuantitativeEvaluationVar that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MorphologyQuantitativeEvaluationVar")
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
     *                  ref="#/definitions/MorphologyQuantitativeEvaluationVar"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     * @throws ValidationException
     */
    public function update($id, MorphologyQuantitativeEvaluationVarAPIRequest $request)
    {
        $input = $request->all();

        /** @var MorphologyQuantitativeEvaluationVar $morphologyQuantitativeEvaluationVar */
        $morphologyQuantitativeEvaluationVar = $this->morphologyQuantitativeEvaluationVarRepository->find($id);

        if (empty($morphologyQuantitativeEvaluationVar)) {
            return $this->sendError('Morphology Quantitative Evaluation Var not found');
        }

        $morphologyQuantitativeEvaluationVar = $this->morphologyQuantitativeEvaluationVarRepository->update($input, $id);

        return $this->sendResponse($morphologyQuantitativeEvaluationVar->toArray(), 'MorphologyQuantitativeEvaluationVar updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/morphology/quantitative_evaluation_vars/{id}",
     *      summary="Remove the specified MorphologyQuantitativeEvaluationVar from storage",
     *      tags={"MorphologyQuantitativeEvaluationVar"},
     *      description="Delete MorphologyQuantitativeEvaluationVar",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MorphologyQuantitativeEvaluationVar",
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
     * @throws Exception
     */
    public function destroy($id)
    {
        /** @var MorphologyQuantitativeEvaluationVar $morphologyQuantitativeEvaluationVar */
        $morphologyQuantitativeEvaluationVar = $this->morphologyQuantitativeEvaluationVarRepository->find($id);

        if (empty($morphologyQuantitativeEvaluationVar)) {
            return $this->sendError('Morphology Quantitative Evaluation Var not found');
        }

        $morphologyQuantitativeEvaluationVar->delete();

        return $this->sendResponse($id, 'Morphology Quantitative Evaluation Var deleted successfully');
    }
}
