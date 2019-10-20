<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateMolecularEvaluationAPIRequest;
use App\Http\Requests\Api\UpdateMolecularEvaluationAPIRequest;
use App\Models\MolecularEvaluation;
use App\Repositories\MolecularEvaluationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class MolecularEvaluationController
 * @package App\Http\Controllers\Api
 */

class MolecularEvaluationAPIController extends AppBaseController
{
    /** @var  MolecularEvaluationRepository */
    private $molecularEvaluationRepository;

    public function __construct(MolecularEvaluationRepository $molecularEvaluationRepo)
    {
        $this->molecularEvaluationRepository = $molecularEvaluationRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/molecularEvaluations",
     *      summary="Get a listing of the MolecularEvaluations.",
     *      tags={"MolecularEvaluation"},
     *      description="Get all MolecularEvaluations",
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
     *                  @SWG\Items(ref="#/definitions/MolecularEvaluation")
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
        $molecularEvaluations = $this->molecularEvaluationRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($molecularEvaluations->toArray(), 'Molecular Evaluations retrieved successfully');
    }

    /**
     * @param CreateMolecularEvaluationAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/molecularEvaluations",
     *      summary="Store a newly created MolecularEvaluation in storage",
     *      tags={"MolecularEvaluation"},
     *      description="Store MolecularEvaluation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="seed_id",
     *          in="body",
     *          description="MolecularEvaluation that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/MolecularEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="specimen_type_collect_id",
     *          in="body",
     *          description="MolecularEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MolecularEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="treat",
     *          in="body",
     *          description="MolecularEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MolecularEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="repeat",
     *          in="body",
     *          description="MolecularEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MolecularEvaluation")
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
     *                  ref="#/definitions/MolecularEvaluation"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateMolecularEvaluationAPIRequest $request)
    {
        $input = $request->all();

        $molecularEvaluation = $this->molecularEvaluationRepository->create($input);

        return $this->sendResponse($molecularEvaluation->toArray(), 'Molecular Evaluation saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/molecularEvaluations/{id}",
     *      summary="Display the specified MolecularEvaluation",
     *      tags={"MolecularEvaluation"},
     *      description="Get MolecularEvaluation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MolecularEvaluation",
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
     *                  ref="#/definitions/MolecularEvaluation"
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
        /** @var MolecularEvaluation $molecularEvaluation */
        $molecularEvaluation = $this->molecularEvaluationRepository->find($id);

        if (empty($molecularEvaluation)) {
            return $this->sendError('Molecular Evaluation not found');
        }

        return $this->sendResponse($molecularEvaluation->toArray(), 'Molecular Evaluation retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateMolecularEvaluationAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/molecularEvaluations/{id}",
     *      summary="Update the specified MolecularEvaluation in storage",
     *      tags={"MolecularEvaluation"},
     *      description="Update MolecularEvaluation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MolecularEvaluation",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="seed_id",
     *          in="body",
     *          description="MolecularEvaluation that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/MolecularEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="specimen_type_collect_id",
     *          in="body",
     *          description="MolecularEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MolecularEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="treat",
     *          in="body",
     *          description="MolecularEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MolecularEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="repeat",
     *          in="body",
     *          description="MolecularEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MolecularEvaluation")
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
     *                  ref="#/definitions/MolecularEvaluation"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateMolecularEvaluationAPIRequest $request)
    {
        $input = $request->all();

        /** @var MolecularEvaluation $molecularEvaluation */
        $molecularEvaluation = $this->molecularEvaluationRepository->find($id);

        if (empty($molecularEvaluation)) {
            return $this->sendError('Molecular Evaluation not found');
        }

        $molecularEvaluation = $this->molecularEvaluationRepository->update($input, $id);

        return $this->sendResponse($molecularEvaluation->toArray(), 'MolecularEvaluation updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/molecularEvaluations/{id}",
     *      summary="Remove the specified MolecularEvaluation from storage",
     *      tags={"MolecularEvaluation"},
     *      description="Delete MolecularEvaluation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MolecularEvaluation",
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
        /** @var MolecularEvaluation $molecularEvaluation */
        $molecularEvaluation = $this->molecularEvaluationRepository->find($id);

        if (empty($molecularEvaluation)) {
            return $this->sendError('Molecular Evaluation not found');
        }

        $molecularEvaluation->delete();

        return $this->sendResponse($id, 'Molecular Evaluation deleted successfully');
    }
}
