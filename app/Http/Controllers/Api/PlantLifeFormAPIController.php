<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreatePlantLifeFormAPIRequest;
use App\Http\Requests\Api\UpdatePlantLifeFormAPIRequest;
use App\Models\PlantLifeForm;
use App\Repositories\PlantLifeFormRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PlantLifeFormController
 * @package App\Http\Controllers\Api
 */

class PlantLifeFormAPIController extends AppBaseController
{
    /** @var  PlantLifeFormRepository */
    private $plantLifeFormRepository;

    public function __construct(PlantLifeFormRepository $plantLifeFormRepo)
    {
        $this->plantLifeFormRepository = $plantLifeFormRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/plant_life_forms",
     *      summary="Get a listing of the PlantLifeForms.",
     *      tags={"PlantLifeForm"},
     *      description="Get all PlantLifeForms",
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
     *                  @SWG\Items(ref="#/definitions/PlantLifeForm")
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
        $plantLifeForms = $this->plantLifeFormRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($plantLifeForms->toArray(), 'Plant Life Forms retrieved successfully');
    }

    /**
     * @param CreatePlantLifeFormAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/plant_life_forms",
     *      summary="Store a newly created PlantLifeForm in storage",
     *      tags={"PlantLifeForm"},
     *      description="Store PlantLifeForm",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="plant_id",
     *          in="body",
     *          description="PlantLifeForm that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PlantLifeForm")
     *      ),
     *      @SWG\Parameter(
     *          name="life_form_id",
     *          in="body",
     *          description="PlantLifeForm that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PlantLifeForm")
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
     *                  ref="#/definitions/PlantLifeForm"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePlantLifeFormAPIRequest $request)
    {
        $input = $request->all();

        $plantLifeForm = $this->plantLifeFormRepository->create($input);

        return $this->sendResponse($plantLifeForm->toArray(), 'Plant Life Form saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/plantLifeForms/{id}",
     *      summary="Display the specified PlantLifeForm",
     *      tags={"PlantLifeForm"},
     *      description="Get PlantLifeForm",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of PlantLifeForm",
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
     *                  ref="#/definitions/PlantLifeForm"
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
        /** @var PlantLifeForm $plantLifeForm */
        $plantLifeForm = $this->plantLifeFormRepository->find($id);

        if (empty($plantLifeForm)) {
            return $this->sendError('Plant Life Form not found');
        }

        return $this->sendResponse($plantLifeForm->toArray(), 'Plant Life Form retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePlantLifeFormAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/plantLifeForms/{id}",
     *      summary="Update the specified PlantLifeForm in storage",
     *      tags={"PlantLifeForm"},
     *      description="Update PlantLifeForm",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of PlantLifeForm",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="plant_id",
     *          in="body",
     *          description="PlantLifeForm that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PlantLifeForm")
     *      ),
     *      @SWG\Parameter(
     *          name="life_form_id",
     *          in="body",
     *          description="PlantLifeForm that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PlantLifeForm")
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
     *                  ref="#/definitions/PlantLifeForm"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePlantLifeFormAPIRequest $request)
    {
        $input = $request->all();

        /** @var PlantLifeForm $plantLifeForm */
        $plantLifeForm = $this->plantLifeFormRepository->find($id);

        if (empty($plantLifeForm)) {
            return $this->sendError('Plant Life Form not found');
        }

        $plantLifeForm = $this->plantLifeFormRepository->update($input, $id);

        return $this->sendResponse($plantLifeForm->toArray(), 'PlantLifeForm updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/plantLifeForms/{id}",
     *      summary="Remove the specified PlantLifeForm from storage",
     *      tags={"PlantLifeForm"},
     *      description="Delete PlantLifeForm",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of PlantLifeForm",
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
        /** @var PlantLifeForm $plantLifeForm */
        $plantLifeForm = $this->plantLifeFormRepository->find($id);

        if (empty($plantLifeForm)) {
            return $this->sendError('Plant Life Form not found');
        }

        $plantLifeForm->delete();

        return $this->sendResponse($id, 'Plant Life Form deleted successfully');
    }
}
