<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\Botanical\BotanicalAPIRequest;
use App\Http\Requests\Api\Botanical\BotanicalInformationAPIRequest;
use App\Http\Requests\Api\Botanical\BotanicalIrrigationAPIRequest;
use App\Http\Requests\Api\Botanical\BotanicalLocationAPIRequest;
use App\Http\Requests\Api\Botanical\BotanicalMediaAPIRequest;
use App\Http\Requests\Api\Botanical\BotanicalSoilAPIRequest;
use App\Models\Botanical;
use App\Repositories\BotanicalRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Response;

/**
 * Class BotanicalController
 * @package App\Http\Controllers\Api
 */
class BotanicalAPIController extends AppBaseController
{
    /** @var  BotanicalRepository */
    private $botanicalRepository;

    public function __construct(BotanicalRepository $botanicalRepo)
    {
        $this->botanicalRepository = $botanicalRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/botanicals",
     *      summary="Get a listing of the Botanicals.",
     *      tags={"Botanical"},
     *      description="Get all Botanicals",
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
     *                  @SWG\Items(ref="#/definitions/Botanical")
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

        $botanicals = $this->botanicalRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $this->getRelationFields()
        );

        return $this->sendResponse($botanicals->toArray(), 'Botanicals retrieved successfully');
    }

    private function getRelationFields()
    {
        return ['distributions', 'organization', 'protection:id,name', 'internalHabitat', 'generalHabitat:id,name', 'origins', 'habitats', 'botanicalIrrigation', 'plantingConditions', 'propagations', 'usages', 'values', 'operations', 'media', 'taxonomy', 'locations', 'cycles', 'flowerColors', 'fruitColors', 'foliageColors', 'soil', 'summerTolerance', 'winterTolerance', 'seedGermination', 'seedRate', 'growthRate', 'entranceToGarden', 'wooden', 'soilTypes'];
    }

    /**
     * @param BotanicalAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/botanicals",
     *      summary="Store a newly created Botanical in storage",
     *      tags={"Botanical"},
     *      description="Store Botanical",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="taxonomy_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="general_habitat_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="general_originِ_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="monopoly_of_iran_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="wooden_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="cycle_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="protection_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="height",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="value_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="usage_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="flower_color",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="fruit_color",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="foliage_color",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="garden_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="seed_germination_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="entrance_to_garden_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="planting",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="cutting_rooting",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="treatment",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="growth_rate_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="first_flowering",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="first_seeding",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="seed_rate_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="seed_formation_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="winter_tolerance_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="summer_tolerance_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="planting_condition_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="comments",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="garden_map",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="sensitivity_conditions",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="soil_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
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
     *                  ref="#/definitions/Botanical"
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
    public function store(BotanicalAPIRequest $request)
    {
        $input = $request->all();

        $botanical = $this->botanicalRepository->create($input);

        return $this->sendResponse($botanical->toArray(), 'Botanical saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/botanicals/{id}",
     *      summary="Display the specified Botanical",
     *      tags={"Botanical"},
     *      description="Get Botanical",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Botanical",
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
     *                  ref="#/definitions/Botanical"
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
        /** @var Botanical $botanical */
        $botanical = $this->botanicalRepository->find($id, $this->getRelationFields());

        if ($botanical === null) {
            return $this->sendError('Botanical not found');
        }

        return $this->sendResponse($botanical->toArray(), 'Botanical retrieved successfully');
    }

    /**
     * @param int $id
     * @param BotanicalAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/botanicals/{id}",
     *      summary="Update the specified Botanical in storage",
     *      tags={"Botanical"},
     *      description="Update Botanical",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Botanical",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="taxonomy_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="general_habitat_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="general_originِ_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="monopoly_of_iran_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="wooden_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="cycle_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="protection_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="height",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="value_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="usage_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="flower_color",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="fruit_color",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="foliage_color",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="garden_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="seed_germination_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="entrance_to_garden_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="planting",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="cutting_rooting",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="treatment",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="growth_rate_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="first_flowering",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="first_seeding",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="seed_rate_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="seed_formation_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="winter_tolerance_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="summer_tolerance_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="planting_condition_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="comments",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="garden_map",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="sensitivity_conditions",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="soil_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
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
     *                  ref="#/definitions/Botanical"
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
    public function update($id, BotanicalAPIRequest $request)
    {
        $input = $request->all();

        /** @var Botanical $botanical */
        $botanical = $this->botanicalRepository->find($id, \request()->get('relations'));

        if ($botanical === null) {
            return $this->sendError('Botanical not found');
        }

        $botanical = $this->botanicalRepository->update($input, $id);

        return $this->sendResponse($botanical->toArray(), 'Botanical updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws Exception
     * @SWG\Delete(
     *      path="/botanicals/{id}",
     *      summary="Remove the specified Botanical from storage",
     *      tags={"Botanical"},
     *      description="Delete Botanical",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Botanical",
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
        /** @var Botanical $botanical */
        $botanical = $this->botanicalRepository->find($id, \request()->get('relations'));

        if ($botanical === null) {
            return $this->sendError('Botanical not found');
        }

        $botanical->delete();

        return $this->sendResponse($id, 'Botanical deleted successfully');
    }

    public function storeIrrigation($id, BotanicalIrrigationAPIRequest $request)
    {
        $input = $request->all();

        /** @var Botanical $botanical */
        $botanical = $this->botanicalRepository->find($id);

        if ($botanical === null) {
            return $this->sendError('Botanical not found');
        }

        $botanical = $this->botanicalRepository->storeBotanicalIrrigation($input);

        return $this->sendResponse($botanical->toArray(), 'Botanical updated successfully');
    }

    public function storeLocation($id, BotanicalLocationAPIRequest $request)
    {
        $input = $request->all();

        /** @var Botanical $botanical */
        $botanical = $this->botanicalRepository->find($id);

        if ($botanical === null) {
            return $this->sendError('Botanical not found');
        }

        $botanical = $this->botanicalRepository->storeLocation($input, $id);

        return $this->sendResponse($botanical->toArray(), 'Botanical updated successfully');
    }

    public function storeInformation($id, BotanicalInformationAPIRequest $request)
    {
        $input = $request->all();

        /** @var Botanical $botanical */
        $botanical = $this->botanicalRepository->find($id);

        if ($botanical === null) {
            return $this->sendError('Botanical not found');
        }

        $botanical = $this->botanicalRepository->updateInfo($input, $id);

        return $this->sendResponse($botanical->toArray(), 'Botanical updated successfully');
    }

    public function storeSoil($id, BotanicalSoilAPIRequest $request)
    {
        $input = $request->all();

        /** @var Botanical $botanical */
        $botanical = $this->botanicalRepository->find($id);

        if ($botanical === null) {
            return $this->sendError('Botanical not found');
        }

        $botanical = $this->botanicalRepository->updateSoil($input, $id);

        return $this->sendResponse($botanical->toArray(), 'Botanical updated successfully');
    }

    public function storeMedia($id, BotanicalMediaAPIRequest $request)
    {
        $input = $request->all();

        /** @var Botanical $botanical */
        $botanical = $this->botanicalRepository->find($id);

        if ($botanical === null) {
            return $this->sendError('Botanical not found');
        }

        $this->botanicalRepository->storeMedia($id);

        return $this->sendResponse([], 'Botanical updated successfully');
    }
}
