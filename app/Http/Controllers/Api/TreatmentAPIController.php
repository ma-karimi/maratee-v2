<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateTreatmentAPIRequest;
use App\Http\Requests\Api\UpdateTreatmentAPIRequest;
use App\Models\Treatment;
use App\Repositories\TreatmentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class TreatmentController
 * @package App\Http\Controllers\Api
 */

class TreatmentAPIController extends AppBaseController
{
    /** @var  TreatmentRepository */
    private $treatmentRepository;

    public function __construct(TreatmentRepository $treatmentRepo)
    {
        $this->treatmentRepository = $treatmentRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/treatments",
     *      summary="Get a listing of the Treatments.",
     *      tags={"Treatment"},
     *      description="Get all Treatments",
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
     *                  @SWG\Items(ref="#/definitions/Treatment")
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
    public function index(Request $request)
    {
        $treatments = $this->treatmentRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($treatments->toArray(), 'Treatments retrieved successfully');
    }

    /**
     * @param CreateTreatmentAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/treatments",
     *      summary="Store a newly created Treatment in storage",
     *      tags={"Treatment"},
     *      description="Store Treatment",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name_en",
     *          in="body",
     *          description="Treatment that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Treatment")
     *      ),
     *     @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="Visit that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Treatment")
     *      ),
     *     @SWG\Parameter(
     *          name="date",
     *          in="body",
     *          description="Visit that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Treatment")
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
     *                  ref="#/definitions/Treatment"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTreatmentAPIRequest $request)
    {
        $input = $request->all();

        $treatment = $this->treatmentRepository->create($input);

        return $this->sendResponse($treatment->toArray(), 'Treatment saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/treatments/{id}",
     *      summary="Display the specified Treatment",
     *      tags={"Treatment"},
     *      description="Get Treatment",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Treatment",
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
     *                  ref="#/definitions/Treatment"
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
        /** @var Treatment $treatment */
        $treatment = $this->treatmentRepository->find($id, \request()->get('relations'));

        if ($treatment === null) {
            return $this->sendError('Treatment not found');
        }

        return $this->sendResponse($treatment->toArray(), 'Treatment retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateTreatmentAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/treatments/{id}",
     *      summary="Update the specified Treatment in storage",
     *      tags={"Treatment"},
     *      description="Update Treatment",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name_en",
     *          in="body",
     *          description="Treatment that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Treatment")
     *      ),
     *     @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="Visit that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Treatment")
     *      ),
     *     @SWG\Parameter(
     *          name="date",
     *          in="body",
     *          description="Visit that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Treatment")
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
     *                  ref="#/definitions/Treatment"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTreatmentAPIRequest $request)
    {
        $input = $request->all();

        /** @var Treatment $treatment */
        $treatment = $this->treatmentRepository->find($id, \request()->get('relations'));

        if ($treatment === null) {
            return $this->sendError('Treatment not found');
        }

        $treatment = $this->treatmentRepository->update($input, $id);

        return $this->sendResponse($treatment->toArray(), 'Treatment updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/treatments/{id}",
     *      summary="Remove the specified Treatment from storage",
     *      tags={"Treatment"},
     *      description="Delete Treatment",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Treatment",
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
        /** @var Treatment $treatment */
        $treatment = $this->treatmentRepository->find($id, \request()->get('relations'));

        if ($treatment === null) {
            return $this->sendError('Treatment not found');
        }

        $treatment->delete();

        return $this->sendResponse($id, 'Treatment deleted successfully');
    }
}
