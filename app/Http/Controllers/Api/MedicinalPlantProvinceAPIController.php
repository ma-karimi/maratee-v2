<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\MedicinalPlantProvinceAPIRequest;
use App\Repositories\MedicinalPlantProvinceRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Response;

/**
 * Class MedicinalPlantProvinceController
 * @package App\Http\Controllers\Api
 */

class MedicinalPlantProvinceAPIController extends AppBaseController
{
    /** @var  MedicinalPlantProvinceRepository */
    private $medicinalPlantProvinceRepository;

    public function __construct(MedicinalPlantProvinceRepository $medicinalPlantProvinceRepo)
    {
        $this->medicinalPlantProvinceRepository = $medicinalPlantProvinceRepo;
    }


    /**
     * @param MedicinalPlantProvinceAPIRequest $request
     * @param int $id
     * @return Response
     *
     * @SWG\Post(
     *      path="medicinal_plants/{medicinal_plant_id}/provinces",
     *      summary="Display the specified MedicinalPlantProvince",
     *      tags={"MedicinalPlantProvince"},
     *      description="Get MedicinalPlantProvince",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="medicinal_plant_id",
     *          description="id of MedicinalPlant",
     *          type="integer",
     *          required=true,
     *          in="path",
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantProvince")
     *      ),
     *      @SWG\Parameter(
     *          name="provinces",
     *          type="array",
     *          required=true,
     *          in="body",
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantProvince")
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
     *                  ref="#/definitions/MedicinalPlantProvince"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(MedicinalPlantProvinceAPIRequest $request, $id)
    {

        $this->medicinalPlantProvinceRepository->storeItems($request, $id);

        return $this->sendResponse([], 'Medicinal Plant Province saved successfully');
    }

    /**
     * @param MedicinalPlantProvinceAPIRequest $request
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Put(
     *      path="medicinal_plants/{medicinal_plant_id}/provinces",
     *      summary="Remove the specified MedicinalPlantProvince from storage",
     *      tags={"MedicinalPlantProvince"},
     *      description="Delete MedicinalPlantProvince",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="medicinal_plant_id",
     *          description="id of MedicinalPlant",
     *          type="integer",
     *          required=true,
     *          in="path",
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantProvince")
     *      ),
     *      @SWG\Parameter(
     *          name="provinces",
     *          type="array",
     *          required=true,
     *          in="body",
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantProvince")
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

    public function update(MedicinalPlantProvinceAPIRequest $request, $id)
    {

        $this->medicinalPlantProvinceRepository->updateItems($request, $id);

        return $this->sendResponse([], 'Medicinal Plant Province updated successfully');

    }
}

