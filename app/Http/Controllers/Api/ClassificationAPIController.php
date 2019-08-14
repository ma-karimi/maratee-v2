<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateClassificationAPIRequest;
use App\Http\Requests\Api\UpdateClassificationAPIRequest;
use App\Models\Classification;
use App\Repositories\ClassificationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ClassificationController
 * @package App\Http\Controllers\Api
 */

class ClassificationAPIController extends AppBaseController
{
    /** @var  ClassificationRepository */
    private $classificationRepository;

    public function __construct(ClassificationRepository $classificationRepo)
    {
        $this->classificationRepository = $classificationRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/classifications",
     *      summary="Get a listing of the Classifications.",
     *      tags={"Classification"},
     *      description="Get all Classifications",
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
     *                  @SWG\Items(ref="#/definitions/Classification")
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
        $classifications = $this->classificationRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($classifications->toArray(), 'Classifications retrieved successfully');
    }

    /**
     * @param CreateClassificationAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/classifications",
     *      summary="Store a newly created Classification in storage",
     *      tags={"Classification"},
     *      description="Store Classification",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="flowering_id",
     *          in="body",
     *          description="Classification that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Classification")
     *      ),
     *      @SWG\Parameter(
     *          name="cotyledon_id",
     *          in="body",
     *          description="Classification that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Classification")
     *      ),
     *      @SWG\Parameter(
     *          name="sperm_id",
     *          in="body",
     *          description="Classification that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Classification")
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
     *                  ref="#/definitions/Classification"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateClassificationAPIRequest $request)
    {
        $input = $request->all();

        $classification = $this->classificationRepository->create($input);

        return $this->sendResponse($classification->toArray(), 'Classification saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/classifications/{id}",
     *      summary="Display the specified Classification",
     *      tags={"Classification"},
     *      description="Get Classification",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Classification",
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
     *                  ref="#/definitions/Classification"
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
        /** @var Classification $classification */
        $classification = $this->classificationRepository->find($id);

        if ($classification === null) {
            return $this->sendError('Classification not found');
        }

        return $this->sendResponse($classification->toArray(), 'Classification retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateClassificationAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/classifications/{id}",
     *      summary="Update the specified Classification in storage",
     *      tags={"Classification"},
     *      description="Update Classification",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Classification",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="flowering_id",
     *          in="body",
     *          description="Classification that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Classification")
     *      ),
     *      @SWG\Parameter(
     *          name="cotyledon_id",
     *          in="body",
     *          description="Classification that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Classification")
     *      ),
     *      @SWG\Parameter(
     *          name="sperm_id",
     *          in="body",
     *          description="Classification that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Classification")
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
     *                  ref="#/definitions/Classification"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateClassificationAPIRequest $request)
    {
        $input = $request->all();

        /** @var Classification $classification */
        $classification = $this->classificationRepository->find($id);

        if ($classification === null) {
            return $this->sendError('Classification not found');
        }

        $classification = $this->classificationRepository->update($input, $id);

        return $this->sendResponse($classification->toArray(), 'Classification updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/classifications/{id}",
     *      summary="Remove the specified Classification from storage",
     *      tags={"Classification"},
     *      description="Delete Classification",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Classification",
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
        /** @var Classification $classification */
        $classification = $this->classificationRepository->find($id);

        if ($classification === null) {
            return $this->sendError('Classification not found');
        }

        $classification->delete();

        return $this->sendResponse($id, 'Classification deleted successfully');
    }
}
