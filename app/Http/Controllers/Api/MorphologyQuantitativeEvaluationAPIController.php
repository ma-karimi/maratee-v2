<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\MorphologyQuantitativeEvaluationAPIRequest;
use App\Models\MorphologyQuantitativeEvaluation;
use App\Repositories\MorphologyQuantitativeEvaluationRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Response;

/**
 * Class MorphologyQuantitativeEvaluationController
 * @package App\Http\Controllers\Api
 */
class MorphologyQuantitativeEvaluationAPIController extends AppBaseController
{
    /** @var  MorphologyQuantitativeEvaluationRepository */
    private $morphologyQuantitativeEvaluationRepository;

    public function __construct(MorphologyQuantitativeEvaluationRepository $morphologyQuantitativeEvaluationRepo)
    {
        $this->morphologyQuantitativeEvaluationRepository = $morphologyQuantitativeEvaluationRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/morphology/quantitative_evaluations",
     *      summary="Get a listing of the MorphologyQuantitativeEvaluations.",
     *      tags={"MorphologyQuantitativeEvaluation"},
     *      description="Get all MorphologyQuantitativeEvaluations",
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
     *                  @SWG\Items(ref="#/definitions/MorphologyQuantitativeEvaluation")
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
        $morphologyQuantitativeEvaluations = $this->morphologyQuantitativeEvaluationRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($morphologyQuantitativeEvaluations->toArray(), 'Morphology Quantitative Evaluations retrieved successfully');
    }

    /**
     * @param MorphologyQuantitativeEvaluationAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/morphology/quantitative_evaluations",
     *      summary="Store a newly created MorphologyQuantitativeEvaluation in storage",
     *      tags={"MorphologyQuantitativeEvaluation"},
     *      description="Store MorphologyQuantitativeEvaluation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="seed_id",
     *          in="body",
     *          description="MorphologyQuantitativeEvaluation that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/MorphologyQuantitativeEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="collect_id",
     *          in="body",
     *          description="MorphologyQuantitativeEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MorphologyQuantitativeEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="voucher_no",
     *          in="body",
     *          description="MorphologyQuantitativeEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MorphologyQuantitativeEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="taxonomy_id",
     *          in="body",
     *          description="MorphologyQuantitativeEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MorphologyQuantitativeEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="station_id",
     *          in="body",
     *          description="MorphologyQuantitativeEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MorphologyQuantitativeEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="replication_or_block_number",
     *          in="body",
     *          description="MorphologyQuantitativeEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MorphologyQuantitativeEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="plant_density",
     *          in="body",
     *          description="MorphologyQuantitativeEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MorphologyQuantitativeEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="observation",
     *          in="body",
     *          description="MorphologyQuantitativeEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MorphologyQuantitativeEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="planting_date",
     *          in="body",
     *          description="MorphologyQuantitativeEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MorphologyQuantitativeEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="date_of_observation",
     *          in="body",
     *          description="MorphologyQuantitativeEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MorphologyQuantitativeEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="days_of_start_flowering",
     *          in="body",
     *          description="MorphologyQuantitativeEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MorphologyQuantitativeEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="days_to_flowering",
     *          in="body",
     *          description="MorphologyQuantitativeEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MorphologyQuantitativeEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="days_to_seed_ripening",
     *          in="body",
     *          description="MorphologyQuantitativeEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MorphologyQuantitativeEvaluation")
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
     *                  ref="#/definitions/MorphologyQuantitativeEvaluation"
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
    public function store(MorphologyQuantitativeEvaluationAPIRequest $request)
    {
        $input = $request->all();

        $morphologyQuantitativeEvaluation = $this->morphologyQuantitativeEvaluationRepository->create($input);

        return $this->sendResponse($morphologyQuantitativeEvaluation->toArray(), 'Morphology Quantitative Evaluation saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/morphology/quantitative_evaluations/{id}",
     *      summary="Display the specified MorphologyQuantitativeEvaluation",
     *      tags={"MorphologyQuantitativeEvaluation"},
     *      description="Get MorphologyQuantitativeEvaluation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MorphologyQuantitativeEvaluation",
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
     *                  ref="#/definitions/MorphologyQuantitativeEvaluation"
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
        /** @var MorphologyQuantitativeEvaluation $morphologyQuantitativeEvaluation */
        $morphologyQuantitativeEvaluation = $this->morphologyQuantitativeEvaluationRepository->find($id);

