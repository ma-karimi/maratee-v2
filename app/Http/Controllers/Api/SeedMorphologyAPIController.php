<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\MorphologyQualityAPIRequest;
use App\Http\Requests\Api\MorphologyQuantityAPIRequest;
use App\Http\Requests\Api\SeedMorphologyAPIRequest;
use App\Http\Requests\Api\SeedMorphologyFieldAPIRequest;
use App\Models\SeedMorphology;
use App\Repositories\SeedMorphologyRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Response;

/**
 * Class SeedMorphologyAPIController
 * @package App\Http\Controllers\Api
 */
class SeedMorphologyAPIController extends AppBaseController
{
    /** @var  SeedMorphologyRepository */
    private $seedMorphologyRepository;

    public function __construct(SeedMorphologyRepository $seedMorphologyRepo)
    {
        $this->seedMorphologyRepository = $seedMorphologyRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/seed_morphologies",
     *      summary="Get a listing of the SeedMorphologys.",
     *      tags={"SeedMorphology"},
     *      description="Get all SeedMorphologys",
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
     *                  @SWG\Items(ref="#/definitions/SeedMorphology")
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
        $seedMorphologys = $this->seedMorphologyRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $this->seedMorphologyRepository->getRelationFields()
        );

        return $this->sendResponse($seedMorphologys->toArray(), 'Seed Morphologys retrieved successfully');
    }

    /**
     * @param SeedMorphologyAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/seed_morphologies",
     *      summary="Store a newly created SeedMorphology in storage",
     *      tags={"SeedMorphology"},
     *      description="Store SeedMorphology",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="seed_collection_id",
     *          in="body",
     *          description="SeedMorphology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedMorphology")
     *      ),
     *      @SWG\Parameter(
     *          name="collection_id",
     *          in="body",
     *          description="SeedMorphology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedMorphology")
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
     *                  ref="#/definitions/SeedMorphology"
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
    public function store(SeedMorphologyAPIRequest $request)
    {
        $input = $request->all();

        $seedMorphology = $this->seedMorphologyRepository->create($input);

        return $this->sendResponse($seedMorphology->toArray(), 'Seed Morphology saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/seed_morphologies/{id}",
     *      summary="Display the specified SeedMorphology",
     *      tags={"SeedMorphology"},
     *      description="Get SeedMorphology",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedMorphology",
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
     *                  ref="#/definitions/SeedMorphology"
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
        /** @var SeedMorphology $seedMorphology */
        $seedMorphology = $this->seedMorphologyRepository->find($id, $this->seedMorphologyRepository->getRelationFields());

        if (empty($seedMorphology)) {
            return $this->sendError('Seed Morphology not found');
        }

        return $this->sendResponse($seedMorphology->toArray(), 'Seed Morphology retrieved successfully');
    }

    /**
     * @param int $id
     * @param SeedMorphologyAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/seed_morphologies/{id}",
     *      summary="Update the specified SeedMorphology in storage",
     *      tags={"SeedMorphology"},
     *      description="Update SeedMorphology",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedMorphology",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="seed_collection_id",
     *          in="body",
     *          description="SeedMorphology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedMorphology")
     *      ),
     *      @SWG\Parameter(
     *          name="collection_id",
     *          in="body",
     *          description="SeedMorphology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedMorphology")
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
     *                  ref="#/definitions/SeedMorphology"
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
    public function update($id, SeedMorphologyAPIRequest $request)
    {
        $input = $request->all();

        /** @var SeedMorphology $seedMorphology */
        $seedMorphology = $this->seedMorphologyRepository->find($id);

        if (empty($seedMorphology)) {
            return $this->sendError('Seed Morphology not found');
        }

        $seedMorphology = $this->seedMorphologyRepository->update($input, $id);

        return $this->sendResponse($seedMorphology->toArray(), 'SeedMorphology updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/seed_morphologies/{id}",
     *      summary="Remove the specified SeedMorphology from storage",
     *      tags={"SeedMorphology"},
     *      description="Delete SeedMorphology",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedMorphology",
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
        /** @var SeedMorphology $seedMorphology */
        $seedMorphology = $this->seedMorphologyRepository->find($id);

        if (empty($seedMorphology)) {
            return $this->sendError('Seed Morphology not found');
        }

        $seedMorphology->delete();

        return $this->sendResponse($id, 'Seed Morphology deleted successfully');
    }

    public function storeQuantity($id, MorphologyQuantityAPIRequest $request)
    {
        $input = $request->all();

        /** @var SeedMorphology $seedMorphology */
        $seedMorphology = $this->seedMorphologyRepository->find($id);

        if (empty($seedMorphology)) {
            return $this->sendError('Seed Morphology not found');
        }

        $this->seedMorphologyRepository->storeQuantitatives($input['quantitatives'], $seedMorphology);

        return $this->sendResponse($seedMorphology->toArray(), 'SeedMorphology updated successfully');
    }

    public function storeQuality($id, MorphologyQualityAPIRequest $request)
    {
        $input = $request->all();
        /** @var SeedMorphology $seedMorphology */
        $seedMorphology = $this->seedMorphologyRepository->find($id);

        if (empty($seedMorphology)) {
            return $this->sendError('Seed Morphology not found');
        }

        $this->seedMorphologyRepository->storeQualititatives($input['qualititatives'], $seedMorphology);

        return $this->sendResponse($seedMorphology->toArray(), 'SeedMorphology updated successfully');
    }
    public function storeField($id, SeedMorphologyFieldAPIRequest $request)
    {
        $input = $request->all();

        /** @var SeedMorphology $seedMorphology */
        $seedMorphology = $this->seedMorphologyRepository->find($id);

        if (empty($seedMorphology)) {
            return $this->sendError('Seed Morphology not found');
        }

        $this->seedMorphologyRepository->storeField($input, $seedMorphology);

        return $this->sendResponse($seedMorphology->toArray(), 'SeedMorphology updated successfully');
    }
    public function storeMedia($id)
    {

        /** @var SeedMorphology $seedMorphology */
        $seedMorphology = $this->seedMorphologyRepository->find($id);

        if (empty($seedMorphology)) {
            return $this->sendError('Seed Morphology not found');
        }

        $this->seedMorphologyRepository->storeMedia(\request()->all(), $seedMorphology);

        return $this->sendResponse($seedMorphology->toArray(), 'SeedMorphology updated successfully');
    }
}
