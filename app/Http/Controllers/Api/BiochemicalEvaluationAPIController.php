<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateBiochemicalEvaluationAPIRequest;
use App\Http\Requests\Api\UpdateBiochemicalEvaluationAPIRequest;
use App\Models\BiochemicalEvaluation;
use App\Repositories\BiochemicalEvaluationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class BiochemicalEvaluationController
 * @package App\Http\Controllers\Api
 */

class BiochemicalEvaluationAPIController extends AppBaseController
{
    /** @var  BiochemicalEvaluationRepository */
    private $biochemicalEvaluationRepository;

    public function __construct(BiochemicalEvaluationRepository $biochemicalEvaluationRepo)
    {
        $this->biochemicalEvaluationRepository = $biochemicalEvaluationRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/biochemicalEvaluations",
     *      summary="Get a listing of the BiochemicalEvaluations.",
     *      tags={"BiochemicalEvaluation"},
     *      description="Get all BiochemicalEvaluations",
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
     *                  @SWG\Items(ref="#/definitions/BiochemicalEvaluation")
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
        $biochemicalEvaluations = $this->biochemicalEvaluationRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($biochemicalEvaluations->toArray(), 'Biochemical Evaluations retrieved successfully');
    }

    /**
     * @param CreateBiochemicalEvaluationAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/biochemicalEvaluations",
     *      summary="Store a newly created BiochemicalEvaluation in storage",
     *      tags={"BiochemicalEvaluation"},
     *      description="Store BiochemicalEvaluation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="organization_id",
     *          in="body",
     *          description="BiochemicalEvaluation that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BiochemicalEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="department_id",
     *          in="body",
     *          description="BiochemicalEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BiochemicalEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="project_id",
     *          in="body",
     *          description="BiochemicalEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BiochemicalEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="co_researcher_name",
     *          in="body",
     *          description="BiochemicalEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BiochemicalEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="specimen_type_coll_id",
     *          in="body",
     *          description="BiochemicalEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BiochemicalEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="accession_code",
     *          in="body",
     *          description="BiochemicalEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BiochemicalEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="regeneration_and_evaluation_code",
     *          in="body",
     *          description="BiochemicalEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BiochemicalEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="treat",
     *          in="body",
     *          description="BiochemicalEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BiochemicalEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="repeat",
     *          in="body",
     *          description="BiochemicalEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BiochemicalEvaluation")
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
     *                  ref="#/definitions/BiochemicalEvaluation"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateBiochemicalEvaluationAPIRequest $request)
    {
        $input = $request->all();

        $biochemicalEvaluation = $this->biochemicalEvaluationRepository->create($input);

        return $this->sendResponse($biochemicalEvaluation->toArray(), 'Biochemical Evaluation saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/biochemicalEvaluations/{id}",
     *      summary="Display the specified BiochemicalEvaluation",
     *      tags={"BiochemicalEvaluation"},
     *      description="Get BiochemicalEvaluation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BiochemicalEvaluation",
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
     *                  ref="#/definitions/BiochemicalEvaluation"
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
        /** @var BiochemicalEvaluation $biochemicalEvaluation */
        $biochemicalEvaluation = $this->biochemicalEvaluationRepository->find($id);

        if (empty($biochemicalEvaluation)) {
            return $this->sendError('Biochemical Evaluation not found');
        }

        return $this->sendResponse($biochemicalEvaluation->toArray(), 'Biochemical Evaluation retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateBiochemicalEvaluationAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/biochemicalEvaluations/{id}",
     *      summary="Update the specified BiochemicalEvaluation in storage",
     *      tags={"BiochemicalEvaluation"},
     *      description="Update BiochemicalEvaluation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BiochemicalEvaluation",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="organization_id",
     *          in="body",
     *          description="BiochemicalEvaluation that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BiochemicalEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="department_id",
     *          in="body",
     *          description="BiochemicalEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BiochemicalEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="project_id",
     *          in="body",
     *          description="BiochemicalEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BiochemicalEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="co_researcher_name",
     *          in="body",
     *          description="BiochemicalEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BiochemicalEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="specimen_type_coll_id",
     *          in="body",
     *          description="BiochemicalEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BiochemicalEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="accession_code",
     *          in="body",
     *          description="BiochemicalEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BiochemicalEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="regeneration_and_evaluation_code",
     *          in="body",
     *          description="BiochemicalEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BiochemicalEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="treat",
     *          in="body",
     *          description="BiochemicalEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BiochemicalEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="repeat",
     *          in="body",
     *          description="BiochemicalEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BiochemicalEvaluation")
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
     *                  ref="#/definitions/BiochemicalEvaluation"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateBiochemicalEvaluationAPIRequest $request)
    {
        $input = $request->all();

        /** @var BiochemicalEvaluation $biochemicalEvaluation */
        $biochemicalEvaluation = $this->biochemicalEvaluationRepository->find($id);

        if (empty($biochemicalEvaluation)) {
            return $this->sendError('Biochemical Evaluation not found');
        }

        $biochemicalEvaluation = $this->biochemicalEvaluationRepository->update($input, $id);

        return $this->sendResponse($biochemicalEvaluation->toArray(), 'BiochemicalEvaluation updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/biochemicalEvaluations/{id}",
     *      summary="Remove the specified BiochemicalEvaluation from storage",
     *      tags={"BiochemicalEvaluation"},
     *      description="Delete BiochemicalEvaluation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BiochemicalEvaluation",
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
        /** @var BiochemicalEvaluation $biochemicalEvaluation */
        $biochemicalEvaluation = $this->biochemicalEvaluationRepository->find($id);

        if (empty($biochemicalEvaluation)) {
            return $this->sendError('Biochemical Evaluation not found');
        }

        $biochemicalEvaluation->delete();

        return $this->sendResponse($id, 'Biochemical Evaluation deleted successfully');
    }
}
