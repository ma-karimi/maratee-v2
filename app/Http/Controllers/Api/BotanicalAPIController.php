<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateBotanicalAPIRequest;
use App\Http\Requests\Api\UpdateBotanicalAPIRequest;
use App\Http\Resources\BotanicalResource;
use App\Models\Botanical;
use App\Repositories\BotanicalRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
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
     */
    public function index(Request $request)
    {
        $botanicals = $this->botanicalRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );
        $botanicals=BotanicalResource::collection($botanicals);
        return $this->sendResponse($botanicals, 'Botanicals retrieved successfully');
    }

    /**
     * @param CreateBotanicalAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/botanicals",
     *      summary="Store a newly created Botanical in storage",
     *      tags={"Botanical"},
     *      description="Store Botanical",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="herbarium_id",
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
     *          name="leaf_color",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="sprout",
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
     *          name="growth_rate",
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
     *          name="flowering_interval",
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
     *          name="seed_value",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="seed_production",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="season_resistance",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="year",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="sensitivity",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="sensitivity_description",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="notes",
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
     *          name="scion_rooting_per",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="entry_type",
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
     */
    public function store(CreateBotanicalAPIRequest $request)
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
        $botanical = $this->botanicalRepository->find($id);

        if ($botanical === null) {
            return $this->sendError('Botanical not found');
        }

        return $this->sendResponse($botanical->toArray(), 'Botanical retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateBotanicalAPIRequest $request
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
     *          name="herbarium_id",
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
     *          name="leaf_color",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="sprout",
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
     *          name="growth_rate",
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
     *          name="flowering_interval",
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
     *          name="seed_value",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="seed_production",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="season_resistance",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="year",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="sensitivity",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="sensitivity_description",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="notes",
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
     *          name="scion_rooting_per",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="entry_type",
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
     */
    public function update($id, UpdateBotanicalAPIRequest $request)
    {
        $input = $request->all();

        /** @var Botanical $botanical */
        $botanical = $this->botanicalRepository->find($id);

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
     * @throws \Exception
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
        $botanical = $this->botanicalRepository->find($id);

        if ($botanical === null) {
            return $this->sendError('Botanical not found');
        }

        $botanical->delete();

        return $this->sendResponse($id, 'Botanical deleted successfully');
    }
}
