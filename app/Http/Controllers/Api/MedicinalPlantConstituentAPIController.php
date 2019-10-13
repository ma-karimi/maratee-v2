<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateMedicinalPlantConstituentAPIRequest;
use App\Http\Requests\Api\UpdateMedicinalPlantConstituentAPIRequest;
use App\Http\Requests\Api\MedicinalPlantConstituentAPIRequest;
use App\Models\MedicinalPlantConstituent;
use App\Repositories\MedicinalPlantConstituentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class MedicinalPlantConstituentController
 * @package App\Http\Controllers\Api
 */

class MedicinalPlantConstituentAPIController extends AppBaseController
{
    /** @var  MedicinalPlantConstituentRepository */
    private $medicinalPlantConstituentRepository;

    public function __construct(MedicinalPlantConstituentRepository $medicinalPlantConstituentRepo)
    {
        $this->medicinalPlantConstituentRepository = $medicinalPlantConstituentRepo;
    }


    /**
     * @param MedicinalPlantConstituentAPIRequest $request
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/medicinalPlantConstituents/{id}",
     *      summary="Display the specified MedicinalPlantConstituent",
     *      tags={"MedicinalPlantConstituent"},
     *      description="Get MedicinalPlantConstituent",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MedicinalPlantConstituent",
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
     *                  ref="#/definitions/MedicinalPlantConstituent"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(MedicinalPlantConstituentAPIRequest $request, $id)
    {
        /** @var MedicinalPlantConstituent $medicinalPlantConstituent */
        $medicinalPlantConstituent = $this->medicinalPlantConstituentRepository->find($id, \request()->get('relations'));

        if ($medicinalPlantConstituent === null) {
            return $this->sendError('Medicinal Plant Constituent not found');
        }
        $this->medicinalPlantConstituentRepository->storeItems($request, $id);

        //return $this->sendResponse($medicinalPlantConstituent->toArray(), 'Medicinal Plant Constituent retrieved successfully');
        return $this->sendResponse([], 'Medicinal Plant Constituent saved successfully');
    }

    /**
     * @param MedicinalPlantConstituentAPIRequest $request
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/medicinalPlantConstituents/{id}",
     *      summary="Remove the specified MedicinalPlantConstituent from storage",
     *      tags={"MedicinalPlantConstituent"},
     *      description="Delete MedicinalPlantConstituent",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MedicinalPlantConstituent",
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

    public function update(MedicinalPlantConstituentAPIRequest $request, $id)
    {
        /** @var MedicinalPlantConstituent $medicinalPlantConstituent */
        $medicinalPlantConstituent = $this->medicinalPlantConstituentRepository->find($id, \request()->get('relations'));

        if ($medicinalPlantConstituent === null) {
            return $this->sendError('Medicinal Plant Constituent not found');
        }
        $this->medicinalPlantConstituentRepository->updateItems($request, $id);

        $medicinalPlantConstituent->delete();

        return $this->sendResponse($id, 'Medicinal Plant Constituent deleted successfully');

    }
}

