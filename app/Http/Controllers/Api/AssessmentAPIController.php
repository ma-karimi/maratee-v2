<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateAssessmentAPIRequest;
use App\Http\Requests\Api\UpdateAssessmentAPIRequest;
use App\Models\Assessment;
use App\Repositories\AssessmentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class AssessmentController
 * @package App\Http\Controllers\Api
 */

class AssessmentAPIController extends AppBaseController
{
    /** @var  AssessmentRepository */
    private $assessmentRepository;

    public function __construct(AssessmentRepository $assessmentRepo)
    {
        $this->assessmentRepository = $assessmentRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/assessments",
     *      summary="Get a listing of the Assessments.",
     *      tags={"Assessment"},
     *      description="Get all Assessments",
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
     *                  @SWG\Items(ref="#/definitions/Assessment")
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
        $assessments = $this->assessmentRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($assessments->toArray(), 'Assessments retrieved successfully');
    }

    /**
     * @param CreateAssessmentAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/assessments",
     *      summary="Store a newly created Assessment in storage",
     *      tags={"Assessment"},
     *      description="Store Assessment",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="date",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="seed_qt",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="purity",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="hollow",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="repeat",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="treatment",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="abnormality",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="hard_seed",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="vigor",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="losses",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="sprout",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="sprout_rate",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="sprout_index",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="vigor_index",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="root_length",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="stem_length",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="seedling_length",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="root_stem_rate",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="wet_unit_weight",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="dry_unit_weight",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="dry_material_rate",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="seed_length",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="seed_width",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="weight_k",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Assessment")
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
     *                  ref="#/definitions/Assessment"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateAssessmentAPIRequest $request)
    {
        $input = $request->all();

        $assessment = $this->assessmentRepository->create($input);

        return $this->sendResponse($assessment->toArray(), 'Assessment saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/assessments/{id}",
     *      summary="Display the specified Assessment",
     *      tags={"Assessment"},
     *      description="Get Assessment",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Assessment",
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
     *                  ref="#/definitions/Assessment"
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
        /** @var Assessment $assessment */
        $assessment = $this->assessmentRepository->find($id);

        if (empty($assessment)) {
            return $this->sendError('Assessment not found');
        }

        return $this->sendResponse($assessment->toArray(), 'Assessment retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateAssessmentAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/assessments/{id}",
     *      summary="Update the specified Assessment in storage",
     *      tags={"Assessment"},
     *      description="Update Assessment",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Assessment",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="date",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="seed_qt",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="purity",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="hollow",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="repeat",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="treatment",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="abnormality",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="hard_seed",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="vigor",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="losses",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="sprout",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="sprout_rate",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="sprout_index",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="vigor_index",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="root_length",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="stem_length",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="seedling_length",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="root_stem_rate",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="wet_unit_weight",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="dry_unit_weight",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="dry_material_rate",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="seed_length",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="seed_width",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Assessment")
     *      ),
     *      @SWG\Parameter(
     *          name="weight_k",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Assessment")
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
     *                  ref="#/definitions/Assessment"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateAssessmentAPIRequest $request)
    {
        $input = $request->all();

        /** @var Assessment $assessment */
        $assessment = $this->assessmentRepository->find($id);

        if (empty($assessment)) {
            return $this->sendError('Assessment not found');
        }

        $assessment = $this->assessmentRepository->update($input, $id);

        return $this->sendResponse($assessment->toArray(), 'Assessment updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/assessments/{id}",
     *      summary="Remove the specified Assessment from storage",
     *      tags={"Assessment"},
     *      description="Delete Assessment",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Assessment",
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
        /** @var Assessment $assessment */
        $assessment = $this->assessmentRepository->find($id);

        if (empty($assessment)) {
            return $this->sendError('Assessment not found');
        }

        $assessment->delete();

        return $this->sendResponse($id, 'Assessment deleted successfully');
    }
}
