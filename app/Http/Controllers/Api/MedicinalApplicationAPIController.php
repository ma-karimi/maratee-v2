<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\MedicinalPlant\MedicinalApplicationAPIRequest;
use App\Models\MedicinalApplication;
use App\Repositories\MedicinalApplicationRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Response;

/**
 * Class MedicinalApplicationController
 * @package App\Http\Controllers\Api
 */
class MedicinalApplicationAPIController extends AppBaseController
{
    /** @var  MedicinalApplicationRepository */
    private $medicinalApplicationRepository;

    public function __construct(MedicinalApplicationRepository $medicinalApplicationRepo)
    {
        $this->medicinalApplicationRepository = $medicinalApplicationRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/medicinal_applications",
     *      summary="Get a listing of the MedicinalApplications.",
     *      tags={"MedicinalApplication"},
     *      description="Get all MedicinalApplications",
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
     *                  @SWG\Items(ref="#/definitions/MedicinalApplication")
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
        $applications = $this->medicinalApplicationRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $this->medicinalApplicationRepository->getRelationFields()
        );
        $keys = [
            ['name' => 'family', 'title' => 'Family', 'value' => false],
            ['name' => 'genus', 'title' => 'Genus', 'value' => false],
            ['name' => 'species', 'title' => 'Species', 'value' => false],
            ['name' => 'subspecies', 'title' => 'SubSpecies', 'value' => false],
            ['name' => 'variety', 'title' => 'Variety', 'value' => false],
            ['name' => 'scientific', 'title' => 'Scientific', 'value' => false],
            ['name' => 'local_name', 'title' => 'Local Name', 'value' => false],
            ['name' => 'plants_used', 'title' => 'Plants Used', 'value' => false],
            ['name' => 'import_export', 'title' => 'Import/Export', 'value' => false],
            ['name' => 'cultivate', 'title' => 'Cultivated area', 'value' => false],
            ['name' => 'industrial', 'title' => 'Industrial Potential', 'value' => false],
            ['name' => 'part_used', 'title' => 'Part Used', 'value' => false],
        ];
        return $this->sendResponse(compact('applications', 'keys'), 'Medicinal Applications retrieved successfully');
    }


    /**
     * @param MedicinalApplicationAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/medicinal_applications",
     *      summary="Store a newly created MedicinalApplication in storage",
     *      tags={"MedicinalApplication"},
     *      description="Store MedicinalApplication",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="taxonomy_id",
     *          in="body",
     *          description="MedicinalApplication that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalApplication")
     *      ),
     *      @SWG\Parameter(
     *          name="food_industries",
     *          in="body",
     *          description="from medicinal_plant_type",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalApplication")
     *      ),
     *      @SWG\Parameter(
     *          name="aerial_types",
     *          in="body",
     *          description="from medicinal_plant_type",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalApplication")
     *      ),
     *      @SWG\Parameter(
     *          name="general_origin_id",
     *          in="body",
     *          description="from medicinal_plant_type",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalApplication")
     *      ),
     *      @SWG\Parameter(
     *          name="hygienic_cosmetic_industry_id",
     *          in="body",
     *          description="from medicinal_plant_type",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalApplication")
     *      ),
     *      @SWG\Parameter(
     *          name="other_industries",
     *          in="body",
     *          description="from medicinal_plant_type",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalApplication")
     *      ),
     *      @SWG\Parameter(
     *          name="industrial_potentials",
     *          in="body",
     *          description="from medicinal_plant_type",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalApplication")
     *      ),
     *      @SWG\Parameter(
     *          name="traditional_iranian_medicine",
     *          in="body",
     *          description="0 -> raw , 1 -> processed",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalApplication")
     *      ),
     *      @SWG\Parameter(
     *          name="inherbal_medicine_store",
     *          in="body",
     *          description=" 1 => 'raw', 2 => 'processed'",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalApplication")
     *      ),
     *      @SWG\Parameter(
     *          name="natural_drug",
     *          in="body",
     *          description="0 -> Human medicines , 1 -> Animal drugs",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalApplication")
     *      ),
     *      @SWG\Parameter(
     *          name="exporting",
     *          in="body",
     *          description="0 -> raw , 1 -> processed",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalApplication")
     *      ),
     *      @SWG\Parameter(
     *          name="importing",
     *          in="body",
     *          description="0 -> raw , 1 -> processed",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalApplication")
     *      ),
     *      @SWG\Parameter(
     *          name="cultivated_area_id",
     *          in="body",
     *          description="0 -> raw , 1 -> processed",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalApplication")
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
     *                  ref="#/definitions/MedicinalApplication"
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
    public function store(MedicinalApplicationAPIRequest $request)
    {
        $input = $request->all();

        $medicinalPlant = $this->medicinalApplicationRepository->create($input);

        return $this->sendResponse($medicinalPlant->toArray(), 'Medicinal Plant saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/medicinal_applications/{id}",
     *      summary="Display the specified MedicinalApplication",
     *      tags={"MedicinalApplication"},
     *      description="Get MedicinalApplication",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MedicinalApplication",
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
     *                  ref="#/definitions/MedicinalApplication"
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
        /** @var MedicinalApplication $medicinalPlant */
        $medicinalPlant = $this->medicinalApplicationRepository->find($id, $this->medicinalApplicationRepository->getRelationFields());

        if ($medicinalPlant === null) {
            return $this->sendError('Medicinal Plant not found');
        }

        return $this->sendResponse($medicinalPlant->toArray(), 'Medicinal Plant retrieved successfully');
    }

    /**
     * @param int $id
     * @param MedicinalApplicationAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/medicinal_applications/{id}",
     *      summary="Update the specified MedicinalApplication in storage",
     *      tags={"MedicinalApplication"},
     *      description="Update MedicinalApplication",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MedicinalApplication",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="taxonomy_id",
     *          in="body",
     *          description="MedicinalApplication that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalApplication")
     *      ),
     *      @SWG\Parameter(
     *          name="food_industries",
     *          in="body",
     *          description="from medicinal_plant_type",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalApplication")
     *      ),
     *      @SWG\Parameter(
     *          name="aerial_types",
     *          in="body",
     *          description="from medicinal_plant_type",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalApplication")
     *      ),
     *      @SWG\Parameter(
     *          name="general_origin_id",
     *          in="body",
     *          description="from medicinal_plant_type",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalApplication")
     *      ),
     *      @SWG\Parameter(
     *          name="hygienic_cosmetic_industry_id",
     *          in="body",
     *          description="from medicinal_plant_type",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalApplication")
     *      ),
     *      @SWG\Parameter(
     *          name="other_industries",
     *          in="body",
     *          description="from medicinal_plant_type",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalApplication")
     *      ),
     *      @SWG\Parameter(
     *          name="industrial_potentials",
     *          in="body",
     *          description="from medicinal_plant_type",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalApplication")
     *      ),
     *      @SWG\Parameter(
     *          name="traditional_iranian_medicine",
     *          in="body",
     *          description="0 -> raw , 1 -> processed",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalApplication")
     *      ),
     *      @SWG\Parameter(
     *          name="inherbal_medicine_store",
     *          in="body",
     *          description=" 1 => 'raw', 2 => 'processed'",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalApplication")
     *      ),
     *      @SWG\Parameter(
     *          name="natural_drug",
     *          in="body",
     *          description="0 -> Human medicines , 1 -> Animal drugs",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalApplication")
     *      ),
     *      @SWG\Parameter(
     *          name="exporting",
     *          in="body",
     *          description="0 -> raw , 1 -> processed",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalApplication")
     *      ),
     *      @SWG\Parameter(
     *          name="importing",
     *          in="body",
     *          description="0 -> raw , 1 -> processed",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalApplication")
     *      ),
     *      @SWG\Parameter(
     *          name="cultivated_area_id",
     *          in="body",
     *          description="0 -> raw , 1 -> processed",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalApplication")
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
     *                  ref="#/definitions/MedicinalApplication"
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
    public function update(MedicinalApplicationAPIRequest $request, $id)
    {
        $input = $request->all();

        /** @var MedicinalApplication $medicinalPlant */
        $medicinalPlant = $this->medicinalApplicationRepository->find($id, []);

        if ($medicinalPlant === null) {
            return $this->sendError('Medicinal Plant not found');
        }

        $medicinalPlant = $this->medicinalApplicationRepository->update($input, $id);

        return $this->sendResponse($medicinalPlant->toArray(), 'MedicinalApplication updated successfully');
    }
}
