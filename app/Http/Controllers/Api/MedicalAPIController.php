<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateMedicalAPIRequest;
use App\Http\Requests\Api\UpdateMedicalAPIRequest;
use App\Models\Medical;
use App\Repositories\MedicalRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class MedicalController
 * @package App\Http\Controllers\Api
 */

class MedicalAPIController extends AppBaseController
{
    /** @var  MedicalRepository */
    private $medicalRepository;

    public function __construct(MedicalRepository $medicalRepo)
    {
        $this->medicalRepository = $medicalRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/medicals",
     *      summary="Get a listing of the Medicals.",
     *      tags={"Medical"},
     *      description="Get all Medicals",
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
     *                  @SWG\Items(ref="#/definitions/Medical")
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
        $medicals = $this->medicalRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($medicals->toArray(), 'Medicals retrieved successfully');
    }

    /**
     * @param CreateMedicalAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/medicals",
     *      summary="Store a newly created Medical in storage",
     *      tags={"Medical"},
     *      description="Store Medical",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Medical that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Medical")
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
     *                  ref="#/definitions/Medical"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateMedicalAPIRequest $request)
    {
        $input = $request->all();

        $medical = $this->medicalRepository->create($input);

        return $this->sendResponse($medical->toArray(), 'Medical saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/medicals/{id}",
     *      summary="Display the specified Medical",
     *      tags={"Medical"},
     *      description="Get Medical",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Medical",
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
     *                  ref="#/definitions/Medical"
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
        /** @var Medical $medical */
        $medical = $this->medicalRepository->find($id);

        if (empty($medical)) {
            return $this->sendError('Medical not found');
        }

        return $this->sendResponse($medical->toArray(), 'Medical retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateMedicalAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/medicals/{id}",
     *      summary="Update the specified Medical in storage",
     *      tags={"Medical"},
     *      description="Update Medical",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Medical",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Medical that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Medical")
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
     *                  ref="#/definitions/Medical"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateMedicalAPIRequest $request)
    {
        $input = $request->all();

        /** @var Medical $medical */
        $medical = $this->medicalRepository->find($id);

        if (empty($medical)) {
            return $this->sendError('Medical not found');
        }

        $medical = $this->medicalRepository->update($input, $id);

        return $this->sendResponse($medical->toArray(), 'Medical updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/medicals/{id}",
     *      summary="Remove the specified Medical from storage",
     *      tags={"Medical"},
     *      description="Delete Medical",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Medical",
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
        /** @var Medical $medical */
        $medical = $this->medicalRepository->find($id);

        if (empty($medical)) {
            return $this->sendError('Medical not found');
        }

        $medical->delete();

        return $this->sendResponse($id, 'Medical deleted successfully');
    }
}
