<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\MedicinalPlant\MedicinalPlantAPIRequest;
use App\Models\MedicinalPlant;
use App\Repositories\MedicinalPlantRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
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
     * @throws Exception
     */
    public function index(Request $request)
    {
        $medicinalPlants = $this->medicinalPlantRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $this->medicinalPlantRepository->getRelationFields()
        );

        $keys = [
            ['name' => 'family', 'title' => 'Family', 'value' => false],
            ['name' => 'genus', 'title' => 'Genus', 'value' => false],
            ['name' => 'species', 'title' => 'Species', 'value' => false],
            ['name' => 'subspecies', 'title' => 'SubSpecies', 'value' => false],
            ['name' => 'variety', 'title' => 'Variety', 'value' => false],
            ['name' => 'scientific', 'title' => 'Scientific', 'value' => false],
            ['name' => 'local_name', 'title' => 'Local Name', 'value' => false],
            ['name' => 'origin', 'title' => 'Origin', 'value' => false],
            ['name' => 'part_used', 'title' => 'Part Used', 'value' => false],
//            ['name' => 'wooden', 'title' => 'Wooden', 'value' => false],
//            ['name' => 'habitat', 'title' => 'Habitat', 'value' => false],
//            ['name' => 'herbaceous', 'title' => 'Herbaceous', 'value' => false],
//            ['name' => 'cycle', 'title' => 'Cycle', 'value' => false],
            ['name' => 'properties', 'title' => 'Properties', 'value' => false],
            ['name' => 'metabolite', 'title' => 'Metabolite', 'value' => false],

        ];
        return $this->sendResponse(compact('medicinalPlants', 'keys'), 'Medicinal Plants retrieved successfully');
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
     *          name="taxonomy_id",
     *          in="body",
     *          description="MedicinalPlant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="aerialTypes",
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
     *          name="metabolites",
     *          in="body",
     *          description="from medicinal_plant_type",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="properties_description",
     *          in="body",
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
     *          name="code_no",
     *          in="body",
     *          description="code_no",
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
     * @throws ValidationException
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
        $medicinalPlant = $this->medicinalPlantRepository->find($id, $this->medicinalPlantRepository->getRelationFields());

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
     *          name="taxonomy_id",
     *          in="body",
     *          description="MedicinalPlant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="aerialTypes",
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
     *          name="metabolites",
     *          in="body",
     *          description="from medicinal_plant_type",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlant")
     *      ),
     *      @SWG\Parameter(
     *          name="properties_description",
     *          in="body",
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
     *          name="code_no",
     *          in="body",
     *          description="code_no",
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
     * @throws ValidationException
     */
    public function update(MedicinalPlantAPIRequest $request, $id)
    {
        $input = $request->all();

        /** @var MedicinalPlant $medicinalPlant */
        $medicinalPlant = $this->medicinalPlantRepository->find($id, []);

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
     * @throws Exception
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
        $medicinalPlant = $this->medicinalPlantRepository->find($id, []);

        if ($medicinalPlant === null) {
            return $this->sendError('Medicinal Plant not found');
        }

        $medicinalPlant->delete();

        return $this->sendResponse($id, 'Medicinal Plant deleted successfully');
    }
}
