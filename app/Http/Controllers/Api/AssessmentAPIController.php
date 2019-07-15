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
     *          name="body",
     *          in="body",
     *          description="Assessment that should be stored",
     *          required=false,
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
     *          name="body",
     *          in="body",
     *          description="Assessment that should be updated",
     *          required=false,
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
