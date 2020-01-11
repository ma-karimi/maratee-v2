<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\MorphologyFieldAPIRequest;
use App\Models\MorphologyField;
use App\Repositories\MorphologyFieldRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Response;

/**
 * Class MorphologyFieldController
 * @package App\Http\Controllers\Api
 */
class MorphologyFieldAPIController extends AppBaseController
{
    /** @var  MorphologyFieldRepository */
    private $morphologyFieldRepository;

    public function __construct(MorphologyFieldRepository $morphologyFieldRepo)
    {
        $this->morphologyFieldRepository = $morphologyFieldRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/morphology/fields",
     *      summary="Get a listing of the MorphologyFields.",
     *      tags={"MorphologyField"},
     *      description="Get all MorphologyFields",
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
     *                  @SWG\Items(ref="#/definitions/MorphologyField")
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
        $morphologyFields = $this->morphologyFieldRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($morphologyFields->toArray(), 'Morphology Fields retrieved successfully');
    }

    /**
     * @param MorphologyFieldAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/morphology/fields",
     *      summary="Store a newly created MorphologyField in storage",
     *      tags={"MorphologyField"},
     *      description="Store MorphologyField",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="MorphologyField that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/MorphologyField")
     *      ),
     *      @SWG\Parameter(
     *          name="location_id",
     *          in="body",
     *          description="MorphologyField that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MorphologyField")
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
     *                  ref="#/definitions/MorphologyField"
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
    public function store(MorphologyFieldAPIRequest $request)
    {
        $input = $request->all();

        $morphologyField = $this->morphologyFieldRepository->create($input);

        return $this->sendResponse($morphologyField->toArray(), 'Morphology Field saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/morphology/fields/{id}",
     *      summary="Display the specified MorphologyField",
     *      tags={"MorphologyField"},
     *      description="Get MorphologyField",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MorphologyField",
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
     *                  ref="#/definitions/MorphologyField"
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
        /** @var MorphologyField $morphologyField */
        $morphologyField = $this->morphologyFieldRepository->find($id);

        if (empty($morphologyField)) {
            return $this->sendError('Morphology Field not found');
        }

        return $this->sendResponse($morphologyField->toArray(), 'Morphology Field retrieved successfully');
    }

    /**
     * @param int $id
     * @param MorphologyFieldAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/morphology/fields/{id}",
     *      summary="Update the specified MorphologyField in storage",
     *      tags={"MorphologyField"},
     *      description="Update MorphologyField",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MorphologyField",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="MorphologyField that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/MorphologyField")
     *      ),
     *      @SWG\Parameter(
     *          name="location_id",
     *          in="body",
     *          description="MorphologyField that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MorphologyField")
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
     *                  ref="#/definitions/MorphologyField"
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
    public function update($id, MorphologyFieldAPIRequest $request)
    {
        $input = $request->all();

        /** @var MorphologyField $morphologyField */
        $morphologyField = $this->morphologyFieldRepository->find($id);

        if (empty($morphologyField)) {
            return $this->sendError('Morphology Field not found');
        }

        $morphologyField = $this->morphologyFieldRepository->update($input, $id);

        return $this->sendResponse($morphologyField->toArray(), 'MorphologyField updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/morphology/fields/{id}",
     *      summary="Remove the specified MorphologyField from storage",
     *      tags={"MorphologyField"},
     *      description="Delete MorphologyField",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MorphologyField",
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
        /** @var MorphologyField $morphologyField */
        $morphologyField = $this->morphologyFieldRepository->find($id);

        if (empty($morphologyField)) {
            return $this->sendError('Morphology Field not found');
        }

        $morphologyField->delete();

        return $this->sendResponse($id, 'Morphology Field deleted successfully');
    }
}
