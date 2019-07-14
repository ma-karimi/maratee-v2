<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateMedicinalPlantMorphologyAPIRequest;
use App\Http\Requests\Api\UpdateMedicinalPlantMorphologyAPIRequest;
use App\Models\MedicinalPlantMorphology;
use App\Repositories\MedicinalPlantMorphologyRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class MedicinalPlantMorphologyController
 * @package App\Http\Controllers\Api
 */

class MedicinalPlantMorphologyAPIController extends AppBaseController
{
    /** @var  MedicinalPlantMorphologyRepository */
    private $medicinalPlantMorphologyRepository;

    public function __construct(MedicinalPlantMorphologyRepository $medicinalPlantMorphologyRepo)
    {
        $this->medicinalPlantMorphologyRepository = $medicinalPlantMorphologyRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/medicinalPlantMorphologies",
     *      summary="Get a listing of the MedicinalPlantMorphologies.",
     *      tags={"MedicinalPlantMorphology"},
     *      description="Get all MedicinalPlantMorphologies",
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
     *                  @SWG\Items(ref="#/definitions/MedicinalPlantMorphology")
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
        $medicinalPlantMorphologies = $this->medicinalPlantMorphologyRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($medicinalPlantMorphologies->toArray(), 'Medicinal Plant Morphologies retrieved successfully');
    }

    /**
     * @param CreateMedicinalPlantMorphologyAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/medicinalPlantMorphologies",
     *      summary="Store a newly created MedicinalPlantMorphology in storage",
     *      tags={"MedicinalPlantMorphology"},
     *      description="Store MedicinalPlantMorphology",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
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
     *                  ref="#/definitions/MedicinalPlantMorphology"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateMedicinalPlantMorphologyAPIRequest $request)
    {
        $input = $request->all();

        $medicinalPlantMorphology = $this->medicinalPlantMorphologyRepository->create($input);

        return $this->sendResponse($medicinalPlantMorphology->toArray(), 'Medicinal Plant Morphology saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/medicinalPlantMorphologies/{id}",
     *      summary="Display the specified MedicinalPlantMorphology",
     *      tags={"MedicinalPlantMorphology"},
     *      description="Get MedicinalPlantMorphology",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MedicinalPlantMorphology",
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
     *                  ref="#/definitions/MedicinalPlantMorphology"
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
        /** @var MedicinalPlantMorphology $medicinalPlantMorphology */
        $medicinalPlantMorphology = $this->medicinalPlantMorphologyRepository->find($id);

        if (empty($medicinalPlantMorphology)) {
            return $this->sendError('Medicinal Plant Morphology not found');
        }

        return $this->sendResponse($medicinalPlantMorphology->toArray(), 'Medicinal Plant Morphology retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateMedicinalPlantMorphologyAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/medicinalPlantMorphologies/{id}",
     *      summary="Update the specified MedicinalPlantMorphology in storage",
     *      tags={"MedicinalPlantMorphology"},
     *      description="Update MedicinalPlantMorphology",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MedicinalPlantMorphology",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="MedicinalPlantMorphology that should be updated",
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
     *                  ref="#/definitions/MedicinalPlantMorphology"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateMedicinalPlantMorphologyAPIRequest $request)
    {
        $input = $request->all();

        /** @var MedicinalPlantMorphology $medicinalPlantMorphology */
        $medicinalPlantMorphology = $this->medicinalPlantMorphologyRepository->find($id);

        if (empty($medicinalPlantMorphology)) {
            return $this->sendError('Medicinal Plant Morphology not found');
        }

        $medicinalPlantMorphology = $this->medicinalPlantMorphologyRepository->update($input, $id);

        return $this->sendResponse($medicinalPlantMorphology->toArray(), 'MedicinalPlantMorphology updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/medicinalPlantMorphologies/{id}",
     *      summary="Remove the specified MedicinalPlantMorphology from storage",
     *      tags={"MedicinalPlantMorphology"},
     *      description="Delete MedicinalPlantMorphology",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MedicinalPlantMorphology",
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
        /** @var MedicinalPlantMorphology $medicinalPlantMorphology */
        $medicinalPlantMorphology = $this->medicinalPlantMorphologyRepository->find($id);

        if (empty($medicinalPlantMorphology)) {
            return $this->sendError('Medicinal Plant Morphology not found');
        }

        $medicinalPlantMorphology->delete();

        return $this->sendResponse($id, 'Medicinal Plant Morphology deleted successfully');
    }
}
