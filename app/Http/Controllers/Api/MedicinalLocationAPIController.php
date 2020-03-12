<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\MedicinalPlant\MedicinalLocationAPIRequest;
use App\Http\Requests\Api\MedicinalPlant\MedicinalLocationConstituentAPIRequest;
use App\Http\Requests\Api\MedicinalPlant\MedicinalLocationReferenceAPIRequest;
use App\Models\MedicinalLocation;
use App\Repositories\MedicinalLocationRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Response;

/**
 * Class MedicinalLocationAPIController
 * @package App\Http\Controllers\Api
 */
class MedicinalLocationAPIController extends AppBaseController
{
    /** @var  MedicinalLocationRepository */
    private $medicinalLocationRepository;

    public function __construct(MedicinalLocationRepository $medicinalPlantRepo)
    {
        $this->medicinalLocationRepository = $medicinalPlantRepo;
    }
    /**
     * @param Request $request
     * @return Response
     *
     * @throws Exception
     * @SWG\Get(
     *      path="/medicinal_locations",
     *      summary="Get a listing of the Natural Compounds",
     *      tags={"Plant"},
     *      description="Get all Natural Compounds",
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

        $compounds = $this->medicinalLocationRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $this->getRelationFields()
        );

        $keys = [
            ['name' => 'family', 'title' => 'Family', 'value' => false],
            ['name' => 'genus', 'title' => 'Genus', 'value' => false],
            ['name' => 'species', 'title' => 'Species', 'value' => false],
            ['name' => 'subspecies', 'title' => 'SubSpecies', 'value' => false],
            ['name' => 'variety', 'title' => 'Variety', 'value' => false],
            ['name' => 'scientific', 'title' => 'Scientific', 'value' => false],
            ['name' => 'local_name', 'title' => 'Local Name', 'value' => false],
        ];
        return $this->sendResponse(compact('compounds', 'keys'), 'Natural Compounds retrieved successfully');
    }

    /**
     * @param MedicinalLocationAPIRequest $request
     * @return Response
     *
     * @throws ValidationException
     * @SWG\Post(
     *      path="/medicinal_locations",
     *      summary="Store a newly created MedicinalLocation in storage",
     *      tags={"MedicinalLocation"},
     *      description="Store MedicinalLocation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="taxonomy_id",
     *          in="body",
     *          description="MedicinalLocation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalLocation")
     *      ),
     *      @SWG\Parameter(
     *          name="article_id",
     *          in="body",
     *          description="MedicinalLocation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalLocation")
     *      ),
     *      @SWG\Parameter(
     *          name="general_phenology_id",
     *          in="body",
     *          description="from general",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalLocation")
     *      ),
     *      @SWG\Parameter(
     *          name="method_distillation_id",
     *          in="body",
     *          description="from methods",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalLocation")
     *      ),
     *      @SWG\Parameter(
     *          name="method_extraction_id",
     *          in="body",
     *          description="from methods",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalLocation")
     *      ),
     *      @SWG\Parameter(
     *          name="method_analyse_id",
     *          in="body",
     *          description="from methods",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalLocation")
     *      ),
     *      @SWG\Parameter(
     *          name="metabolites",
     *          in="body",
     *          description="from medicinal_plant_type",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalLocation")
     *      ),
     *      @SWG\Parameter(
     *          name="treatment_id",
     *          in="body",
     *          description="from medicinal_plant_type",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalLocation")
     *      ),
     *      @SWG\Parameter(
     *          name="studied_sample",
     *          in="body",
     *          description="0 -> wild , 1 -> cultivated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalLocation")
     *      ),
     *      @SWG\Parameter(
     *          name="collecting_year",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalLocation")
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
     *                  ref="#/definitions/MedicinalLocation"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(MedicinalLocationAPIRequest $request)
    {
        $input = $request->all();

        $medicinalPlant = $this->medicinalLocationRepository->create($input);

        return $this->sendResponse($medicinalPlant->toArray(), 'Medicinal Location saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/medicinal_locations/{id}",
     *      summary="Display the specified MedicinalLocation",
     *      tags={"MedicinalLocation"},
     *      description="Get MedicinalLocation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MedicinalLocation",
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
     *                  ref="#/definitions/MedicinalLocation"
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
        /** @var MedicinalLocation $medicinalPlant */
        $medicinalPlant = $this->medicinalLocationRepository->find($id, $this->getRelationFields());

