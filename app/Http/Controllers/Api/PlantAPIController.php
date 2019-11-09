<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\CreatePlantAPIRequest;
use App\Http\Requests\Api\ActionableRequest;
use App\Http\Requests\Api\UpdatePlantAPIRequest;
use App\Http\Resources\PlantResource;
use App\Models\Plant;
use App\Repositories\PlantRepository;
use Illuminate\Http\Request;

/**
 * Class PlantController
 * @package App\Http\Controllers\Api
 */
class PlantAPIController extends AppBaseController
{
    /** @var  PlantRepository */
    private $plantRepository;

    public function __construct(PlantRepository $plantRepo)
    {
        $this->plantRepository = $plantRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @throws \Exception
     * @SWG\Get(
     *      path="/plants",
     *      summary="Get a listing of the Plants & Plant Herbarium has flowering herbarium",
     *      tags={"Plant"},
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
     *                  @SWG\Items(ref="#/definitions/Plant")
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
        $relation_for_scientific_name = ['taxonomy.family', 'taxonomy.genus', 'taxonomy.species', 'taxonomy.subspecies', 'taxonomy.variety'];
        $plants = $this->plantRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations') ? array_merge($relation_for_scientific_name, $request->get('relations')) : $relation_for_scientific_name
        );
        return $this->sendResponse($plants->toArray(), 'Plants retrieved successfully');
    }

    /**
     * @param CreatePlantAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/plants",
     *      summary="Store a newly created Plant Herbarium in storage",
     *      tags={"Plant"},
     *      description="Store Plant",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="general_phytogeography_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="protection_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="is_flowering",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="sheets_no",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="samples_no",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="tip_qt",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="physical_tip_qt",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="general_substrate_lichen_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="general_substrate_moss_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="general_substrate_diatom_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="general_origin_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="habitat_description",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="ecology_description",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="taxonomy_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="life_form_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="flowering_time",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="city_id",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Location")
     *      ),
     *      @SWG\Parameter(
     *          name="address",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Location")
     *      ),
     *      @SWG\Parameter(
     *          name="region_name",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Location")
     *      ),
     *      @SWG\Parameter(
     *          name="min_altitude",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Location")
     *      ),
     *      @SWG\Parameter(
     *          name="max_altitude",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Location")
     *      ),
     *      @SWG\Parameter(
     *          name="point",
     *          in="body",
     *          description="Lat and Lng BY DMS system (Example: [48°49′24″N,2°18′26″E])",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Location")
     *      ),
     *      @SWG\Parameter(
     *          name="location_description",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Location")
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
     *                  ref="#/definitions/Plant"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePlantAPIRequest $request)
    {
        $input = $request->all();

        $plant = $this->plantRepository->create($input);

        return $this->sendResponse($plant->toArray(), 'Plant Herbarium saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/plants/{id}",
     *      summary="Display the specified Plant Herbarium",
     *      tags={"Plant"},
     *      description="Get Plant Herbarium",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Plant Herbarium",
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
     *                  ref="#/definitions/Plant"
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
        $relation_for_scientific_name = ['taxonomy.family', 'taxonomy.genus', 'taxonomy.species', 'taxonomy.subspecies', 'taxonomy.variety'];
        /** @var Plant $plant */
        $plant = $this->plantRepository->find($id,
            \request()->get('relations') ? array_merge($relation_for_scientific_name, \request()->get('relations')) : $relation_for_scientific_name
        );
        if (empty($plant)) {
            return $this->sendError('Plant Herbarium not found');
        }

        return $this->sendResponse($plant->toArray(), 'Plant Herbarium retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePlantAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/plants/{id}",
     *      summary="Update the specified Plant Herbarium in storage",
     *      tags={"Plant"},
     *      description="Update Plant Herbarium",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Plant Herbarium",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="general_phytogeography_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="protection_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="is_flowering",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="sheets_no",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="samples_no",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="tip_qt",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="physical_tip_qt",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="general_substrate_lichen_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="general_substrate_moss_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="general_substrate_diatom_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="general_origin_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="habitat_description",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="ecology_description",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="taxonomy_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="life_form_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="flowering_time",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="city_id",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Location")
     *      ),
     *      @SWG\Parameter(
     *          name="address",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Location")
     *      ),
     *      @SWG\Parameter(
     *          name="region_name",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Location")
     *      ),
     *      @SWG\Parameter(
     *          name="min_altitude",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Location")
     *      ),
     *      @SWG\Parameter(
     *          name="max_altitude",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Location")
     *      ),
     *      @SWG\Parameter(
     *          name="point",
     *          in="body",
     *          description="Lat and Lng BY DMS system (Example: [48°49′24″N,2°18′26″E])",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Location")
     *      ),
     *      @SWG\Parameter(
     *          name="location_description",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Location")
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
     *                  ref="#/definitions/Plant"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update(UpdatePlantAPIRequest $request, $id)
    {
        $input = $request->all();

        /** @var Plant $plant */
        $plant = $this->plantRepository->find($id, \request()->get('relations'));

        if (empty($plant)) {
            return $this->sendError('Plant Herbarium not found');
        }

        $plant = $this->plantRepository->update($input, $id);

        return $this->sendResponse($plant->toArray(), 'Plant Herbarium updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/plants/{id}",
     *      summary="Remove the specified Plant Herbarium from storage",
     *      tags={"Plant"},
     *      description="Delete Plant Herbarium",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Plant Herbarium",
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
        /** @var Plant $plant */
        $plant = $this->plantRepository->find($id, \request()->get('relations'));

        if (empty($plant)) {
            return $this->sendError('Plant Herbarium not found');
        }

        $plant->delete();

        return $this->sendResponse($id, 'Plant Herbarium deleted successfully');
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
