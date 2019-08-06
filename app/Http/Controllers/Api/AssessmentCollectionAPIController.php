<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateAssessmentCollectionAPIRequest;
use App\Http\Requests\Api\UpdateAssessmentCollectionAPIRequest;
use App\Models\AssessmentCollection;
use App\Repositories\AssessmentCollectionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class AssessmentCollectionController
 * @package App\Http\Controllers\Api
 */

class AssessmentCollectionAPIController extends AppBaseController
{
    /** @var  AssessmentCollectionRepository */
    private $assessmentCollectionRepository;

    public function __construct(AssessmentCollectionRepository $assessmentCollectionRepo)
    {
        $this->assessmentCollectionRepository = $assessmentCollectionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/assessment_collections",
     *      summary="Get a listing of the AssessmentCollections.",
     *      tags={"AssessmentCollection"},
     *      description="Get all AssessmentCollections",
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
     *                  @SWG\Items(ref="#/definitions/AssessmentCollection")
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
        $assessmentCollections = $this->assessmentCollectionRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($assessmentCollections->toArray(), 'Assessment Collections retrieved successfully');
    }

    /**
     * @param CreateAssessmentCollectionAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/assessment_collections",
     *      summary="Store a newly created AssessmentCollection in storage",
     *      tags={"AssessmentCollection"},
     *      description="Store AssessmentCollection",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="collection_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/AssessmentCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="assessment_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/AssessmentCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="seed_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/AssessmentCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="department_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/AssessmentCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="project_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/AssessmentCollection")
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
     *                  ref="#/definitions/AssessmentCollection"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateAssessmentCollectionAPIRequest $request)
    {
        $input = $request->all();

        $assessmentCollection = $this->assessmentCollectionRepository->create($input);

        return $this->sendResponse($assessmentCollection->toArray(), 'Assessment Collection saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/assessment_collections/{id}",
     *      summary="Display the specified AssessmentCollection",
     *      tags={"AssessmentCollection"},
     *      description="Get AssessmentCollection",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of AssessmentCollection",
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
     *                  ref="#/definitions/AssessmentCollection"
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
        /** @var AssessmentCollection $assessmentCollection */
        $assessmentCollection = $this->assessmentCollectionRepository->find($id, \request()->get('relations'));

        if ($assessmentCollection === null) {
            return $this->sendError('Assessment Collection not found');
        }

        return $this->sendResponse($assessmentCollection->toArray(), 'Assessment Collection retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateAssessmentCollectionAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/assessment_collections/{id}",
     *      summary="Update the specified AssessmentCollection in storage",
     *      tags={"AssessmentCollection"},
     *      description="Update AssessmentCollection",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of AssessmentCollection",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="collection_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/AssessmentCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="assessment_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/AssessmentCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="seed_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/AssessmentCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="department_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/AssessmentCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="project_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/AssessmentCollection")
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
     *                  ref="#/definitions/AssessmentCollection"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateAssessmentCollectionAPIRequest $request)
    {
        $input = $request->all();

        /** @var AssessmentCollection $assessmentCollection */
        $assessmentCollection = $this->assessmentCollectionRepository->find($id, \request()->get('relations'));

        if ($assessmentCollection === null) {
            return $this->sendError('Assessment Collection not found');
        }

        $assessmentCollection = $this->assessmentCollectionRepository->update($input, $id);

        return $this->sendResponse($assessmentCollection->toArray(), 'AssessmentCollection updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/assessment_collections/{id}",
     *      summary="Remove the specified AssessmentCollection from storage",
     *      tags={"AssessmentCollection"},
     *      description="Delete AssessmentCollection",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of AssessmentCollection",
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
        /** @var AssessmentCollection $assessmentCollection */
        $assessmentCollection = $this->assessmentCollectionRepository->find($id, \request()->get('relations'));

        if ($assessmentCollection === null) {
            return $this->sendError('Assessment Collection not found');
        }

        $assessmentCollection->delete();

        return $this->sendResponse($id, 'Assessment Collection deleted successfully');
    }
}
