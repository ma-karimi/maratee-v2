<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\MedicineAPIRequest;
use App\Models\Medicine;
use App\Repositories\MedicineRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


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
     * @throws Exception
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
     * @return Response
     *
     * @SWG\Get(
     *      path="/medicines/all",
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
     * @throws Exception
     */
    public function all()
    {
        $medicines =
            $this->medicineRepository->all();


        return $this->sendResponse($medicines->toArray(), 'Medicines retrieved successfully');
    }

    /**
     * @param MedicineAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/medicines",
     *      summary="Store a newly created Medicine in storage",
     *      tags={"Medicine"},
     *      description="Store Medicine",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name_en",
     *          in="body",
     *          description="Medicine that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Medicine")
     *      ),
     *      @SWG\Parameter(
     *          name="name_fa",
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
     * @throws ValidationException
     */
    public function store(MedicineAPIRequest $request)
    {

        $medicine = $this->medicineRepository->create($request);

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
     * @param MedicineAPIRequest $request
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
     *          name="name_en",
     *          in="body",
     *          description="Medicine that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Medicine")
     *      ),
     *      @SWG\Parameter(
     *          name="name_fa",
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
     * @throws ValidationException
     */
    public function update($id, MedicineAPIRequest $request)
    {

        /** @var Medicine $medicine */
        $medicine = $this->medicineRepository->find($id);

        if ($medicine === null) {
            return $this->sendError('Medicine not found');
        }

        $medicine = $this->medicineRepository->update($request, $id);

        return $this->sendResponse($medicine->toArray(), 'Medicine updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws Exception
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
        $medicine = $this->medicineRepository->find($id);

        if (empty($medicine)) {
            return $this->sendError('Medicine not found');
        }

        $medicine->delete();

        return $this->sendResponse($id, 'Medicine deleted successfully');
    }
}
