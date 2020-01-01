<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\Seed\SeedEvaluationGerminationAPIRequest;
use App\Http\Requests\Api\Seed\SeedEvaluationLengthAPIRequest;
use App\Http\Requests\Api\Seed\SeedEvaluationAPIRequest;
use App\Models\SeedEvaluation;
use App\Repositories\SeedEvaluationRepository;
use Exception;
use Illuminate\Http\Request;
use Response;

/**
 * Class SeedEvaluationAPIController
 * @package App\Http\Controllers\Api
 */
class SeedEvaluationAPIController extends AppBaseController
{
    /** @var  SeedEvaluationRepository */
    private $seedEvaluationRepository;

    public function __construct(SeedEvaluationRepository $seedEvaluationRepo)
    {
        $this->seedEvaluationRepository = $seedEvaluationRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/seed_evaluatios",
     *      summary="Get a listing of the Seed_evaluatios.",
     *      tags={"SeedEvaluation"},
     *      description="Get all Seed_evaluatios",
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
     *                  @SWG\Items(ref="#/definitions/SeedEvaluation")
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
        $seed_evaluatios = $this->seedEvaluationRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $this->getRelationField()
        );

        return $this->sendResponse($seed_evaluatios->toArray(), 'Seed Evaluations retrieved successfully');
    }

    private function getRelationField()
    {
        return ['organization.city', 'organization:id,name_en,city_id', 'seedCollection:id,accession_code', 'project', 'shoots', 'radicals', 'lengths', 'widths','germinations',  'media', 'dormancyBreaking', 'specimenType'];
    }

    /**
     * @param SeedEvaluationAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/seed_evaluatios",
     *      summary="Store a newly created SeedEvaluation in storage",
     *      tags={"SeedEvaluation"},
     *      description="Store SeedEvaluation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="seed_collection_id",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="regeneration_code",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="organization_email",
     *          in="body",
     *          description="SeedExchange that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedExchange")
     *      ),
     *      @SWG\Parameter(
     *          name="organization_phone",
     *          in="body",
     *          description="SeedExchange that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedExchange")
     *      ),
     *      @SWG\Parameter(
     *          name="organization_fax",
     *          in="body",
     *          description="SeedExchange that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedExchange")
     *      ),
     *      @SWG\Parameter(
     *          name="organization_id",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="number_of_exchanged_seeds",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="describe_dormancy_treatment",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
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
     *                  ref="#/definitions/SeedEvaluation"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(SeedEvaluationAPIRequest $request)
    {
        $input = $request->all();

        $seedCollection = $this->seedEvaluationRepository->create($input);

        return $this->sendResponse($seedCollection->toArray(), 'Seed Evaluation saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/seed_evaluatios/{id}",
     *      summary="Display the specified SeedEvaluation",
     *      tags={"SeedEvaluation"},
     *      description="Get SeedEvaluation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedEvaluation",
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
     *                  ref="#/definitions/SeedEvaluation"
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
        /** @var SeedEvaluation $seedCollection */
        $seedCollection = $this->seedEvaluationRepository->find($id, $this->getRelationField());

        if (empty($seedCollection)) {
            return $this->sendError('Seed Evaluation not found');
        }

        return $this->sendResponse($seedCollection->toArray(), 'Seed Evaluation retrieved successfully');
    }

    /**
     * @param int $id
     * @param SeedEvaluationAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/seed_evaluatios/{id}",
     *      summary="Update the specified SeedEvaluation in storage",
     *      tags={"SeedEvaluation"},
     *      description="Update SeedEvaluation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedEvaluation",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="organization_email",
     *          in="body",
     *          description="SeedExchange that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedExchange")
     *      ),
     *      @SWG\Parameter(
     *          name="organization_phone",
     *          in="body",
     *          description="SeedExchange that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedExchange")
     *      ),
     *      @SWG\Parameter(
     *          name="organization_fax",
     *          in="body",
     *          description="SeedExchange that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedExchange")
     *      ),
     *      @SWG\Parameter(
     *          name="seed_collection_id",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="regeneration_code",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="organization_id",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="number_of_exchanged_seeds",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="describe_dormancy_treatment",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
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
     *                  ref="#/definitions/SeedEvaluation"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update($id, SeedEvaluationAPIRequest $request)
    {
        $input = $request->all();

        /** @var SeedEvaluation $seedCollection */
        $seedCollection = $this->seedEvaluationRepository->find($id);

        if (empty($seedCollection)) {
            return $this->sendError('Seed Evaluation not found');
        }

        $seedCollection = $this->seedEvaluationRepository->update($input, $id);

        return $this->sendResponse($seedCollection->toArray(), 'SeedEvaluation updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *     * @SWG\Delete(
     *      path="/seed_evaluatios/{id}",
     *      summary="Remove the specified SeedEvaluation from storage",
     *      tags={"SeedEvaluation"},
     *      description="Delete SeedEvaluation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedEvaluation",
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
        /** @var SeedEvaluation $seedCollection */
        $seedCollection = $this->seedEvaluationRepository->find($id);

        if (empty($seedCollection)) {
            return $this->sendError('Seed Evaluation not found');
        }

        $seedCollection->delete();

        return $this->sendResponse($id, 'Seed Evaluation deleted successfully');
    }

    /**
     * @param int $id
     * @param SeedEvaluationGerminationAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/seed_evaluatios/{id}/plant",
     *      summary="Update the specified SeedEvaluation in storage",
     *      tags={"SeedEvaluation"},
     *      description="Update SeedEvaluation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedEvaluation",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="light_hr",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="light_c",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="dark_hr",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="dark_c",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="started_test",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="started_germination",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="repeat",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="planted_seeds",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="dormancy_termination",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="germination_period",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="fresh_non_germinated",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="rotten_seed",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="abnormal",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="seedling_mortality",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="germination",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="viability",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="mean_fresh_seedling_weight",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="mean_dry_seedling_weight",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="dry_matter",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="dormancy_breaking_id",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="germinations",
     *          in="body",
     *          description="[count, germinated_number]",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
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
     *                  ref="#/definitions/SeedEvaluation"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storeGermination($id, SeedEvaluationGerminationAPIRequest $request)
    {
        $input = $request->all();

        /** @var SeedEvaluation $seedCollection */
        $seedCollection = $this->seedEvaluationRepository->find($id);

        if (empty($seedCollection)) {
            return $this->sendError('Seed Evaluation not found');
        }

        $seedCollection = $this->seedEvaluationRepository->storeGerminations($input, $seedCollection);

        return $this->sendResponse($seedCollection->toArray(), 'SeedEvaluation updated successfully');
    }

    /**
     * @param int $id
     * @param SeedEvaluationLengthAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/seed_evaluatios/{id}/soil",
     *      summary="Update the specified SeedEvaluation in storage",
     *      tags={"SeedEvaluation"},
     *      description="Update SeedEvaluation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedEvaluation",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="shoots",
     *          in="body",
     *          description="[type_id, value]",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
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
     *                  ref="#/definitions/SeedEvaluation"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storeShoot($id, SeedEvaluationLengthAPIRequest $request)
    {
        $input = $request->all();

        /** @var SeedEvaluation $seedCollection */
        $seedCollection = $this->seedEvaluationRepository->find($id);

        if (empty($seedCollection)) {
            return $this->sendError('Seed Evaluation not found');
        }

        $this->seedEvaluationRepository->storeShoots($input, $seedCollection);

        return $this->sendResponse([], 'SeedEvaluation updated successfully');
    }

    /**
     * @param int $id
     * @param SeedEvaluationLengthAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/seed_evaluatios/{id}/climate",
     *      summary="Update the specified SeedEvaluation in storage",
     *      tags={"SeedEvaluation"},
     *      description="Update SeedEvaluation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedEvaluation",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="widths",
     *          in="body",
     *          description="[type_id, value]",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
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
     *                  ref="#/definitions/SeedEvaluation"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storeWidth($id, SeedEvaluationLengthAPIRequest $request)
    {
        $input = $request->all();

        /** @var SeedEvaluation $seedCollection */
        $seedCollection = $this->seedEvaluationRepository->find($id);

        if (empty($seedCollection)) {
            return $this->sendError('Seed Evaluation not found');
        }

        $this->seedEvaluationRepository->storeWidths($input, $seedCollection);

        return $this->sendResponse([], 'SeedEvaluation updated successfully');
    }

    /**
     * @param int $id
     * @param SeedEvaluationLengthAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/seed_evaluatios/{id}/climate",
     *      summary="Update the specified SeedEvaluation in storage",
     *      tags={"SeedEvaluation"},
     *      description="Update SeedEvaluation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedEvaluation",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="lengths",
     *          in="body",
     *          description="[type_id, value]",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
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
     *                  ref="#/definitions/SeedEvaluation"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function storeLength($id, SeedEvaluationLengthAPIRequest $request)
    {
        $input = $request->all();

        /** @var SeedEvaluation $seedCollection */
        $seedCollection = $this->seedEvaluationRepository->find($id);

        if (empty($seedCollection)) {
            return $this->sendError('Seed Evaluation not found');
        }

        $this->seedEvaluationRepository->storeLengths($input, $seedCollection);

        return $this->sendResponse([], 'SeedEvaluation updated successfully');
    }
    /**
     * @param int $id
     * @param SeedEvaluationLengthAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/seed_evaluatios/{id}/climate",
     *      summary="Update the specified SeedEvaluation in storage",
     *      tags={"SeedEvaluation"},
     *      description="Update SeedEvaluation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedEvaluation",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="radicals",
     *          in="body",
     *          description="[type_id, value]",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
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
     *                  ref="#/definitions/SeedEvaluation"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function storeRadical($id, SeedEvaluationLengthAPIRequest $request)
    {
        $input = $request->all();

        /** @var SeedEvaluation $seedCollection */
        $seedCollection = $this->seedEvaluationRepository->find($id);

        if (empty($seedCollection)) {
            return $this->sendError('Seed Evaluation not found');
        }

        $this->seedEvaluationRepository->storeRadicals($input, $seedCollection);

        return $this->sendResponse([], 'SeedEvaluation updated successfully');
    }

    public function storeMedia($id, Request $request)
    {
        $input = $request->all();

        /** @var SeedEvaluation $seedCollection */
        $seedCollection = $this->seedEvaluationRepository->find($id);

        if (empty($seedCollection)) {
            return $this->sendError('Seed Evaluation not found');
        }

        $this->seedEvaluationRepository->storeMedia($input, $seedCollection);

        return $this->sendResponse([], 'SeedEvaluation updated successfully');
    }
}
