<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\GreenHouseAPIRequest;
use App\Models\GreenHouse;
use App\Repositories\GreenHouseRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Response;

/**
 * Class MorphologyFieldController
 * @package App\Http\Controllers\Api
 */
class GreenHouseAPIController extends AppBaseController
{
    /** @var  GreenHouseRepository */
    private $greenHouseRepository;

    public function __construct(GreenHouseRepository $greenHouseRepo)
    {
        $this->greenHouseRepository = $greenHouseRepo;
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
        $greenHouses = $this->greenHouseRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $this->greenHouseRepository->getRelationFields()
        );

        return $this->sendResponse($greenHouses->toArray(), 'Green Houses retrieved successfully');
    }

    /**
     * @param GreenHouseAPIRequest $request
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
    public function store(GreenHouseAPIRequest $request)
    {
        $input = $request->all();

        $greenHouse = $this->greenHouseRepository->create($input);

        return $this->sendResponse($greenHouse->toArray(), 'Green House saved successfully');
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
        /** @var GreenHouse $greenHouse */
        $greenHouse = $this->greenHouseRepository->find($id, $this->greenHouseRepository->getRelationFields());

        if (empty($greenHouse)) {
            return $this->sendError('Green House not found');
        }

        return $this->sendResponse($greenHouse->toArray(), 'Green House retrieved successfully');
    }

    /**
     * @param int $id
     * @param GreenHouseAPIRequest $request
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
    public function update($id, GreenHouseAPIRequest $request)
    {
        $input = $request->all();

        /** @var GreenHouse $greenHouse */
        $greenHouse = $this->greenHouseRepository->find($id);

        if (empty($greenHouse)) {
            return $this->sendError('Green House not found');
        }

        $greenHouse = $this->greenHouseRepository->update($input, $id);

        return $this->sendResponse($greenHouse->toArray(), 'MorphologyField updated successfully');
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
        /** @var GreenHouse $greenHouse */
        $greenHouse = $this->greenHouseRepository->find($id);

        if (empty($greenHouse)) {
            return $this->sendError('Green House not found');
        }

        $greenHouse->delete();

        return $this->sendResponse($id, 'Green House deleted successfully');
    }

}