        if (empty($morphologyQuantitativeEvaluation)) {
            return $this->sendError('Morphology Quantitative Evaluation not found');
        }

        return $this->sendResponse($morphologyQuantitativeEvaluation->toArray(), 'Morphology Quantitative Evaluation retrieved successfully');
    }

    /**
     * @param int $id
     * @param MorphologyQuantitativeEvaluationAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/morphology/quantitative_evaluations/{id}",
     *      summary="Update the specified MorphologyQuantitativeEvaluation in storage",
     *      tags={"MorphologyQuantitativeEvaluation"},
     *      description="Update MorphologyQuantitativeEvaluation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MorphologyQuantitativeEvaluation",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="seed_id",
     *          in="body",
     *          description="MorphologyQuantitativeEvaluation that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/MorphologyQuantitativeEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="collect_id",
     *          in="body",
     *          description="MorphologyQuantitativeEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MorphologyQuantitativeEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="voucher_no",
     *          in="body",
     *          description="MorphologyQuantitativeEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MorphologyQuantitativeEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="taxonomy_id",
     *          in="body",
     *          description="MorphologyQuantitativeEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MorphologyQuantitativeEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="station_id",
     *          in="body",
     *          description="MorphologyQuantitativeEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MorphologyQuantitativeEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="replication_or_block_number",
     *          in="body",
     *          description="MorphologyQuantitativeEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MorphologyQuantitativeEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="plant_density",
     *          in="body",
     *          description="MorphologyQuantitativeEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MorphologyQuantitativeEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="observation",
     *          in="body",
     *          description="MorphologyQuantitativeEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MorphologyQuantitativeEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="planting_date",
     *          in="body",
     *          description="MorphologyQuantitativeEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MorphologyQuantitativeEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="date_of_observation",
     *          in="body",
     *          description="MorphologyQuantitativeEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MorphologyQuantitativeEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="days_of_start_flowering",
     *          in="body",
     *          description="MorphologyQuantitativeEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MorphologyQuantitativeEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="days_to_flowering",
     *          in="body",
     *          description="MorphologyQuantitativeEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MorphologyQuantitativeEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="days_to_seed_ripening",
     *          in="body",
     *          description="MorphologyQuantitativeEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MorphologyQuantitativeEvaluation")
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
     *                  ref="#/definitions/MorphologyQuantitativeEvaluation"
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
    public function update($id, MorphologyQuantitativeEvaluationAPIRequest $request)
    {
        $input = $request->all();

        /** @var MorphologyQuantitativeEvaluation $morphologyQuantitativeEvaluation */
        $morphologyQuantitativeEvaluation = $this->morphologyQuantitativeEvaluationRepository->find($id);

        if (empty($morphologyQuantitativeEvaluation)) {
            return $this->sendError('Morphology Quantitative Evaluation not found');
        }

        $morphologyQuantitativeEvaluation = $this->morphologyQuantitativeEvaluationRepository->update($input, $id);

        return $this->sendResponse($morphologyQuantitativeEvaluation->toArray(), 'MorphologyQuantitativeEvaluation updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/morphology/quantitative_evaluations/{id}",
     *      summary="Remove the specified MorphologyQuantitativeEvaluation from storage",
     *      tags={"MorphologyQuantitativeEvaluation"},
     *      description="Delete MorphologyQuantitativeEvaluation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MorphologyQuantitativeEvaluation",
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
        /** @var MorphologyQuantitativeEvaluation $morphologyQuantitativeEvaluation */
        $morphologyQuantitativeEvaluation = $this->morphologyQuantitativeEvaluationRepository->find($id);

        if (empty($morphologyQuantitativeEvaluation)) {
            return $this->sendError('Morphology Quantitative Evaluation not found');
        }

        $morphologyQuantitativeEvaluation->delete();

        return $this->sendResponse($id, 'Morphology Quantitative Evaluation deleted successfully');
    }
}
