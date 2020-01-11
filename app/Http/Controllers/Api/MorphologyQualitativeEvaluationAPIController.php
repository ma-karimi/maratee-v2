<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\MorphologyQualitativeEvaluationAPIRequest;
use App\Http\Requests\Api\MorphologyVariableAPIRequest;
use App\Models\MorphologyQualitativeEvaluation;
use App\Repositories\MorphologyQualitativeEvaluationRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Response;

/**
 * Class MorphologyQualitativeEvaluationController
 * @package App\Http\Controllers\Api
 */
class MorphologyQualitativeEvaluationAPIController extends AppBaseController
{
    /** @var  MorphologyQualitativeEvaluationRepository */
    private $morphologyQualitativeEvaluationRepository;

    public function __construct(MorphologyQualitativeEvaluationRepository $morphologyQualitativeEvaluationRepo)
    {
        $this->morphologyQualitativeEvaluationRepository = $morphologyQualitativeEvaluationRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/morphology/qualitative_evaluations",
     *      summary="Get a listing of the MorphologyQualitativeEvaluations.",
     *      tags={"MorphologyQualitativeEvaluation"},
     *      description="Get all MorphologyQualitativeEvaluations",
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
     *                  @SWG\Items(ref="#/definitions/MorphologyQualitativeEvaluation")
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
        $morphologyQualitativeEvaluations = $this->morphologyQualitativeEvaluationRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $this->getRelationFields()
        );

        return $this->sendResponse($morphologyQualitativeEvaluations->toArray(), 'Morphology Qualitative Evaluations retrieved successfully');
    }

    private function getRelationFields()
    {
        return ['variables', 'morphologyField', 'seedCollection:id,accession_code', 'specimenType', 'collection', 'organization', 'project'];
    }

    /**
     * @param MorphologyQualitativeEvaluationAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/morphology/qualitative_evaluations",
     *      summary="Store a newly created MorphologyQualitativeEvaluation in storage",
     *      tags={"MorphologyQualitativeEvaluation"},
     *      description="Store MorphologyQualitativeEvaluation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="seed_collection_id",
     *          in="body",
     *          description="MorphologyQualitativeEvaluation that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/MorphologyQualitativeEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="collection_id",
     *          in="body",
     *          description="MorphologyQualitativeEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MorphologyQualitativeEvaluation")
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
     *                  ref="#/definitions/MorphologyQualitativeEvaluation"
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
    public function store(MorphologyQualitativeEvaluationAPIRequest $request)
    {
        $input = $request->all();

        $morphologyQualitativeEvaluation = $this->morphologyQualitativeEvaluationRepository->create($input);

        return $this->sendResponse($morphologyQualitativeEvaluation->toArray(), 'Morphology Qualitative Evaluation saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/morphology/qualitative_evaluations/{id}",
     *      summary="Display the specified MorphologyQualitativeEvaluation",
     *      tags={"MorphologyQualitativeEvaluation"},
     *      description="Get MorphologyQualitativeEvaluation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MorphologyQualitativeEvaluation",
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
     *                  ref="#/definitions/MorphologyQualitativeEvaluation"
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
        /** @var MorphologyQualitativeEvaluation $morphologyQualitativeEvaluation */
        $morphologyQualitativeEvaluation = $this->morphologyQualitativeEvaluationRepository->find($id, $this->getRelationFields());

        if (empty($morphologyQualitativeEvaluation)) {
            return $this->sendError('Morphology Qualitative Evaluation not found');
        }

        return $this->sendResponse($morphologyQualitativeEvaluation->toArray(), 'Morphology Qualitative Evaluation retrieved successfully');
    }

    /**
     * @param int $id
     * @param MorphologyQualitativeEvaluationAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/morphology/qualitative_evaluations/{id}",
     *      summary="Update the specified MorphologyQualitativeEvaluation in storage",
     *      tags={"MorphologyQualitativeEvaluation"},
     *      description="Update MorphologyQualitativeEvaluation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MorphologyQualitativeEvaluation",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="seed_collection_id",
     *          in="body",
     *          description="MorphologyQualitativeEvaluation that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/MorphologyQualitativeEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="collection_id",
     *          in="body",
     *          description="MorphologyQualitativeEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MorphologyQualitativeEvaluation")
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
     *                  ref="#/definitions/MorphologyQualitativeEvaluation"
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
    public function update($id, MorphologyQualitativeEvaluationAPIRequest $request)
    {
        $input = $request->all();

        /** @var MorphologyQualitativeEvaluation $morphologyQualitativeEvaluation */
        $morphologyQualitativeEvaluation = $this->morphologyQualitativeEvaluationRepository->find($id);

        if (empty($morphologyQualitativeEvaluation)) {
            return $this->sendError('Morphology Qualitative Evaluation not found');
        }

        $morphologyQualitativeEvaluation = $this->morphologyQualitativeEvaluationRepository->update($input, $id);

        return $this->sendResponse($morphologyQualitativeEvaluation->toArray(), 'MorphologyQualitativeEvaluation updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/morphology/qualitative_evaluations/{id}",
     *      summary="Remove the specified MorphologyQualitativeEvaluation from storage",
     *      tags={"MorphologyQualitativeEvaluation"},
     *      description="Delete MorphologyQualitativeEvaluation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MorphologyQualitativeEvaluation",
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
        /** @var MorphologyQualitativeEvaluation $morphologyQualitativeEvaluation */
        $morphologyQualitativeEvaluation = $this->morphologyQualitativeEvaluationRepository->find($id);

        if (empty($morphologyQualitativeEvaluation)) {
            return $this->sendError('Morphology Qualitative Evaluation not found');
        }

        $morphologyQualitativeEvaluation->delete();

        return $this->sendResponse($id, 'Morphology Qualitative Evaluation deleted successfully');
    }

    public function storeVariables($id, MorphologyVariableAPIRequest $request)
    {
        $input = $request->all();

        /** @var MorphologyQualitativeEvaluation $morphologyQualitativeEvaluation */
        $morphologyQualitativeEvaluation = $this->morphologyQualitativeEvaluationRepository->find($id);

        if (empty($morphologyQualitativeEvaluation)) {
            return $this->sendError('Morphology Qualitative Evaluation not found');
        }

        $this->morphologyQualitativeEvaluationRepository->storeVariable($input['variables'], $id);

        return $this->sendResponse($morphologyQualitativeEvaluation->toArray(), 'MorphologyQualitativeEvaluation updated successfully');
    }
}
