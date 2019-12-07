<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\MedicinalPartAPIRequest;
use App\Models\MedicinalPart;
use App\Repositories\MedicinalPartRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class MedicinalPartController
 * @package App\Http\Controllers\Api
 */

class MedicinalPartAPIController extends AppBaseController
{
    /** @var  MedicinalPartRepository */
    private $medicinalPartRepository;

    public function __construct(MedicinalPartRepository $medicinalPartRepo)
    {
        $this->medicinalPartRepository = $medicinalPartRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/medicinal_parts",
     *      summary="Get a listing of the MedicinalParts.",
     *      tags={"MedicinalPart"},
     *      description="Get all MedicinalParts",
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
     *                  @SWG\Items(ref="#/definitions/MedicinalPart")
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
        $medicinalParts = $this->medicinalPartRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($medicinalParts->toArray(), 'Medicinal Parts retrieved successfully');
    }

    /**
     * @param MedicinalPartAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/medicinal_parts",
     *      summary="Store a newly created MedicinalPart in storage",
     *      tags={"MedicinalPart"},
     *      description="Store MedicinalPart",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="MedicinalPart that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/MedicinalPart")
     *      ),
     *      @SWG\Parameter(
     *          name="type_id",
     *          in="body",
     *          description="1 -> aerial , 2 -> ground",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/MedicinalPart")
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
     *                  ref="#/definitions/MedicinalPart"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(MedicinalPartAPIRequest $request)
    {
        $input = $request->all();

        $medicinalPart = $this->medicinalPartRepository->create($input);

        return $this->sendResponse($medicinalPart->toArray(), 'Medicinal Part saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/medicinal_parts/{id}",
     *      summary="Display the specified MedicinalPart",
     *      tags={"MedicinalPart"},
     *      description="Get MedicinalPart",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MedicinalPart",
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
     *                  ref="#/definitions/MedicinalPart"
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
        /** @var MedicinalPart $medicinalPart */
        $medicinalPart = $this->medicinalPartRepository->find($id);

        if (empty($medicinalPart)) {
            return $this->sendError('Medicinal Part not found');
        }

        return $this->sendResponse($medicinalPart->toArray(), 'Medicinal Part retrieved successfully');
    }

    /**
     * @param int $id
     * @param MedicinalPartAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/medicinal_parts/{id}",
     *      summary="Update the specified MedicinalPart in storage",
     *      tags={"MedicinalPart"},
     *      description="Update MedicinalPart",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MedicinalPart",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="MedicinalPart that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/MedicinalPart")
     *      ),
     *      @SWG\Parameter(
     *          name="type_id",
     *          in="body",
     *          description="1 -> aerial , 2 -> ground",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/MedicinalPart")
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
     *                  ref="#/definitions/MedicinalPart"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, MedicinalPartAPIRequest $request)
    {
        $input = $request->all();

        /** @var MedicinalPart $medicinalPart */
        $medicinalPart = $this->medicinalPartRepository->find($id);

        if (empty($medicinalPart)) {
            return $this->sendError('Medicinal Part not found');
        }

        $medicinalPart = $this->medicinalPartRepository->update($input, $id);

        return $this->sendResponse($medicinalPart->toArray(), 'MedicinalPart updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/medicinal_parts/{id}",
     *      summary="Remove the specified MedicinalPart from storage",
     *      tags={"MedicinalPart"},
     *      description="Delete MedicinalPart",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MedicinalPart",
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
        /** @var MedicinalPart $medicinalPart */
        $medicinalPart = $this->medicinalPartRepository->find($id);

        if (empty($medicinalPart)) {
            return $this->sendError('Medicinal Part not found');
        }

        $medicinalPart->delete();

        return $this->sendResponse($id, 'Medicinal Part deleted successfully');
    }
}
