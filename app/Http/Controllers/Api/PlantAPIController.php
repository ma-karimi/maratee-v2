<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\CreatePlantAPIRequest;
use App\Http\Requests\Api\UpdatePlantAPIRequest;
use App\Http\Requests\MediaAPIRequest;
use App\Repositories\PlantRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

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
     * @throws Exception
     * @SWG\Get(
     *      path="/plants",
     *      summary="Get a listing of the Plants & Plant has flowering herbarium",
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

        $plants = $this->plantRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $this->plantRepository->getRelationFields()
        );

        $keys = [
            ['name' => 'family', 'title' => 'Family', 'value' => false],
            ['name' => 'genus', 'title' => 'Genus', 'value' => false],
            ['name' => 'species', 'title' => 'Species', 'value' => false],
            ['name' => 'subspecies', 'title' => 'SubSpecies', 'value' => false],
            ['name' => 'variety', 'title' => 'Variety', 'value' => false],
            ['name' => 'scientific', 'title' => 'Scientific', 'value' => false],
            ['name' => 'local_name', 'title' => 'Local Name', 'value' => false],
            ['name' => 'author', 'title' => 'Author', 'value' => false],
            ['name' => 'distribution', 'title' => 'Distribution', 'value' => false],
            ['name' => 'life_form', 'title' => 'LifeForm', 'value' => false],
            ['name' => 'dna', 'title' => 'DNA', 'value' => false],
        ];
        return $this->sendResponse(compact('plants', 'keys'), 'Plants retrieved successfully');
    }


    /**
     * @param CreatePlantAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/plants",
     *      summary="Store a newly created Plant in storage",
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
     *          name="general_substrate_id",
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
     *          name="geographical_description",
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
     * @throws ValidationException
     */
    public function store(CreatePlantAPIRequest $request)
    {

        $plant = $this->plantRepository->create($request);

        return $this->sendResponse($plant->toArray(), 'Plant saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/plants/{id}",
     *      summary="Display the specified Plant",
     *      tags={"Plant"},
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

        $plant = $this->plantRepository->find($id, $this->plantRepository->getRelationFields());

        if (empty($plant)) {
            return $this->sendError('Plant not found');
        }

        return $this->sendResponse($plant->toArray(), 'Plant retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePlantAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/plants/{id}",
     *      summary="Update the specified Plant in storage",
     *      tags={"Plant"},
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
     *          name="general_substrate_id",
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
     * @throws ValidationException
     */
    public function update(UpdatePlantAPIRequest $request, $id)
    {

        $plant = $this->plantRepository->find($id, []);

        if (empty($plant)) {
            return $this->sendError('Plant not found');
        }

        $plant = $this->plantRepository->update($request, $id);

        return $this->sendResponse($plant->toArray(), 'Plant updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws Exception
     * @SWG\Delete(
     *      path="/plants/{id}",
     *      summary="Remove the specified Plant from storage",
     *      tags={"Plant"},
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
        $plant = $this->plantRepository->find($id, []);

        if (empty($plant)) {
            return $this->sendError('Plant not found');
        }

        $plant->delete();

        return $this->sendResponse($id, 'Plant deleted successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Post(
     *      path="/plants/{id}/media",
     *      tags={"Plant"},
     *      description="Store Plant Media",
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
     * @throws Exception
     */
    public function media(MediaAPIRequest $mediaAPIRequest, $id)
    {
        $plant = $this->plantRepository->find($id, []);

        if (empty($plant)) {
            return $this->sendError('Plant not found');
        }

        $this->plantRepository->storeMedia($mediaAPIRequest->all(), $plant);

        return $this->sendResponse($id, 'Plant Media Stored successfully');
    }


    public function excel(Request $request)
    {
        $plants = $this->plantRepository->all(
            [],
            null,
            null,
            $this->plantRepository->getRelationFields()
        );

        return Excel::create("ExportFloraList-" . date('Y-m-d-H-i-s'), function ($excel) use ($plants) {

            $excel->sheet('Flora', function ($sheet) use ($plants) {
                $sheet->freezeFirstRow()
                    ->loadView('exports.flora', compact('plants'));

            });

        })->export('xls');
    }
}
