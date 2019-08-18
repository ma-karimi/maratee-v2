<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\CreatePlantAPIRequest;
use App\Http\Requests\Api\UpdatePlantAPIRequest;
use App\Http\Resources\PlantResource;
use App\Models\General;
use App\Models\Plant;
use App\Repositories\PlantRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class PlantController
 * @package App\Http\Controllers\Api
 */

class PlantAPIController extends AppBaseController
{
    /** @var  PlantRepository */
    private $plantRepository;

    public function __construct(PlantRepository $plantRepo)
    {
        $this->plantRepository = $plantRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/plants",
     *      summary="Get a listing of the Plants & Plant has flowering herbarium",
     *      tags={"Plant"},
     *      description="Get all Plants",
     *      produces={"application/json"},
     *   @SWG\Parameter(
     *     name="is_flowering",
     *     in="query",
     *     description="0,1",
     *     required=false,
     *     type="integer"
     *   ),
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
     *                  @SWG\Items(ref="#/definitions/Plant")
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
        $plants = $this->plantRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($plants->toArray(), 'Plants retrieved successfully');
    }

    /**
     * @param CreatePlantAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/plants",
     *      summary="Store a newly created Plant in storage",
     *      tags={"Plant"},
     *      description="Store Plant",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="domestic_name",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="flowering_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="cotyledon_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="sperm_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="genus_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="species_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="subspecies_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="variety_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="family_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="exclusivity",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
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
     *                  ref="#/definitions/Plant"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePlantAPIRequest $request)
    {
        $input = $request->all();

        $plant = $this->plantRepository->create($input);

        return $this->sendResponse($plant->toArray(), 'Plant saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/plants/{id}",
     *      summary="Display the specified Plant",
     *      tags={"Plant"},
     *      description="Get Plant",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Plant",
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
     *                  ref="#/definitions/Plant"
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
        /** @var Plant $plant */
        $plant = $this->plantRepository->find($id, \request()->get('relations'));

        if (empty($plant)) {
            return $this->sendError('Plant not found');
        }

        return $this->sendResponse($plant->toArray(), 'Plant retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePlantAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/plants/{id}",
     *      summary="Update the specified Plant in storage",
     *      tags={"Plant"},
     *      description="Update Plant",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Plant",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="domestic_name",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="flowering_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="cotyledon_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="sperm_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="genus_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="species_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="subspecies_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="variety_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="family_id",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Plant")
     *      ),
     *      @SWG\Parameter(
     *          name="exclusivity",
     *          in="body",
     *          description="Plant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Plant")
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
     *                  ref="#/definitions/Plant"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePlantAPIRequest $request)
    {
        $input = $request->all();

        /** @var Plant $plant */
        $plant = $this->plantRepository->find($id, \request()->get('relations'));

        if (empty($plant)) {
            return $this->sendError('Plant not found');
        }

        $plant = $this->plantRepository->update($input, $id);

        return $this->sendResponse($plant->toArray(), 'Plant updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/plants/{id}",
     *      summary="Remove the specified Plant from storage",
     *      tags={"Plant"},
     *      description="Delete Plant",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Plant",
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
        /** @var Plant $plant */
        $plant = $this->plantRepository->find($id, \request()->get('relations'));

        if (empty($plant)) {
            return $this->sendError('Plant not found');
        }

        $plant->delete();

        return $this->sendResponse($id, 'Plant deleted successfully');
    }

    public function exportExcel(Request $request)
    {
        $relations=[
            'generalFamily.authors',
            'generalGenus.authors',
            'generalSpecie.authors',
            'generalSubSpecie.authors',
            'generalVariety.authors',
            'generalSperm',
            'generalCotyledon',
            'authors',
            'location.city.province.country',
            'location.village',
            'herbariums.department',
            'herbariums.division',
            'herbariums.generalPhytogeography',
            'herbariums.actionHubs.user',
            'herbariums.generalPhenology',
            'herbariums.protection',
            'herbariums.attendances',
            'herbariums.borrows.user',
            'herbariums.borrows.media',
        ];
        $plants = $this->plantRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit'),
            $relations
        );
        $plants=PlantResource::collection($plants);
        return $this->sendResponse($plants, 'Plants retrieved successfully');
    }
}
