<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateEvaluationDimensionAPIRequest;
use App\Http\Requests\Api\UpdateEvaluationDimensionAPIRequest;
use App\Models\EvaluationDimension;
use App\Repositories\EvaluationDimensionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class EvaluationDimensionController
 * @package App\Http\Controllers\Api
 */

class EvaluationDimensionAPIController extends AppBaseController
{
    /** @var  EvaluationDimensionRepository */
    private $evaluationDimensionRepository;

    public function __construct(EvaluationDimensionRepository $evaluationDimensionRepo)
    {
        $this->evaluationDimensionRepository = $evaluationDimensionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/evaluationDimensions",
     *      summary="Get a listing of the EvaluationDimensions.",
     *      tags={"EvaluationDimension"},
     *      description="Get all EvaluationDimensions",
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
     *                  @SWG\Items(ref="#/definitions/EvaluationDimension")
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
        $evaluationDimensions = $this->evaluationDimensionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($evaluationDimensions->toArray(), 'Evaluation Dimensions retrieved successfully');
    }

    /**
     * @param CreateEvaluationDimensionAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/evaluationDimensions",
     *      summary="Store a newly created EvaluationDimension in storage",
     *      tags={"EvaluationDimension"},
     *      description="Store EvaluationDimension",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="evaluation_id",
     *          in="body",
     *          description="EvaluationDimension that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/EvaluationDimension")
     *      ),
     *      @SWG\Parameter(
     *          name="dimension_id",
     *          in="body",
     *          description="EvaluationDimension that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/EvaluationDimension")
     *      ),
     *      @SWG\Parameter(
     *          name="value",
     *          in="body",
     *          description="EvaluationDimension that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/EvaluationDimension")
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
     *                  ref="#/definitions/EvaluationDimension"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateEvaluationDimensionAPIRequest $request)
    {
        $input = $request->all();

        $evaluationDimension = $this->evaluationDimensionRepository->create($input);

        return $this->sendResponse($evaluationDimension->toArray(), 'Evaluation Dimension saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/evaluationDimensions/{id}",
     *      summary="Display the specified EvaluationDimension",
     *      tags={"EvaluationDimension"},
     *      description="Get EvaluationDimension",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of EvaluationDimension",
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
     *                  ref="#/definitions/EvaluationDimension"
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
        /** @var EvaluationDimension $evaluationDimension */
        $evaluationDimension = $this->evaluationDimensionRepository->find($id);

        if (empty($evaluationDimension)) {
            return $this->sendError('Evaluation Dimension not found');
        }

        return $this->sendResponse($evaluationDimension->toArray(), 'Evaluation Dimension retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateEvaluationDimensionAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/evaluationDimensions/{id}",
     *      summary="Update the specified EvaluationDimension in storage",
     *      tags={"EvaluationDimension"},
     *      description="Update EvaluationDimension",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of EvaluationDimension",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="evaluation_id",
     *          in="body",
     *          description="EvaluationDimension that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/EvaluationDimension")
     *      ),
     *      @SWG\Parameter(
     *          name="dimension_id",
     *          in="body",
     *          description="EvaluationDimension that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/EvaluationDimension")
     *      ),
     *      @SWG\Parameter(
     *          name="value",
     *          in="body",
     *          description="EvaluationDimension that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/EvaluationDimension")
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
     *                  ref="#/definitions/EvaluationDimension"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateEvaluationDimensionAPIRequest $request)
    {
        $input = $request->all();

        /** @var EvaluationDimension $evaluationDimension */
        $evaluationDimension = $this->evaluationDimensionRepository->find($id);

        if (empty($evaluationDimension)) {
            return $this->sendError('Evaluation Dimension not found');
        }

        $evaluationDimension = $this->evaluationDimensionRepository->update($input, $id);

        return $this->sendResponse($evaluationDimension->toArray(), 'EvaluationDimension updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/evaluationDimensions/{id}",
     *      summary="Remove the specified EvaluationDimension from storage",
     *      tags={"EvaluationDimension"},
     *      description="Delete EvaluationDimension",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of EvaluationDimension",
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
        /** @var EvaluationDimension $evaluationDimension */
        $evaluationDimension = $this->evaluationDimensionRepository->find($id);

        if (empty($evaluationDimension)) {
            return $this->sendError('Evaluation Dimension not found');
        }

        $evaluationDimension->delete();

        return $this->sendResponse($id, 'Evaluation Dimension deleted successfully');
    }
}
