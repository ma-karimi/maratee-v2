<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateMorphologyAPIRequest;
use App\Http\Requests\Api\UpdateMorphologyAPIRequest;
use App\Models\Morphology;
use App\Repositories\MorphologyRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class MorphologyController
 * @package App\Http\Controllers\Api
 */

class MorphologyAPIController extends AppBaseController
{
    /** @var  MorphologyRepository */
    private $morphologyRepository;

    public function __construct(MorphologyRepository $morphologyRepo)
    {
        $this->morphologyRepository = $morphologyRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/morphologies",
     *      summary="Get a listing of the Morphologies.",
     *      tags={"Morphology"},
     *      description="Get all Morphologies",
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
     *                  @SWG\Items(ref="#/definitions/Morphology")
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
        $morphologies = $this->morphologyRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($morphologies->toArray(), 'Morphologies retrieved successfully');
    }

    /**
     * @param CreateMorphologyAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/morphologies",
     *      summary="Store a newly created Morphology in storage",
     *      tags={"Morphology"},
     *      description="Store Morphology",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="Morphology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Morphology")
     *      ),
     *      @SWG\Parameter(
     *          name="unit",
     *          in="body",
     *          description="Morphology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Morphology")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="Morphology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Morphology")
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
     *                  ref="#/definitions/Morphology"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateMorphologyAPIRequest $request)
    {
        $input = $request->all();

        $morphology = $this->morphologyRepository->create($input);

        return $this->sendResponse($morphology->toArray(), 'Morphology saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/morphologies/{id}",
     *      summary="Display the specified Morphology",
     *      tags={"Morphology"},
     *      description="Get Morphology",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Morphology",
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
     *                  ref="#/definitions/Morphology"
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
        /** @var Morphology $morphology */
        $morphology = $this->morphologyRepository->find($id, \request()->get('relations'));

        if ($morphology === null) {
            return $this->sendError('Morphology not found');
        }

        return $this->sendResponse($morphology->toArray(), 'Morphology retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateMorphologyAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/morphologies/{id}",
     *      summary="Update the specified Morphology in storage",
     *      tags={"Morphology"},
     *      description="Update Morphology",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Morphology",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="Morphology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Morphology")
     *      ),
     *      @SWG\Parameter(
     *          name="unit",
     *          in="body",
     *          description="Morphology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Morphology")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="Morphology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Morphology")
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
     *                  ref="#/definitions/Morphology"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateMorphologyAPIRequest $request)
    {
        $input = $request->all();

        /** @var Morphology $morphology */
        $morphology = $this->morphologyRepository->find($id, \request()->get('relations'));

        if ($morphology === null) {
            return $this->sendError('Morphology not found');
        }

        $morphology = $this->morphologyRepository->update($input, $id);

        return $this->sendResponse($morphology->toArray(), 'Morphology updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/morphologies/{id}",
     *      summary="Remove the specified Morphology from storage",
     *      tags={"Morphology"},
     *      description="Delete Morphology",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Morphology",
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
        /** @var Morphology $morphology */
        $morphology = $this->morphologyRepository->find($id, \request()->get('relations'));

        if (empty($morphology)) {
            return $this->sendError('Morphology not found');
        }

        $morphology->delete();

        return $this->sendResponse($id, 'Morphology deleted successfully');
    }
}
