<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateMedicinalPlantTypeAPIRequest;
use App\Http\Requests\Api\UpdateMedicinalPlantTypeAPIRequest;
use App\Models\MedicinalPlantType;
use App\Repositories\MedicinalPlantTypeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Cache;
use Response;

/**
 * Class MedicinalPlantTypeController
 * @package App\Http\Controllers\Api
 */
class MedicinalPlantTypeAPIController extends AppBaseController
{
    /** @var  MedicinalPlantTypeRepository */
    private $medicinalPlantTypeRepository;

    public function __construct(MedicinalPlantTypeRepository $medicinalPlantTypeRepo)
    {
        $this->medicinalPlantTypeRepository = $medicinalPlantTypeRepo;
    }

    /**
     * @return Response
     *
     * @SWG\Get(
     *      path="/medicinal_plant_types",
     *      summary="Get a listing of the MedicinalPlantTypes.",
     *      tags={"MedicinalPlantType"},
     *      description="Get all MedicinalPlantTypes",
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
     *                  @SWG\Items(ref="#/definitions/MedicinalPlantType")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     * @throws \Exception
     */
    public function index()
    {
        $medicinalPlantTypes =
             $this->medicinalPlantTypeRepository->all();


        return $this->sendResponse($medicinalPlantTypes->toArray(), 'Medicinal Plant Types retrieved successfully');
    }

    /**
     * @param CreateMedicinalPlantTypeAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/medicinal_plant_types",
     *      summary="Store a newly created MedicinalPlantType in storage",
     *      tags={"MedicinalPlantType"},
     *      description="Store MedicinalPlantType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="MedicinalPlantType that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantType")
     *      ),
     *      @SWG\Parameter(
     *          name="type_id",
     *          in="body",
     *          description="MedicinalPlantType that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantType")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="MedicinalPlantType that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantType")
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
     *                  ref="#/definitions/MedicinalPlantType"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateMedicinalPlantTypeAPIRequest $request)
    {
        $input = $request->all();

        $medicinalPlantType = $this->medicinalPlantTypeRepository->create($input);

        return $this->sendResponse($medicinalPlantType->toArray(), 'Medicinal Plant Type saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/medicinalPlantTypes/{id}",
     *      summary="Display the specified MedicinalPlantType",
     *      tags={"MedicinalPlantType"},
     *      description="Get MedicinalPlantType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MedicinalPlantType",
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
     *                  ref="#/definitions/MedicinalPlantType"
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
        /** @var MedicinalPlantType $medicinalPlantType */
        $medicinalPlantType = $this->medicinalPlantTypeRepository->find($id);

        if (empty($medicinalPlantType)) {
            return $this->sendError('Medicinal Plant Type not found');
        }

        return $this->sendResponse($medicinalPlantType->toArray(), 'Medicinal Plant Type retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateMedicinalPlantTypeAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/medicinalPlantTypes/{id}",
     *      summary="Update the specified MedicinalPlantType in storage",
     *      tags={"MedicinalPlantType"},
     *      description="Update MedicinalPlantType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MedicinalPlantType",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="MedicinalPlantType that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantType")
     *      ),
     *      @SWG\Parameter(
     *          name="type_id",
     *          in="body",
     *          description="MedicinalPlantType that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantType")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="MedicinalPlantType that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantType")
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
     *                  ref="#/definitions/MedicinalPlantType"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateMedicinalPlantTypeAPIRequest $request)
    {
        $input = $request->all();

        /** @var MedicinalPlantType $medicinalPlantType */
        $medicinalPlantType = $this->medicinalPlantTypeRepository->find($id);

        if (empty($medicinalPlantType)) {
            return $this->sendError('Medicinal Plant Type not found');
        }

        $medicinalPlantType = $this->medicinalPlantTypeRepository->update($input, $id);

        return $this->sendResponse($medicinalPlantType->toArray(), 'MedicinalPlantType updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/medicinalPlantTypes/{id}",
     *      summary="Remove the specified MedicinalPlantType from storage",
     *      tags={"MedicinalPlantType"},
     *      description="Delete MedicinalPlantType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MedicinalPlantType",
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
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var MedicinalPlantType $medicinalPlantType */
        $medicinalPlantType = $this->medicinalPlantTypeRepository->find($id);

        if (empty($medicinalPlantType)) {
            return $this->sendError('Medicinal Plant Type not found');
        }

        $medicinalPlantType->delete();

        return $this->sendResponse($id, 'Medicinal Plant Type deleted successfully');
    }
}
