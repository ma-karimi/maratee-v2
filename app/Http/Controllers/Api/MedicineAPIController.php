<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateMedicineAPIRequest;
use App\Http\Requests\Api\UpdateMedicineAPIRequest;
use App\Models\Medicine;
use App\Repositories\MedicineRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class MedicineController
 * @package App\Http\Controllers\Api
 */

class MedicineAPIController extends AppBaseController
{
    /** @var  MedicineRepository */
    private $medicineRepository;

    public function __construct(MedicineRepository $medicineRepo)
    {
        $this->medicineRepository = $medicineRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/medicines",
     *      summary="Get a listing of the Medicines.",
     *      tags={"Medicine"},
     *      description="Get all Medicines",
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
     *                  @SWG\Items(ref="#/definitions/Medicine")
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
        $medicines = $this->medicineRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($medicines->toArray(), 'Medicines retrieved successfully');
    }

    /**
     * @param CreateMedicineAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/medicines",
     *      summary="Store a newly created Medicine in storage",
     *      tags={"Medicine"},
     *      description="Store Medicine",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="Medicine that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Medicine")
     *      ),
     *      @SWG\Parameter(
     *          name="type",
     *          in="body",
     *          description="Medicine that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Medicine")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="Medicine that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Medicine")
     *      ),
     *      @SWG\Parameter(
     *          name="parent_id",
     *          in="body",
     *          description="Medicine that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Medicine")
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
     *                  ref="#/definitions/Medicine"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateMedicineAPIRequest $request)
    {
        $input = $request->all();

        $medicine = $this->medicineRepository->create($input);

        return $this->sendResponse($medicine->toArray(), 'Medicine saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/medicines/{id}",
     *      summary="Display the specified Medicine",
     *      tags={"Medicine"},
     *      description="Get Medicine",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Medicine",
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
     *                  ref="#/definitions/Medicine"
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
        /** @var Medicine $medicine */
        $medicine = $this->medicineRepository->find($id, \request()->get('relations'));

        if ($medicine === null) {
            return $this->sendError('Medicine not found');
        }

        return $this->sendResponse($medicine->toArray(), 'Medicine retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateMedicineAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/medicines/{id}",
     *      summary="Update the specified Medicine in storage",
     *      tags={"Medicine"},
     *      description="Update Medicine",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Medicine",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="Medicine that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Medicine")
     *      ),
     *      @SWG\Parameter(
     *          name="type",
     *          in="body",
     *          description="Medicine that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Medicine")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="Medicine that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Medicine")
     *      ),
     *      @SWG\Parameter(
     *          name="parent_id",
     *          in="body",
     *          description="Medicine that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Medicine")
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
     *                  ref="#/definitions/Medicine"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateMedicineAPIRequest $request)
    {
        $input = $request->all();

        /** @var Medicine $medicine */
        $medicine = $this->medicineRepository->find($id, \request()->get('relations'));

        if ($medicine === null) {
            return $this->sendError('Medicine not found');
        }

        $medicine = $this->medicineRepository->update($input, $id);

        return $this->sendResponse($medicine->toArray(), 'Medicine updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/medicines/{id}",
     *      summary="Remove the specified Medicine from storage",
     *      tags={"Medicine"},
     *      description="Delete Medicine",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Medicine",
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
        /** @var Medicine $medicine */
        $medicine = $this->medicineRepository->find($id, \request()->get('relations'));

        if (empty($medicine)) {
            return $this->sendError('Medicine not found');
        }

        $medicine->delete();

        return $this->sendResponse($id, 'Medicine deleted successfully');
    }
}
