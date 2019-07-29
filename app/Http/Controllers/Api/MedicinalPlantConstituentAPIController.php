<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateMedicinalPlantConstituentAPIRequest;
use App\Http\Requests\Api\UpdateMedicinalPlantConstituentAPIRequest;
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
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/medicinalPlantConstituents",
     *      summary="Get a listing of the MedicinalPlantConstituents.",
     *      tags={"MedicinalPlantConstituent"},
     *      description="Get all MedicinalPlantConstituents",
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
     *                  @SWG\Items(ref="#/definitions/MedicinalPlantConstituent")
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
        $medicinalPlantConstituents = $this->medicinalPlantConstituentRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($medicinalPlantConstituents->toArray(), 'Medicinal Plant Constituents retrieved successfully');
    }

    /**
     * @param CreateMedicinalPlantConstituentAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/medicinalPlantConstituents",
     *      summary="Store a newly created MedicinalPlantConstituent in storage",
     *      tags={"MedicinalPlantConstituent"},
     *      description="Store MedicinalPlantConstituent",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="medicinal_plant_id",
     *          in="body",
     *          description="MedicinalPlantConstituent that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantConstituent")
     *      ),
     *      @SWG\Parameter(
     *          name="constituent_id",
     *          in="body",
     *          description="MedicinalPlantConstituent that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantConstituent")
     *      ),
     *      @SWG\Parameter(
     *          name="value",
     *          in="body",
     *          description="MedicinalPlantConstituent that should be stored",
     *          required=true,
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
    public function store(CreateMedicinalPlantConstituentAPIRequest $request)
    {
        $input = $request->all();

        $medicinalPlantConstituent = $this->medicinalPlantConstituentRepository->create($input);

        return $this->sendResponse($medicinalPlantConstituent->toArray(), 'Medicinal Plant Constituent saved successfully');
    }

    /**
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
    public function show($id)
    {
        /** @var MedicinalPlantConstituent $medicinalPlantConstituent */
        $medicinalPlantConstituent = $this->medicinalPlantConstituentRepository->find($id);

        if ($medicinalPlantConstituent === null) {
            return $this->sendError('Medicinal Plant Constituent not found');
        }

        return $this->sendResponse($medicinalPlantConstituent->toArray(), 'Medicinal Plant Constituent retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateMedicinalPlantConstituentAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/medicinalPlantConstituents/{id}",
     *      summary="Update the specified MedicinalPlantConstituent in storage",
     *      tags={"MedicinalPlantConstituent"},
     *      description="Update MedicinalPlantConstituent",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MedicinalPlantConstituent",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="medicinal_plant_id",
     *          in="body",
     *          description="MedicinalPlantConstituent that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantConstituent")
     *      ),
     *      @SWG\Parameter(
     *          name="constituent_id",
     *          in="body",
     *          description="MedicinalPlantConstituent that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/MedicinalPlantConstituent")
     *      ),
     *      @SWG\Parameter(
     *          name="value",
     *          in="body",
     *          description="MedicinalPlantConstituent that should be stored",
     *          required=true,
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
    public function update($id, UpdateMedicinalPlantConstituentAPIRequest $request)
    {
        $input = $request->all();

        /** @var MedicinalPlantConstituent $medicinalPlantConstituent */
        $medicinalPlantConstituent = $this->medicinalPlantConstituentRepository->find($id);

        if ($medicinalPlantConstituent === null) {
            return $this->sendError('Medicinal Plant Constituent not found');
        }

        $medicinalPlantConstituent = $this->medicinalPlantConstituentRepository->update($input, $id);

        return $this->sendResponse($medicinalPlantConstituent->toArray(), 'MedicinalPlantConstituent updated successfully');
    }

    /**
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
    public function destroy($id)
    {
        /** @var MedicinalPlantConstituent $medicinalPlantConstituent */
        $medicinalPlantConstituent = $this->medicinalPlantConstituentRepository->find($id);

        if (empty($medicinalPlantConstituent)) {
            return $this->sendError('Medicinal Plant Constituent not found');
        }

        $medicinalPlantConstituent->delete();

        return $this->sendResponse($id, 'Medicinal Plant Constituent deleted successfully');
    }
}
