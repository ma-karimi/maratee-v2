<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\ActionableRequest;
use App\Http\Requests\Api\CreateMedicinalPlantAPIRequest;
use App\Http\Requests\Api\MedicinalPlantAPIRequest;
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
     * @param MedicinalPlantAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/medicinal_plants",
     *      summary="Store a newly created MedicinalPlant in storage",
     *      tags={"MedicinalPlant"},
     *      description="Store MedicinalPlant",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="plant_herbarium_id",
     *          in="body",
     *          description="MedicinalPlant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="taxonomy_id",
     *          in="body",
     *          description="MedicinalPlant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="location_id",
     *          in="body",
     *          description="MedicinalPlant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="medicine_id",
     *          in="body",
     *          description="MedicinalPlant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="aerial_part_id",
     *          in="body",
     *          description="from medicinal_parts where type=aerial",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="ground_part_id",
     *          in="body",
     *          description="from medicinal_parts where type=ground",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="food_industry_id",
     *          in="body",
     *          description="from medicinal_plant_type",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="hygienic_cosmetic_industry_id",
     *          in="body",
     *          description="from medicinal_plant_type",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="other_industry_id",
     *          in="body",
     *          description="from medicinal_plant_type",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="industrial_potential_id",
     *          in="body",
     *          description="from medicinal_plant_type",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="general_phenology_id",
     *          in="body",
     *          description="from general",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="pharmaceutical_form_id",
     *          in="body",
     *          description="from general",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="method_distillation_id",
     *          in="body",
     *          description="from methods",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="method_extraction_id",
     *          in="body",
     *          description="from methods",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="method_analyse_id",
     *          in="body",
     *          description="from methods",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="secondary_metabolite_id",
     *          in="body",
     *          description="from medicinal_plant_type",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="product_id",
     *          in="body",
     *          description="from medicinal_plant_type",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="treatment_id",
     *          in="body",
     *          description="from medicinal_plant_type",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="effective_material_id",
     *          in="body",
     *          description="from medicinal_plant_type",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="traditional_iranian_medicine",
     *          in="body",
     *          description="0 -> raw , 1 -> processed",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="inherbal_medicine_store",
     *          in="body",
     *          description=" 1 => 'raw', 2 => 'processed'",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="natural_drug",
     *          in="body",
     *          description="0 -> Human medicines , 1 -> Animal drugs",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="exporting",
     *          in="body",
     *          description="0 -> raw , 1 -> processed",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="importing",
     *          in="body",
     *          description="0 -> raw , 1 -> processed",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="cultivated_area",
     *          in="body",
     *          description="0 -> raw , 1 -> processed",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="studied_sample",
     *          in="body",
     *          description="0 -> wild , 1 -> cultivated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="presence_in_country",
     *          in="body",
     *          description="0 -> native , 1 -> endemic",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="medicinal_properties",
     *          in="body",
     *          description="medicinal_properties",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="side_effects",
     *          in="body",
     *          description="side_effects",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="consumption",
     *          in="body",
     *          description="consumption",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="active_compounds",
     *          in="body",
     *          description="active_compounds",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="manufacturer",
     *          in="body",
     *          description="manufacturer",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="efficiency",
     *          in="body",
     *          description="efficiency : float type",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="code_no",
     *          in="body",
     *          description="code_no",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="flower_color",
     *          in="body",
     *          description="flower_color",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="fruit_color",
     *          in="body",
     *          description="fruit_color",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="height",
     *          in="body",
     *          description="height",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="life_forms",
     *          in="body",
     *          description="life_forms",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
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
    public function store(MedicinalPlantAPIRequest $request)
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
     * @param MedicinalPlantAPIRequest $request
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
     *          name="plant_herbarium_id",
     *          in="body",
     *          description="MedicinalPlant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="article_id",
     *          in="body",
     *          description="MedicinalPlant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="taxonomy_id",
     *          in="body",
     *          description="MedicinalPlant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="location_id",
     *          in="body",
     *          description="MedicinalPlant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="medicine_id",
     *          in="body",
     *          description="MedicinalPlant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="aerial_part_id",
     *          in="body",
     *          description="from medicinal_parts where type=aerial",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="ground_part_id",
     *          in="body",
     *          description="from medicinal_parts where type=ground",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="food_industry_id",
     *          in="body",
     *          description="from medicinal_plant_type",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="hygienic_cosmetic_industry_id",
     *          in="body",
     *          description="from medicinal_plant_type",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="other_industry_id",
     *          in="body",
     *          description="from medicinal_plant_type",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="industrial_potential_id",
     *          in="body",
     *          description="from medicinal_plant_type",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="general_phenology_id",
     *          in="body",
     *          description="from general",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="pharmaceutical_form_id",
     *          in="body",
     *          description="from general",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="method_distillation_id",
     *          in="body",
     *          description="from methods",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="method_extraction_id",
     *          in="body",
     *          description="from methods",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="method_analyse_id",
     *          in="body",
     *          description="from methods",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="secondary_metabolite_id",
     *          in="body",
     *          description="from medicinal_plant_type",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="product_id",
     *          in="body",
     *          description="from medicinal_plant_type",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="treatment_id",
     *          in="body",
     *          description="from medicinal_plant_type",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="effective_material_id",
     *          in="body",
     *          description="from medicinal_plant_type",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="traditional_iranian_medicine",
     *          in="body",
     *          description="0 -> raw , 1 -> processed",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="inherbal_medicine_store",
     *          in="body",
     *          description=" 1 => 'raw', 2 => 'processed'",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="natural_drug",
     *          in="body",
     *          description="0 -> Human medicines , 1 -> Animal drugs",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="exporting",
     *          in="body",
     *          description="0 -> raw , 1 -> processed",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="importing",
     *          in="body",
     *          description="0 -> raw , 1 -> processed",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="cultivated_area",
     *          in="body",
     *          description="0 -> raw , 1 -> processed",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="studied_sample",
     *          in="body",
     *          description="0 -> wild , 1 -> cultivated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="presence_in_country",
     *          in="body",
     *          description="0 -> native , 1 -> endemic",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="medicinal_properties",
     *          in="body",
     *          description="medicinal_properties",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="side_effects",
     *          in="body",
     *          description="side_effects",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="consumption",
     *          in="body",
     *          description="consumption",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="active_compounds",
     *          in="body",
     *          description="active_compounds",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="manufacturer",
     *          in="body",
     *          description="manufacturer",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="efficiency",
     *          in="body",
     *          description="efficiency : float type",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="code_no",
     *          in="body",
     *          description="code_no",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="flower_color",
     *          in="body",
     *          description="flower_color",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="fruit_color",
     *          in="body",
     *          description="fruit_color",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="height",
     *          in="body",
     *          description="height",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="life_forms",
     *          in="body",
     *          description="life_forms",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
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
    public function update(MedicinalPlantAPIRequest $request, $id)
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

    /**
     * @param $id
     * @param ActionableRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/medicinal_plants/{id}/determine",
     *      summary="Store Determine action for Given MedicinalPlant",
     *      tags={"MedicinalPlant Action"},
     *      description="Store MedicinalPlant Action",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="actors",
     *          in="body",
     *          description="ids of actors",
     *          required=true,
     *          @SWG\Schema(type="array", @SWG\Items(type="integer"))
     *      ),
     *      @SWG\Parameter(
     *          name="date",
     *          in="body",
     *          description="MedicinalPlant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ActionHub")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="MedicinalPlant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ActionHub")
     *      ),
     *      @SWG\Parameter(
     *          name="project_id",
     *          in="body",
     *          description="MedicinalPlant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ActionHub")
     *      ),
     *      @SWG\Parameter(
     *          name="department_id",
     *          in="body",
     *          description="MedicinalPlant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ActionHub")
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
    public function storeDetermine($id, ActionableRequest $request)
    {
        $input = $request->all();

        $result = $this->medicinalPlantRepository->storeAction($id, $input, 1);

        return $this->sendResponse($result->toArray(), 'MedicinalPlant Action saved successfully');
    }

    /**
     * @param $id
     * @param ActionableRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/medicinal_plants/{id}/collect",
     *      summary="Store Collect action for Given MedicinalPlant",
     *      tags={"MedicinalPlant Action"},
     *      description="Store MedicinalPlant Action",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="actors",
     *          in="body",
     *          description="ids of actors",
     *          required=true,
     *          @SWG\Schema(type="array", @SWG\Items(type="integer"))
     *      ),
     *      @SWG\Parameter(
     *          name="date",
     *          in="body",
     *          description="MedicinalPlant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ActionHub")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="MedicinalPlant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ActionHub")
     *      ),
     *      @SWG\Parameter(
     *          name="project_id",
     *          in="body",
     *          description="MedicinalPlant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ActionHub")
     *      ),
     *      @SWG\Parameter(
     *          name="department_id",
     *          in="body",
     *          description="MedicinalPlant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ActionHub")
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
    public function storeCollect($id, ActionableRequest $request)
    {
        $input = $request->all();

        $result = $this->medicinalPlantRepository->storeAction($id, $input, 2);

        return $this->sendResponse($result->toArray(), 'MedicinalPlant Action saved successfully');
    }

    /**
     * @param $id
     * @param ActionableRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/medicinal_plants/{id}/research",
     *      summary="Store Research action for Given MedicinalPlant",
     *      tags={"MedicinalPlant Action"},
     *      description="Store MedicinalPlant Action",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="actors",
     *          in="body",
     *          description="ids of actors",
     *          required=true,
     *          @SWG\Schema(type="array", @SWG\Items(type="integer"))
     *      ),
     *      @SWG\Parameter(
     *          name="date",
     *          in="body",
     *          description="MedicinalPlant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ActionHub")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="MedicinalPlant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ActionHub")
     *      ),
     *      @SWG\Parameter(
     *          name="project_id",
     *          in="body",
     *          description="MedicinalPlant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ActionHub")
     *      ),
     *      @SWG\Parameter(
     *          name="department_id",
     *          in="body",
     *          description="MedicinalPlant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ActionHub")
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
    public function storeResearch($id, ActionableRequest $request)
    {
        $input = $request->all();

        $result = $this->medicinalPlantRepository->storeAction($id, $input, 3);

        return $this->sendResponse($result->toArray(), 'MedicinalPlant Action saved successfully');
    }
}
