<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\MedicinalPlant\MedicinalLocationAPIRequest;
use App\Http\Requests\Api\MedicinalPlant\MedicinalLocationConstituentAPIRequest;
use App\Http\Requests\Api\MedicinalPlant\MedicinalLocationReferenceAPIRequest;
use App\Models\MedicinalLocation;
use App\Repositories\MedicinalLocationRepository;
use Exception;
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
     *          name="herbarium_number",
     *          in="body",
     *          description="MedicinalLocation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalLocation")
     *      ),
     *      @SWG\Parameter(
     *          name="medicinal_plant_id",
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
     *          name="presence_in_country",
     *          in="body",
     *          description="0 -> native , 1 -> endemic",
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
     *          name="herbarium_number",
     *          in="body",
     *          description="MedicinalLocation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalLocation")
     *      ),
     *      @SWG\Parameter(
     *          name="medicinal_plant_id",
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
     *          name="presence_in_country",
     *          in="body",
     *          description="0 -> native , 1 -> endemic",
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

    /**
     * @param int $id
     * @return Response
     *
     * @throws Exception
     * @SWG\Delete(
     *      path="/medicinal_locations/{id}",
     *      summary="Remove the specified MedicinalLocation from storage",
     *      tags={"MedicinalLocation"},
     *      description="Delete MedicinalLocation",
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
        /** @var MedicinalLocation $medicinalPlant */
        $medicinalPlant = $this->medicinalLocationRepository->find($id, []);

        if ($medicinalPlant === null) {
            return $this->sendError('Medicinal Location not found');
        }

        $medicinalPlant->delete();

        return $this->sendResponse($id, 'Medicinal Location deleted successfully');
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
}
