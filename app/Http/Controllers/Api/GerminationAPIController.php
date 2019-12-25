<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\CreateGerminationAPIRequest;
use App\Http\Requests\Api\UpdateGerminationAPIRequest;
use App\Models\Germination;
use App\Repositories\GerminationRepository;
use Exception;
use Illuminate\Http\Request;
use Response;

/**
 * Class GerminationController
 * @package App\Http\Controllers\Api
 */
class GerminationAPIController extends AppBaseController
{
    /** @var  GerminationRepository */
    private $germinationRepository;

    public function __construct(GerminationRepository $germinationRepo)
    {
        $this->germinationRepository = $germinationRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/germinations",
     *      summary="Get a listing of the Germinations.",
     *      tags={"Germination"},
     *      description="Get all Germinations",
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
     *                  @SWG\Items(ref="#/definitions/Germination")
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
        $germinations = $this->germinationRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($germinations->toArray(), 'Germinations retrieved successfully');
    }

    /**
     * @param CreateGerminationAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/germinations",
     *      summary="Store a newly created Germination in storage",
     *      tags={"Germination"},
     *      description="Store Germination",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="dormancy_breaking_treatments",
     *          in="body",
     *          description="Germination that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Germination")
     *      ),
     *      @SWG\Parameter(
     *          name="light_date",
     *          in="body",
     *          description="Germination that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Germination")
     *      ),
     *      @SWG\Parameter(
     *          name="dark_date",
     *          in="body",
     *          description="Germination that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Germination")
     *      ),
     *      @SWG\Parameter(
     *          name="light_temperature",
     *          in="body",
     *          description="Germination that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Germination")
     *      ),
     *      @SWG\Parameter(
     *          name="dark_temperature",
     *          in="body",
     *          description="Germination that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Germination")
     *      ),
     *      @SWG\Parameter(
     *          name="germination_period",
     *          in="body",
     *          description="Germination that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Germination")
     *      ),
     *      @SWG\Parameter(
     *          name="germination_percentage",
     *          in="body",
     *          description="Germination that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Germination")
     *      ),
     *      @SWG\Parameter(
     *          name="dormancy_termination",
     *          in="body",
     *          description="Germination that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Germination")
     *      ),
     *      @SWG\Parameter(
     *          name="germination_start",
     *          in="body",
     *          description="Germination that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Germination")
     *      ),
     *      @SWG\Parameter(
     *          name="dormancy_breaking_description",
     *          in="body",
     *          description="Germination that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Germination")
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
     *                  ref="#/definitions/Germination"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateGerminationAPIRequest $request)
    {
        $input = $request->all();

        $germination = $this->germinationRepository->create($input);

        return $this->sendResponse($germination->toArray(), 'Germination saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/germinations/{id}",
     *      summary="Display the specified Germination",
     *      tags={"Germination"},
     *      description="Get Germination",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Germination",
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
     *                  ref="#/definitions/Germination"
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
        /** @var Germination $germination */
        $germination = $this->germinationRepository->find($id);

        if (empty($germination)) {
            return $this->sendError('Germination not found');
        }

        return $this->sendResponse($germination->toArray(), 'Germination retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateGerminationAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/germinations/{id}",
     *      summary="Update the specified Germination in storage",
     *      tags={"Germination"},
     *      description="Update Germination",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Germination",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="dormancy_breaking_treatments",
     *          in="body",
     *          description="Germination that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Germination")
     *      ),
     *      @SWG\Parameter(
     *          name="light_date",
     *          in="body",
     *          description="Germination that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Germination")
     *      ),
     *      @SWG\Parameter(
     *          name="dark_date",
     *          in="body",
     *          description="Germination that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Germination")
     *      ),
     *      @SWG\Parameter(
     *          name="light_temperature",
     *          in="body",
     *          description="Germination that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Germination")
     *      ),
     *      @SWG\Parameter(
     *          name="dark_temperature",
     *          in="body",
     *          description="Germination that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Germination")
     *      ),
     *      @SWG\Parameter(
     *          name="germination_period",
     *          in="body",
     *          description="Germination that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Germination")
     *      ),
     *      @SWG\Parameter(
     *          name="germination_percentage",
     *          in="body",
     *          description="Germination that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Germination")
     *      ),
     *      @SWG\Parameter(
     *          name="dormancy_termination",
     *          in="body",
     *          description="Germination that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Germination")
     *      ),
     *      @SWG\Parameter(
     *          name="germination_start",
     *          in="body",
     *          description="Germination that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Germination")
     *      ),
     *      @SWG\Parameter(
     *          name="dormancy_breaking_description",
     *          in="body",
     *          description="Germination that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Germination")
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
     *                  ref="#/definitions/Germination"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateGerminationAPIRequest $request)
    {
        $input = $request->all();

        /** @var Germination $germination */
        $germination = $this->germinationRepository->find($id);

        if (empty($germination)) {
            return $this->sendError('Germination not found');
        }

        $germination = $this->germinationRepository->update($input, $id);

        return $this->sendResponse($germination->toArray(), 'Germination updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/germinations/{id}",
     *      summary="Remove the specified Germination from storage",
     *      tags={"Germination"},
     *      description="Delete Germination",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Germination",
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
     * @throws Exception
     */
    public function destroy($id)
    {
        /** @var Germination $germination */
        $germination = $this->germinationRepository->find($id);

        if (empty($germination)) {
            return $this->sendError('Germination not found');
        }

        $germination->delete();

        return $this->sendResponse($id, 'Germination deleted successfully');
    }
}
