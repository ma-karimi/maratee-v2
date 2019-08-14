<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateEvaluationAPIRequest;
use App\Http\Requests\Api\UpdateEvaluationAPIRequest;
use App\Models\evaluation;
use App\Repositories\EvaluationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class evaluationController
 * @package App\Http\Controllers\Api
 */

class EvaluationAPIController extends AppBaseController
{
    /** @var  EvaluationRepository */
    private $evaluationRepository;

    public function __construct(EvaluationRepository $evaluationRepo)
    {
        $this->evaluationRepository = $evaluationRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/evaluations",
     *      summary="Get a listing of the evaluations.",
     *      tags={"evaluation"},
     *      description="Get all evaluations",
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
     *                  @SWG\Items(ref="#/definitions/evaluation")
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
        $evaluations = $this->evaluationRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($evaluations->toArray(), 'evaluations retrieved successfully');
    }

    /**
     * @param CreateEvaluationAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/evaluations",
     *      summary="Store a newly created evaluation in storage",
     *      tags={"evaluation"},
     *      description="Store evaluation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="date",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/evaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="exchange_seeds_no",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/evaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="planted_seeds_no",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/evaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="fresh_none_germinated_seeds",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/evaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="rotten_seeds",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/evaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="abnormal_seedling",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/evaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="viability_percentage",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/evaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="seedling_morality_no",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/evaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="mean_fresh_seedling_weight",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/evaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="mean_dry_seedling_weight",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/evaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="dry_matter_percentage",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/evaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/evaluation")
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
     *                  ref="#/definitions/evaluation"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateEvaluationAPIRequest $request)
    {
        $input = $request->all();

        $evaluation = $this->evaluationRepository->create($input);

        return $this->sendResponse($evaluation->toArray(), 'evaluation saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/evaluations/{id}",
     *      summary="Display the specified evaluation",
     *      tags={"evaluation"},
     *      description="Get evaluation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of evaluation",
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
     *                  ref="#/definitions/evaluation"
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
        /** @var evaluation $evaluation */
        $evaluation = $this->evaluationRepository->find($id, \request()->get('relations'));

        if (empty($evaluation)) {
            return $this->sendError('evaluation not found');
        }

        return $this->sendResponse($evaluation->toArray(), 'evaluation retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateEvaluationAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/evaluations/{id}",
     *      summary="Update the specified evaluation in storage",
     *      tags={"evaluation"},
     *      description="Update evaluation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of evaluation",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="date",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/evaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="exchange_seeds_no",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/evaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="planted_seeds_no",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/evaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="fresh_none_germinated_seeds",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/evaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="rotten_seeds",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/evaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="abnormal_seedling",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/evaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="viability_percentage",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/evaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="seedling_morality_no",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/evaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="mean_fresh_seedling_weight",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/evaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="mean_dry_seedling_weight",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/evaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="dry_matter_percentage",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/evaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/evaluation")
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
     *                  ref="#/definitions/evaluation"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateEvaluationAPIRequest $request)
    {
        $input = $request->all();

        /** @var evaluation $evaluation */
        $evaluation = $this->evaluationRepository->find($id, \request()->get('relations'));

        if ($evaluation === null) {
            return $this->sendError('evaluation not found');
        }

        $evaluation = $this->evaluationRepository->update($input, $id);

        return $this->sendResponse($evaluation->toArray(), 'evaluation updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/evaluations/{id}",
     *      summary="Remove the specified evaluation from storage",
     *      tags={"evaluation"},
     *      description="Delete evaluation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of evaluation",
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
        /** @var evaluation $evaluation */
        $evaluation = $this->evaluationRepository->find($id, \request()->get('relations'));

        if (empty($evaluation)) {
            return $this->sendError('evaluation not found');
        }

        $evaluation->delete();

        return $this->sendResponse($id, 'evaluation deleted successfully');
    }
}
