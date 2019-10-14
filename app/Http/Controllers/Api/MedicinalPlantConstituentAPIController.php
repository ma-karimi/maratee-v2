<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\MedicinalPlantConstituentAPIRequest;
use App\Repositories\MedicinalPlantConstituentRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Response;

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
     * @SWG\Post(
     *      path="/medicinalPlantConstituents/{id}/store",
     *      summary="Display the specified MedicinalPlantConstituent",
     *      tags={"MedicinalPlantConstituent"},
     *      description="Get MedicinalPlantConstituent",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MedicinalPlantConstituent",
     *          type="integer",
     *          required=true,
     *          in="path",
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantConstituent")
     *      ),
     *      @SWG\Parameter(
     *          name="constituents",
     *          type="array",
     *          required=true,
     *          in="body",
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantConstituent")
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

        $this->medicinalPlantConstituentRepository->storeItems($request, $id);

        return $this->sendResponse([], 'Medicinal Plant Constituent saved successfully');
    }

    /**
     * @param MedicinalPlantConstituentAPIRequest $request
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Put(
     *      path="/medicinalPlantConstituents/{id}/update",
     *      summary="Remove the specified MedicinalPlantConstituent from storage",
     *      tags={"MedicinalPlantConstituent"},
     *      description="Delete MedicinalPlantConstituent",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MedicinalPlantConstituent",
     *          type="integer",
     *          required=true,
     *          in="path",
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantConstituent")
     *      ),
     *      @SWG\Parameter(
     *          name="constituents",
     *          type="array",
     *          required=true,
     *          in="body",
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantConstituent")
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

        $this->medicinalPlantConstituentRepository->updateItems($request, $id);

        return $this->sendResponse([], 'Medicinal Plant Constituent updated successfully');

    }
}

