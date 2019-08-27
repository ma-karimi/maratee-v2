<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateMedicinalPlantAPIRequest;
use App\Http\Requests\Api\UpdateMedicinalPlantAPIRequest;
use App\Models\MedicinalPlant;
use App\Repositories\MedicinalPlantRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class MedicinalPlantController
 * @package App\Http\Controllers\Api
 */

class MedicinalPlantAPIController extends AppBaseController
{
    /** @var  MedicinalPlantRepository */
    private $medicinalPlantRepository;

    public function __construct(MedicinalPlantRepository $medicinalPlantRepo)
    {
        $this->medicinalPlantRepository = $medicinalPlantRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/medicinal_plants",
     *      summary="Get a listing of the MedicinalPlants.",
     *      tags={"MedicinalPlant"},
     *      description="Get all MedicinalPlants",
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
     *                  @SWG\Items(ref="#/definitions/MedicinalPlant")
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
        $medicinalPlants = $this->medicinalPlantRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($medicinalPlants->toArray(), 'Medicinal Plants retrieved successfully');
    }

    /**
     * @param CreateMedicinalPlantAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/medicinal_plants",
     *      summary="Store a newly created MedicinalPlant in storage",
     *      tags={"MedicinalPlant"},
     *      description="Store MedicinalPlant",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="plant_application_id",
     *          in="body",
     *          description="MedicinalPlantMorphology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantMorphology")
     *      ),
     *      @SWG\Parameter(
     *          name="aerial_part_id",
     *          in="body",
     *          description="MedicinalPlantMorphology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantMorphology")
     *      ),
     *      @SWG\Parameter(
     *          name="ground_part_id",
     *          in="body",
     *          description="MedicinalPlantMorphology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantMorphology")
     *      ),
     *      @SWG\Parameter(
     *          name="code_no",
     *          in="body",
     *          description="MedicinalPlantMorphology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantMorphology")
     *      ),
     *      @SWG\Parameter(
     *          name="vast_cultivation",
     *          in="body",
     *          description="MedicinalPlantMorphology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantMorphology")
     *      ),
     *      @SWG\Parameter(
     *          name="cultivated_area",
     *          in="body",
     *          description="MedicinalPlantMorphology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantMorphology")
     *      ),
     *      @SWG\Parameter(
     *          name="studied_sample",
     *          in="body",
     *          description="MedicinalPlantMorphology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantMorphology")
     *      ),
     *      @SWG\Parameter(
     *          name="secondary_metabolite",
     *          in="body",
     *          description="MedicinalPlantMorphology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantMorphology")
     *      ),
     *      @SWG\Parameter(
     *          name="efficiency",
     *          in="body",
     *          description="MedicinalPlantMorphology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantMorphology")
     *      ),
     *      @SWG\Parameter(
     *          name="exclusivity",
     *          in="body",
     *          description="MedicinalPlantMorphology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantMorphology")
     *      ),
     *      @SWG\Parameter(
     *          name="life_cycle",
     *          in="body",
     *          description="MedicinalPlantMorphology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantMorphology")
     *      ),
     *      @SWG\Parameter(
     *          name="phenology_stage",
     *          in="body",
     *          description="MedicinalPlantMorphology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantMorphology")
     *      ),
     *      @SWG\Parameter(
     *          name="used_origin",
     *          in="body",
     *          description="MedicinalPlantMorphology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantMorphology")
     *      ),
     *      @SWG\Parameter(
     *          name="used_type",
     *          in="body",
     *          description="MedicinalPlantMorphology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantMorphology")
     *      ),
     *      @SWG\Parameter(
     *          name="store_type",
     *          in="body",
     *          description="MedicinalPlantMorphology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantMorphology")
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
     *                  ref="#/definitions/MedicinalPlant"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateMedicinalPlantAPIRequest $request)
    {
        $input = $request->all();

        $medicinalPlant = $this->medicinalPlantRepository->create($input);

        return $this->sendResponse($medicinalPlant->toArray(), 'Medicinal Plant saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/medicinal_plants/{id}",
     *      summary="Display the specified MedicinalPlant",
     *      tags={"MedicinalPlant"},
     *      description="Get MedicinalPlant",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MedicinalPlant",
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
     *                  ref="#/definitions/MedicinalPlant"
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
        /** @var MedicinalPlant $medicinalPlant */
        $medicinalPlant = $this->medicinalPlantRepository->find($id, \request()->get('relations'));

