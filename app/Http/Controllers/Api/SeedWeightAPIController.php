<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\SeedWeightAPIRequest;
use App\Models\SeedWeight;
use App\Repositories\SeedWeightRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Response;

/**
 * Class SeedWeightController
 * @package App\Http\Controllers\Api
 */
class SeedWeightAPIController extends AppBaseController
{
    /** @var  SeedWeightRepository */
    private $seedWeightRepository;

    public function __construct(SeedWeightRepository $seedWeightRepo)
    {
        $this->seedWeightRepository = $seedWeightRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/seed_weights",
     *      summary="Get a listing of the SeedWeights.",
     *      tags={"SeedWeight"},
     *      description="Get all SeedWeights",
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
     *                  @SWG\Items(ref="#/definitions/SeedWeight")
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
        $seedWeights = $this->seedWeightRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $this->getRelationFields()
        );

        return $this->sendResponse($seedWeights->toArray(), 'Seed Weights retrieved successfully');
    }

    private function getRelationFields()
    {
        return ['seedCollection:id,accession_code', 'refrigerator', 'collection'];
    }

    /**
     * @param SeedWeightAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/seed_weights",
     *      summary="Store a newly created SeedWeight in storage",
     *      tags={"SeedWeight"},
     *      description="Store SeedWeight",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="seed_collection_id",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="collection_id",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="refrigerator_id",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="regeneration_code",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="row",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="column",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="humidity",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="purity",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="number_seeds_per_fruit",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="range_seeds_per_fruit",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="thousand_fruits_weight",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="thousand_seeds_weight",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="total_fruit_weight",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="total_seed_weight",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="banked",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="collected_seeds_no",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=true,
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
     *                  ref="#/definitions/SeedWeight"
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
    public function store(SeedWeightAPIRequest $request)
    {
        $input = $request->all();

        $seedWeight = $this->seedWeightRepository->create($input);

        return $this->sendResponse($seedWeight->toArray(), 'Seed Weight saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/seed_weights/{id}",
     *      summary="Display the specified SeedWeight",
     *      tags={"SeedWeight"},
     *      description="Get SeedWeight",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedWeight",
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
     *                  ref="#/definitions/SeedWeight"
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
        /** @var SeedWeight $seedWeight */
        $seedWeight = $this->seedWeightRepository->find($id, $this->getRelationFields());

        if (empty($seedWeight)) {
            return $this->sendError('Seed Weight not found');
        }

        return $this->sendResponse($seedWeight->toArray(), 'Seed Weight retrieved successfully');
    }

    /**
     * @param int $id
     * @param SeedWeightAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/seed_weights/{id}",
     *      summary="Update the specified SeedWeight in storage",
     *      tags={"SeedWeight"},
     *      description="Update SeedWeight",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedWeight",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="seed_collection_id",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="collection_id",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="refrigerator_id",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="regeneration_code",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="row",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="column",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="humidity",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="purity",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="number_seeds_per_fruit",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="range_seeds_per_fruit",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="thousand_fruits_weight",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="thousand_seeds_weight",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="total_fruit_weight",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="total_seed_weight",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="banked",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedEvaluation")
     *      ),
     *      @SWG\Parameter(
     *          name="collected_seeds_no",
     *          in="body",
     *          description="SeedEvaluation that should be stored",
     *          required=true,
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
     *                  ref="#/definitions/SeedWeight"
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
    public function update($id, SeedWeightAPIRequest $request)
    {
        $input = $request->all();

        /** @var SeedWeight $seedWeight */
        $seedWeight = $this->seedWeightRepository->find($id, \request()->get('relations'));

        if (empty($seedWeight)) {
            return $this->sendError('Seed Weight not found');
        }

        $seedWeight = $this->seedWeightRepository->update($input, $id);

        return $this->sendResponse($seedWeight->toArray(), 'SeedWeight updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws Exception
     * @SWG\Delete(
     *      path="/seed_weights/{id}",
     *      summary="Remove the specified SeedWeight from storage",
     *      tags={"SeedWeight"},
     *      description="Delete SeedWeight",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedWeight",
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
        /** @var SeedWeight $seedWeight */
        $seedWeight = $this->seedWeightRepository->find($id, \request()->get('relations'));

        if (empty($seedWeight)) {
            return $this->sendError('Seed Weight not found');
        }

        $seedWeight->delete();

        return $this->sendResponse($id, 'Seed Weight deleted successfully');
    }
}