        if ($medicinalPlant === null) {
            return $this->sendError('Medicinal Location not found');
        }

        return $this->sendResponse($medicinalPlant->toArray(), 'Medicinal Location retrieved successfully');
    }

    /**
     * @param int $id
     * @param MedicinalLocationAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/medicinal_locations/{id}",
     *      summary="Update the specified MedicinalLocation in storage",
     *      tags={"MedicinalLocation"},
     *      description="Update MedicinalLocation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MedicinalLocation",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="taxonomy_id",
     *          in="body",
     *          description="MedicinalLocation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalLocation")
     *      ),
     *      @SWG\Parameter(
     *          name="article_id",
     *          in="body",
     *          description="MedicinalLocation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalLocation")
     *      ),
     *      @SWG\Parameter(
     *          name="general_phenology_id",
     *          in="body",
     *          description="from general",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalLocation")
     *      ),
     *      @SWG\Parameter(
     *          name="method_distillation_id",
     *          in="body",
     *          description="from methods",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalLocation")
     *      ),
     *      @SWG\Parameter(
     *          name="method_extraction_id",
     *          in="body",
     *          description="from methods",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalLocation")
     *      ),
     *      @SWG\Parameter(
     *          name="method_analyse_id",
     *          in="body",
     *          description="from methods",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalLocation")
     *      ),
     *      @SWG\Parameter(
     *          name="metabolites",
     *          in="body",
     *          description="from medicinal_plant_type",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalLocation")
     *      ),
     *      @SWG\Parameter(
     *          name="treatment_id",
     *          in="body",
     *          description="from medicinal_plant_type",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalLocation")
     *      ),
     *      @SWG\Parameter(
     *          name="studied_sample",
     *          in="body",
     *          description="0 -> wild , 1 -> cultivated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalLocation")
     *      ),
     *      @SWG\Parameter(
     *          name="collecting_year",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalLocation")
     *      ),
     *      @SWG\Parameter(
     *          name="location_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/MedicinalLocation")
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
     *                  ref="#/definitions/MedicinalLocation"
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
    public function update(MedicinalLocationAPIRequest $request, $id)
    {
        $input = $request->all();

        /** @var MedicinalLocation $medicinalPlant */
        $medicinalPlant = $this->medicinalLocationRepository->find($id, []);

        if ($medicinalPlant === null) {
            return $this->sendError('Medicinal Location not found');
        }

        $medicinalPlant = $this->medicinalLocationRepository->update($input, $id);

        return $this->sendResponse($medicinalPlant->toArray(), 'MedicinalLocation updated successfully');
    }


    public function storeReference(MedicinalLocationReferenceAPIRequest $request, $id)
    {
        $input = $request->all();

        /** @var MedicinalLocation $medicinalPlant */
        $medicinalPlant = $this->medicinalLocationRepository->find($id, []);

        if ($medicinalPlant === null) {
            return $this->sendError('Medicinal Location not found');
        }

        $medicinalPlant = $this->medicinalLocationRepository->storeReference($input, $id);

        return $this->sendResponse($medicinalPlant->toArray(), 'MedicinalLocation updated successfully');
    }

    public function storeConstituent(MedicinalLocationConstituentAPIRequest $request, $id)
    {
        $input = $request->all();

        /** @var MedicinalLocation $medicinalPlant */
        $medicinalLocation = $this->medicinalLocationRepository->find($id, []);

        if ($medicinalLocation === null) {
            return $this->sendError('Medicinal Location not found');
        }

        $this->medicinalLocationRepository->storeConstituent($input, $id);

        return $this->sendResponse($medicinalLocation->toArray(), 'MedicinalLocation updated successfully');
    }

    /**
     * @return array
     */
    public function getRelationFields(): array
    {
        return ['location', 'constituents', 'treatment', 'distillation', 'secondaryMetabolites', 'phenology', 'distillation', 'extraction', 'analyse', 'article'];
    }
}