        if ($medicinalPlant === null) {
            return $this->sendError('Medicinal Plant not found');
        }

        return $this->sendResponse($medicinalPlant->toArray(), 'Medicinal Plant retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateMedicinalPlantAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/medicinal_plants/{id}",
     *      summary="Update the specified MedicinalPlant in storage",
     *      tags={"MedicinalPlant"},
     *      description="Update MedicinalPlant",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MedicinalPlant",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="plant_application_id",
     *          in="body",
     *          description="MedicinalPlantMorphology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantMorphology")
     *      ),
     *      @SWG\Parameter(
     *          name="aerial_part_id",
     *          in="body",
     *          description="MedicinalPlantMorphology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantMorphology")
     *      ),
     *      @SWG\Parameter(
     *          name="ground_part_id",
     *          in="body",
     *          description="MedicinalPlantMorphology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantMorphology")
     *      ),
     *      @SWG\Parameter(
     *          name="code_no",
     *          in="body",
     *          description="MedicinalPlantMorphology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantMorphology")
     *      ),
     *      @SWG\Parameter(
     *          name="vast_cultivation",
     *          in="body",
     *          description="MedicinalPlantMorphology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantMorphology")
     *      ),
     *      @SWG\Parameter(
     *          name="cultivated_area",
     *          in="body",
     *          description="MedicinalPlantMorphology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantMorphology")
     *      ),
     *      @SWG\Parameter(
     *          name="studied_sample",
     *          in="body",
     *          description="MedicinalPlantMorphology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantMorphology")
     *      ),
     *      @SWG\Parameter(
     *          name="secondary_metabolite",
     *          in="body",
     *          description="MedicinalPlantMorphology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantMorphology")
     *      ),
     *      @SWG\Parameter(
     *          name="efficiency",
     *          in="body",
     *          description="MedicinalPlantMorphology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantMorphology")
     *      ),
     *      @SWG\Parameter(
     *          name="exclusivity",
     *          in="body",
     *          description="MedicinalPlantMorphology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantMorphology")
     *      ),
     *      @SWG\Parameter(
     *          name="life_cycle",
     *          in="body",
     *          description="MedicinalPlantMorphology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantMorphology")
     *      ),
     *      @SWG\Parameter(
     *          name="phenology_stage",
     *          in="body",
     *          description="MedicinalPlantMorphology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantMorphology")
     *      ),
     *      @SWG\Parameter(
     *          name="used_origin",
     *          in="body",
     *          description="MedicinalPlantMorphology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantMorphology")
     *      ),
     *      @SWG\Parameter(
     *          name="used_type",
     *          in="body",
     *          description="MedicinalPlantMorphology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantMorphology")
     *      ),
     *      @SWG\Parameter(
     *          name="store_type",
     *          in="body",
     *          description="MedicinalPlantMorphology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantMorphology")
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
     *                  ref="#/definitions/MedicinalPlant"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateMedicinalPlantAPIRequest $request)
    {
        $input = $request->all();

        /** @var MedicinalPlant $medicinalPlant */
        $medicinalPlant = $this->medicinalPlantRepository->find($id, \request()->get('relations'));

        if ($medicinalPlant === null) {
            return $this->sendError('Medicinal Plant not found');
        }

        $medicinalPlant = $this->medicinalPlantRepository->update($input, $id);

        return $this->sendResponse($medicinalPlant->toArray(), 'MedicinalPlant updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/medicinal_plants/{id}",
     *      summary="Remove the specified MedicinalPlant from storage",
     *      tags={"MedicinalPlant"},
     *      description="Delete MedicinalPlant",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MedicinalPlant",
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
        /** @var MedicinalPlant $medicinalPlant */
        $medicinalPlant = $this->medicinalPlantRepository->find($id, \request()->get('relations'));

        if ($medicinalPlant === null) {
            return $this->sendError('Medicinal Plant not found');
        }

        $medicinalPlant->delete();

        return $this->sendResponse($id, 'Medicinal Plant deleted successfully');
    }
}
