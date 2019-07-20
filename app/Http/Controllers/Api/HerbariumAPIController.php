<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateHerbariumAPIRequest;
use App\Http\Requests\Api\UpdateHerbariumAPIRequest;
use App\Models\Herbarium;
use App\Repositories\HerbariumRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class HerbariumController
 * @package App\Http\Controllers\Api
 */

class HerbariumAPIController extends AppBaseController
{
    /** @var  HerbariumRepository */
    private $herbariumRepository;

    public function __construct(HerbariumRepository $herbariumRepo)
    {
        $this->herbariumRepository = $herbariumRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/herbaria",
     *      summary="Get a listing of the Herbaria.",
     *      tags={"Herbarium"},
     *      description="Get all Herbaria",
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
     *                  @SWG\Items(ref="#/definitions/Herbarium")
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
        $herbaria = $this->herbariumRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($herbaria->toArray(), 'Herbaria retrieved successfully');
    }

    /**
     * @param CreateHerbariumAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/herbaria",
     *      summary="Store a newly created Herbarium in storage",
     *      tags={"Herbarium"},
     *      description="Store Herbarium",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="location_id",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="organization_id",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="number",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="location_id",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="phenology_id",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="protection_id",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="phytogeography_id",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="organization_id",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="sheets_no",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="samples_no",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="tip_qt",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="physical_tip_qt",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="tip_type",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="is_flowering",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="organization_description",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="herbarium_tip_location",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="type_description",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="plant_type_id",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="flowering",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="plant_group_id",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
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
     *                  ref="#/definitions/Herbarium"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateHerbariumAPIRequest $request)
    {
        $input = $request->all();

        $herbarium = $this->herbariumRepository->create($input);

        return $this->sendResponse($herbarium->toArray(), 'Herbarium saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/herbaria/{id}",
     *      summary="Display the specified Herbarium",
     *      tags={"Herbarium"},
     *      description="Get Herbarium",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Herbarium",
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
     *                  ref="#/definitions/Herbarium"
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
        /** @var Herbarium $herbarium */
        $herbarium = $this->herbariumRepository->find($id);

        if ($herbarium === null) {
            return $this->sendError('Herbarium not found');
        }

        return $this->sendResponse($herbarium->toArray(), 'Herbarium retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateHerbariumAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/herbaria/{id}",
     *      summary="Update the specified Herbarium in storage",
     *      tags={"Herbarium"},
     *      description="Update Herbarium",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Herbarium",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="location_id",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="organization_id",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="number",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="location_id",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="phenology_id",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="protection_id",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="phytogeography_id",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="organization_id",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="sheets_no",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="samples_no",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="tip_qt",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="physical_tip_qt",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="tip_type",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="is_flowering",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="organization_description",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="herbarium_tip_location",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="type_description",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="plant_type_id",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="flowering",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="plant_group_id",
     *          in="body",
     *          description="Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
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
     *                  ref="#/definitions/Herbarium"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateHerbariumAPIRequest $request)
    {
        $input = $request->all();

        /** @var Herbarium $herbarium */
        $herbarium = $this->herbariumRepository->find($id);

        if ($herbarium === null) {
            return $this->sendError('Herbarium not found');
        }

        $herbarium = $this->herbariumRepository->update($input, $id);

        return $this->sendResponse($herbarium->toArray(), 'Herbarium updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/herbaria/{id}",
     *      summary="Remove the specified Herbarium from storage",
     *      tags={"Herbarium"},
     *      description="Delete Herbarium",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Herbarium",
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
        /** @var Herbarium $herbarium */
        $herbarium = $this->herbariumRepository->find($id);

        if (empty($herbarium)) {
            return $this->sendError('Herbarium not found');
        }

        $herbarium->delete();

        return $this->sendResponse($id, 'Herbarium deleted successfully');
    }
}
