<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\SeedMorphologyFieldAPIRequest;
use App\Models\SeedMorphologyField;
use App\Repositories\SeedMorphologyFieldRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Response;

/**
 * Class SeedMorphologyFieldAPIController
 * @package App\Http\Controllers\Api
 */
class SeedMorphologyFieldAPIController extends AppBaseController
{
    /** @var  SeedMorphologyFieldRepository */
    private $seedMorphologyFieldRepository;

    public function __construct(SeedMorphologyFieldRepository $seedMorphologyFieldRepo)
    {
        $this->seedMorphologyFieldRepository = $seedMorphologyFieldRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/morphology_fields",
     *      summary="Get a listing of the SeedMorphologyFields.",
     *      tags={"SeedMorphologyField"},
     *      description="Get all SeedMorphologyFields",
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
     *                  @SWG\Items(ref="#/definitions/SeedMorphologyField")
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
        $seedMorphologyFields = $this->seedMorphologyFieldRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $this->seedMorphologyFieldRepository->getRelationFields()
        );

        return $this->sendResponse($seedMorphologyFields->toArray(), 'Seed Morphology Fields retrieved successfully');
    }

    /**
     * @param SeedMorphologyFieldAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/morphology_fields",
     *      summary="Store a newly created SeedMorphologyField in storage",
     *      tags={"SeedMorphologyField"},
     *      description="Store SeedMorphologyField",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="SeedMorphologyField that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedMorphologyField")
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
     *                  ref="#/definitions/SeedMorphologyField"
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
    public function store(SeedMorphologyFieldAPIRequest $request)
    {
        $input = $request->all();

        $seedMorphologyField = $this->seedMorphologyFieldRepository->create($input);

        return $this->sendResponse($seedMorphologyField->toArray(), 'Seed Morphology Field saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/morphology_fields/{id}",
     *      summary="Display the specified SeedMorphologyField",
     *      tags={"SeedMorphologyField"},
     *      description="Get SeedMorphologyField",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedMorphologyField",
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
     *                  ref="#/definitions/SeedMorphologyField"
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
        /** @var SeedMorphologyField $seedMorphologyField */
        $seedMorphologyField = $this->seedMorphologyFieldRepository->find($id, $this->seedMorphologyFieldRepository->getRelationFields());

        if (empty($seedMorphologyField)) {
            return $this->sendError('Seed Morphology Field not found');
        }

        return $this->sendResponse($seedMorphologyField->toArray(), 'Seed Morphology Field retrieved successfully');
    }

    /**
     * @param int $id
     * @param SeedMorphologyFieldAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/morphology_fields/{id}",
     *      summary="Update the specified SeedMorphologyField in storage",
     *      tags={"SeedMorphologyField"},
     *      description="Update SeedMorphologyField",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedMorphologyField",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="SeedMorphologyField that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedMorphologyField")
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
     *                  ref="#/definitions/SeedMorphologyField"
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
    public function update($id, SeedMorphologyFieldAPIRequest $request)
    {
        $input = $request->all();

        /** @var SeedMorphologyField $seedMorphologyField */
        $seedMorphologyField = $this->seedMorphologyFieldRepository->find($id);

        if (empty($seedMorphologyField)) {
            return $this->sendError('Seed Morphology Field not found');
        }

        $seedMorphologyField = $this->seedMorphologyFieldRepository->update($input, $id);

        return $this->sendResponse($seedMorphologyField->toArray(), 'SeedMorphologyField updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/morphology_fields/{id}",
     *      summary="Remove the specified SeedMorphologyField from storage",
     *      tags={"SeedMorphologyField"},
     *      description="Delete SeedMorphologyField",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedMorphologyField",
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
        /** @var SeedMorphologyField $seedMorphologyField */
        $seedMorphologyField = $this->seedMorphologyFieldRepository->find($id);

        if (empty($seedMorphologyField)) {
            return $this->sendError('Seed Morphology Field not found');
        }

        $seedMorphologyField->delete();

        return $this->sendResponse($id, 'Seed Morphology Field deleted successfully');
    }
}
