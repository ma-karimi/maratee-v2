<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateMedicinalPlantMethodAPIRequest;
use App\Http\Requests\Api\UpdateMedicinalPlantMethodAPIRequest;
use App\Models\MedicinalPlantMethod;
use App\Repositories\MedicinalPlantMethodRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class MedicinalPlantMethodAPIController
 * @package App\Http\Controllers\Api
 */

class MedicinalPlantMethodAPIController extends AppBaseController
{
    /** @var  MedicinalPlantMethodRepository */
    private $medicinalPlantMethodRepository;

    public function __construct(MedicinalPlantMethodRepository $medicinalPlantMethodRepo)
    {
        $this->medicinalPlantMethodRepository = $medicinalPlantMethodRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/medicinal_plant_methods",
     *      summary="Get a listing of the MedicinalPlantMethods.",
     *      tags={"MedicinalPlantMethod"},
     *      description="Get all MedicinalPlantMethods",
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
     *                  @SWG\Items(ref="#/definitions/MedicinalPlantMethod")
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
        $medicinalPlantMethods = $this->medicinalPlantMethodRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($medicinalPlantMethods->toArray(), 'Medicinal Plant Constituents retrieved successfully');
    }

    /**
     * @param CreateMedicinalPlantMethodAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/medicinal_plant_methods",
     *      summary="Store a newly created MedicinalPlantMethod in storage",
     *      tags={"MedicinalPlantMethod"},
     *      description="Store MedicinalPlantMethod",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="medicinal_plant_id",
     *          in="body",
     *          description="MedicinalPlantMethod that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantMethod")
     *      ),
     *      @SWG\Parameter(
     *          name="constituent_id",
     *          in="body",
     *          description="MedicinalPlantMethod that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantMethod")
     *      ),
     *      @SWG\Parameter(
     *          name="value",
     *          in="body",
     *          description="MedicinalPlantMethod that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantMethod")
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
     *                  ref="#/definitions/MedicinalPlantMethod"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateMedicinalPlantMethodAPIRequest $request)
    {
        $input = $request->all();

        $medicinalPlantMethod = $this->medicinalPlantMethodRepository->create($input);

        return $this->sendResponse($medicinalPlantMethod->toArray(), 'Medicinal Plant Constituent saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/medicinal_plant_methods/{id}",
     *      summary="Display the specified MedicinalPlantMethod",
     *      tags={"MedicinalPlantMethod"},
     *      description="Get MedicinalPlantMethod",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MedicinalPlantMethod",
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
     *                  ref="#/definitions/MedicinalPlantMethod"
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
        /** @var MedicinalPlantMethod $medicinalPlantMethod */
        $medicinalPlantMethod = $this->medicinalPlantMethodRepository->find($id, \request()->get('relations'));

        if ($medicinalPlantMethod === null) {
            return $this->sendError('Medicinal Plant Constituent not found');
        }

        return $this->sendResponse($medicinalPlantMethod->toArray(), 'Medicinal Plant Constituent retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateMedicinalPlantMethodAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/medicinal_plant_methods/{id}",
     *      summary="Update the specified MedicinalPlantMethod in storage",
     *      tags={"MedicinalPlantMethod"},
     *      description="Update MedicinalPlantMethod",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MedicinalPlantMethod",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="medicinal_plant_id",
     *          in="body",
     *          description="MedicinalPlantMethod that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantMethod")
     *      ),
     *      @SWG\Parameter(
     *          name="constituent_id",
     *          in="body",
     *          description="MedicinalPlantMethod that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantMethod")
     *      ),
     *      @SWG\Parameter(
     *          name="value",
     *          in="body",
     *          description="MedicinalPlantMethod that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantMethod")
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
     *                  ref="#/definitions/MedicinalPlantMethod"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateMedicinalPlantMethodAPIRequest $request)
    {
        $input = $request->all();

        /** @var MedicinalPlantMethod $medicinalPlantMethod */
        $medicinalPlantMethod = $this->medicinalPlantMethodRepository->find($id, \request()->get('relations'));

        if ($medicinalPlantMethod === null) {
            return $this->sendError('Medicinal Plant Constituent not found');
        }

        $medicinalPlantMethod = $this->medicinalPlantMethodRepository->update($input, $id);

        return $this->sendResponse($medicinalPlantMethod->toArray(), 'MedicinalPlantMethod updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/medicinal_plant_methods/{id}",
     *      summary="Remove the specified MedicinalPlantMethod from storage",
     *      tags={"MedicinalPlantMethod"},
     *      description="Delete MedicinalPlantMethod",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MedicinalPlantMethod",
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
        /** @var MedicinalPlantMethod $medicinalPlantMethod */
        $medicinalPlantMethod = $this->medicinalPlantMethodRepository->find($id, \request()->get('relations'));

        if (empty($medicinalPlantMethod)) {
            return $this->sendError('Medicinal Plant Constituent not found');
        }

        $medicinalPlantMethod->delete();

        return $this->sendResponse($id, 'Medicinal Plant Constituent deleted successfully');
    }
}
