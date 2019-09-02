<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateplantApplicationAPIRequest;
use App\Http\Requests\Api\UpdateplantApplicationAPIRequest;
use App\Models\HerbariumApplication;
use App\Repositories\PlantApplicationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class plantApplicationController
 * @package App\Http\Controllers\Api
 */

class PlantApplicationAPIController extends AppBaseController
{
    /** @var  PlantApplicationRepository */
    private $plantApplicationRepository;

    public function __construct(PlantApplicationRepository $plantApplicationRepo)
    {
        $this->plantApplicationRepository = $plantApplicationRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/plant_applications",
     *      summary="Get a listing of the plantApplications.",
     *      tags={"plantApplication"},
     *      description="Get all plantApplications",
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
     *                  @SWG\Items(ref="#/definitions/PlantApplication")
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
        $plantApplications = $this->plantApplicationRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($plantApplications->toArray(), 'plant Applications retrieved successfully');
    }

    /**
     * @param CreateplantApplicationAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/plant_applications",
     *      summary="Store a newly created plantApplication in storage",
     *      tags={"plantApplication"},
     *      description="Store plantApplication",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="herbarium_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PlantApplication")
     *      ),
     *      @SWG\Parameter(
     *          name="general_part_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantApplication")
     *      ),
     *      @SWG\Parameter(
     *          name="general_application_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantApplication")
     *      ),
     *      @SWG\Parameter(
     *          name="general_growth_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantApplication")
     *      ),
     *      @SWG\Parameter(
     *          name="general_usage_type_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantApplication")
     *      ),
     *      @SWG\Parameter(
     *          name="general_industry_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantApplication")
     *      ),
     *      @SWG\Parameter(
     *          name="general_ecology_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PlantApplication")
     *      ),
     *      @SWG\Parameter(
     *          name="general_habitat_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PlantApplication")
     *      ),
     *      @SWG\Parameter(
     *          name="general_origin_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PlantApplication")
     *      ),
     *      @SWG\Parameter(
     *          name="presence",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantApplication")
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
     *                  ref="#/definitions/PlantApplication"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateplantApplicationAPIRequest $request)
    {
        $input = $request->all();

        $plantApplication = $this->plantApplicationRepository->create($input);

        return $this->sendResponse($plantApplication->toArray(), 'plant Application saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/plantApplications/{id}",
     *      summary="Display the specified plantApplication",
     *      tags={"plantApplication"},
     *      description="Get plantApplication",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of plantApplication",
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
     *                  ref="#/definitions/PlantApplication"
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
        /** @var HerbariumApplication $plantApplication */
        $plantApplication = $this->plantApplicationRepository->find($id, \request()->get('relations'));

        if ($plantApplication === null) {
            return $this->sendError('plant Application not found');
        }

        return $this->sendResponse($plantApplication->toArray(), 'plant Application retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateplantApplicationAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/plantApplications/{id}",
     *      summary="Update the specified plantApplication in storage",
     *      tags={"plantApplication"},
     *      description="Update plantApplication",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of plantApplication",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="herbarium_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PlantApplication")
     *      ),
     *      @SWG\Parameter(
     *          name="general_part_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantApplication")
     *      ),
     *      @SWG\Parameter(
     *          name="general_application_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantApplication")
     *      ),
     *      @SWG\Parameter(
     *          name="general_growth_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantApplication")
     *      ),
     *      @SWG\Parameter(
     *          name="general_usage_type_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantApplication")
     *      ),
     *      @SWG\Parameter(
     *          name="general_industry_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantApplication")
     *      ),
     *      @SWG\Parameter(
     *          name="general_ecology_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PlantApplication")
     *      ),
     *      @SWG\Parameter(
     *          name="general_habitat_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PlantApplication")
     *      ),
     *      @SWG\Parameter(
     *          name="general_origin_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PlantApplication")
     *      ),
     *      @SWG\Parameter(
     *          name="presence",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PlantApplication")
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
     *                  ref="#/definitions/PlantApplication"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateplantApplicationAPIRequest $request)
    {
        $input = $request->all();

        /** @var HerbariumApplication $plantApplication */
        $plantApplication = $this->plantApplicationRepository->find($id, \request()->get('relations'));

        if (empty($plantApplication)) {
            return $this->sendError('plant Application not found');
        }

        $plantApplication = $this->plantApplicationRepository->update($input, $id);

        return $this->sendResponse($plantApplication->toArray(), 'plantApplication updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/plantApplications/{id}",
     *      summary="Remove the specified plantApplication from storage",
     *      tags={"plantApplication"},
     *      description="Delete plantApplication",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of plantApplication",
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
        /** @var HerbariumApplication $plantApplication */
        $plantApplication = $this->plantApplicationRepository->find($id, \request()->get('relations'));

        if (empty($plantApplication)) {
            return $this->sendError('plant Application not found');
        }

        $plantApplication->delete();

        return $this->sendResponse($id, 'plant Application deleted successfully');
    }
}
