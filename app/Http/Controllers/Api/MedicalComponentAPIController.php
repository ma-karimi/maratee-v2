<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateMedicalComponentAPIRequest;
use App\Http\Requests\Api\UpdateMedicalComponentAPIRequest;
use App\Models\MedicalComponent;
use App\Repositories\MedicalComponentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class MedicalComponentAPIController
 * @package App\Http\Controllers\Api
 */

class MedicalComponentAPIController extends AppBaseController
{
    /** @var  MedicalComponentRepository */
    private $medicalComponentRepository;

    public function __construct(MedicalComponentRepository $medicalComponentRepo)
    {
        $this->medicalComponentRepository = $medicalComponentRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/medical_components",
     *      summary="Get a listing of the MedicalComponents.",
     *      tags={"MedicalComponent"},
     *      description="Get all MedicalComponents",
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
     *                  @SWG\Items(ref="#/definitions/MedicalComponent")
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
        $medicalComponents = $this->medicalComponentRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($medicalComponents->toArray(), 'Medicinal Plant Constituents retrieved successfully');
    }

    /**
     * @param CreateMedicalComponentAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/medical_components",
     *      summary="Store a newly created MedicalComponent in storage",
     *      tags={"MedicalComponent"},
     *      description="Store MedicalComponent",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="medicinal_plant_id",
     *          in="body",
     *          description="MedicalComponent that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/MedicalComponent")
     *      ),
     *      @SWG\Parameter(
     *          name="constituent_id",
     *          in="body",
     *          description="MedicalComponent that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/MedicalComponent")
     *      ),
     *      @SWG\Parameter(
     *          name="value",
     *          in="body",
     *          description="MedicalComponent that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/MedicalComponent")
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
     *                  ref="#/definitions/MedicalComponent"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateMedicalComponentAPIRequest $request)
    {
        $input = $request->all();

        $medicalComponent = $this->medicalComponentRepository->create($input);

        return $this->sendResponse($medicalComponent->toArray(), 'Medicinal Plant Constituent saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/medical_components/{id}",
     *      summary="Display the specified MedicalComponent",
     *      tags={"MedicalComponent"},
     *      description="Get MedicalComponent",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MedicalComponent",
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
     *                  ref="#/definitions/MedicalComponent"
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
        /** @var MedicalComponent $medicalComponent */
        $medicalComponent = $this->medicalComponentRepository->find($id, \request()->get('relations'));

        if ($medicalComponent === null) {
            return $this->sendError('Medicinal Plant Constituent not found');
        }

        return $this->sendResponse($medicalComponent->toArray(), 'Medicinal Plant Constituent retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateMedicalComponentAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/medical_components/{id}",
     *      summary="Update the specified MedicalComponent in storage",
     *      tags={"MedicalComponent"},
     *      description="Update MedicalComponent",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MedicalComponent",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="medicinal_plant_id",
     *          in="body",
     *          description="MedicalComponent that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/MedicalComponent")
     *      ),
     *      @SWG\Parameter(
     *          name="constituent_id",
     *          in="body",
     *          description="MedicalComponent that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/MedicalComponent")
     *      ),
     *      @SWG\Parameter(
     *          name="value",
     *          in="body",
     *          description="MedicalComponent that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/MedicalComponent")
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
     *                  ref="#/definitions/MedicalComponent"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateMedicalComponentAPIRequest $request)
    {
        $input = $request->all();

        /** @var MedicalComponent $medicalComponent */
        $medicalComponent = $this->medicalComponentRepository->find($id, \request()->get('relations'));

        if ($medicalComponent === null) {
            return $this->sendError('Medicinal Plant Constituent not found');
        }

        $medicalComponent = $this->medicalComponentRepository->update($input, $id);

        return $this->sendResponse($medicalComponent->toArray(), 'MedicalComponent updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/medical_components/{id}",
     *      summary="Remove the specified MedicalComponent from storage",
     *      tags={"MedicalComponent"},
     *      description="Delete MedicalComponent",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MedicalComponent",
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
        /** @var MedicalComponent $medicalComponent */
        $medicalComponent = $this->medicalComponentRepository->find($id, \request()->get('relations'));

        if ($medicalComponent === null) {
            return $this->sendError('Medicinal Plant Constituent not found');
        }

        $medicalComponent->delete();

        return $this->sendResponse($id, 'Medicinal Plant Constituent deleted successfully');
    }
}
