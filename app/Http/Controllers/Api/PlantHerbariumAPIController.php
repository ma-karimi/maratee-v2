<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\CreatePlantHerbariumAPIRequest;
use App\Http\Requests\Api\UpdatePlantHerbariumAPIRequest;
use App\Http\Resources\PlantResource;
use App\Models\PlantHerbarium;
use App\Repositories\PlantHerbariumRepository;
use Illuminate\Http\Request;

/**
 * Class PlantController
 * @package App\Http\Controllers\Api
 */
class PlantHerbariumAPIController extends AppBaseController
{
    /** @var  PlantHerbariumRepository */
    private $plantRepository;

    public function __construct(PlantHerbariumRepository $plantRepo)
    {
        $this->plantRepository = $plantRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @throws \Exception
     * @SWG\Get(
     *      path="/plant_herbariums",
     *      summary="Get a listing of the Plants & Plant has flowering herbarium",
     *      tags={"PlantHerbarium"},
     *      description="Get all Plants",
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
     *                  @SWG\Items(ref="#/definitions/PlantHerbarium")
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
        $relation_for_scientific_name = ['taxonomy.family','taxonomy.genus', 'taxonomy.species', 'taxonomy.subspecies', 'taxonomy.variety'];
        $plants = $this->plantRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations') ? array_merge($relation_for_scientific_name,$request->get('relations')) : $relation_for_scientific_name
        );
        return $this->sendResponse($plants->toArray(), 'Plants retrieved successfully');
    }

    /**
     * @param CreatePlantHerbariumAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/plant_herbariums",
     *      summary="Store a newly created Plant in storage",
     *      tags={"PlantHerbarium"},
     *      description="Store Plant",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PlantHerbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="herbarium_number",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantHerbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="location_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PlantHerbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="organization_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PlantHerbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="general_phytogeography_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PlantHerbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="protection_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PlantHerbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="is_flowering",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantHerbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="herbarium_index",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantHerbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="cf",
     *          in="body",
     *          description="0=> sure  1=> doubt",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantHerbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="sheets_no",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantHerbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="samples_no",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantHerbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="tip_qt",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantHerbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="physical_tip_qt",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantHerbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="general_substrate_lichen_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantHerbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="general_substrate_moss_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantHerbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="general_substrate_diatom_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantHerbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="general_ecology_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantHerbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="general_origin_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantHerbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantHerbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="habitat_description",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantHerbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="ecology_description",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantHerbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="family_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Taxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="genus_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Taxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="order_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Taxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="class_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Taxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="species_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Taxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="variety_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Taxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="flowering_time",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantHerbarium")
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
     *                  ref="#/definitions/PlantHerbarium"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePlantHerbariumAPIRequest $request)
    {
        $input = $request->all();

        $plant = $this->plantRepository->create($input);

        return $this->sendResponse($plant->toArray(), 'Plant saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/plant_herbariums/{id}",
     *      summary="Display the specified Plant",
     *      tags={"PlantHerbarium"},
     *      description="Get Plant",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Plant",
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
     *                  ref="#/definitions/PlantHerbarium"
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
        $relation_for_scientific_name = ['taxonomy.family','taxonomy.genus', 'taxonomy.species', 'taxonomy.subspecies', 'taxonomy.variety'];
        /** @var PlantHerbarium $plant */
        $plant = $this->plantRepository->find($id,
            \request()->get('relations') ? array_merge($relation_for_scientific_name,\request()->get('relations')) : $relation_for_scientific_name
        );
        if (empty($plant)) {
            return $this->sendError('Plant not found');
        }

        return $this->sendResponse($plant->toArray(), 'Plant retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePlantHerbariumAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/plant_herbariums/{id}",
     *      summary="Update the specified Plant in storage",
     *      tags={"PlantHerbarium"},
     *      description="Update Plant",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Plant",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PlantHerbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="herbarium_number",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantHerbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="location_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PlantHerbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="organization_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PlantHerbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="general_phytogeography_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PlantHerbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="protection_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PlantHerbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="is_flowering",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantHerbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="herbarium_index",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantHerbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="cf",
     *          in="body",
     *          description="0=> sure  1=> doubt",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantHerbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="sheets_no",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantHerbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="samples_no",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantHerbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="tip_qt",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantHerbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="physical_tip_qt",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantHerbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="general_substrate_lichen_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantHerbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="general_substrate_moss_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantHerbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="general_substrate_diatom_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantHerbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="general_ecology_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantHerbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="general_origin_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantHerbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantHerbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="habitat_description",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantHerbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="ecology_description",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantHerbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="family_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Taxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="genus_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Taxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="order_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Taxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="class_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Taxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="species_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Taxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="variety_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Taxonomy")
     *      ),
     *      @SWG\Parameter(
     *          name="flowering_time",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantHerbarium")
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
     *                  ref="#/definitions/PlantHerbarium"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePlantHerbariumAPIRequest $request)
    {
        $input = $request->all();

        /** @var PlantHerbarium $plant */
        $plant = $this->plantRepository->find($id, \request()->get('relations'));

        if (empty($plant)) {
            return $this->sendError('Plant not found');
        }

        $plant = $this->plantRepository->update($input, $id);

        return $this->sendResponse($plant->toArray(), 'Plant updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/plant_herbariums/{id}",
     *      summary="Remove the specified Plant from storage",
     *      tags={"PlantHerbarium"},
     *      description="Delete Plant",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Plant",
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
        /** @var PlantHerbarium $plant */
        $plant = $this->plantRepository->find($id, \request()->get('relations'));

        if (empty($plant)) {
            return $this->sendError('Plant not found');
        }

        $plant->delete();

        return $this->sendResponse($id, 'Plant deleted successfully');
    }

    public function exportExcel(Request $request)
    {
        $relations = [
            'generalFamily.actors',
            'generalGenus.actors',
            'generalSpecie.actors',
            'generalSubSpecie.actors',
            'generalVariety.actors',
            'generalSperm',
            'generalCotyledon',
            'actors',
            'location.city.province.country',
            'location.village',
            'herbariums.department',
            'herbariums.division',
            'herbariums.generalPhytogeography',
            'herbariums.actionHubs.user',
            'herbariums.generalPhenology',
            'herbariums.protection',
            'herbariums.attendances',
            'herbariums.borrows.user',
            'herbariums.borrows.media',
        ];
        $plants = $this->plantRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit'),
            $relations
        );
        $plants = PlantResource::collection($plants);
        return $this->sendResponse($plants, 'Plants retrieved successfully');
    }
}
