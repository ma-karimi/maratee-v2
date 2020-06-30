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
            $this->botanicalRepository->getRelationFields()
        );

        $keys = [
            ['name' => 'family', 'title' => 'Family', 'value' => false],
            ['name' => 'genus', 'title' => 'Genus', 'value' => false],
            ['name' => 'species', 'title' => 'Species', 'value' => false],
            ['name' => 'subspecies', 'title' => 'SubSpecies', 'value' => false],
            ['name' => 'variety', 'title' => 'Variety', 'value' => false],
            ['name' => 'scientific', 'title' => 'Scientific', 'value' => false],
            ['name' => 'local_name', 'title' => 'Local Name', 'value' => false],
            ['name' => 'collection_name', 'title' => 'Collection', 'value' => false],
            ['name' => 'origin', 'title' => 'Origin', 'value' => false],
            ['name' => 'habitat', 'title' => 'Habitat', 'value' => false],
            ['name' => 'place', 'title' => 'Place', 'value' => false],
            ['name' => 'life_form', 'title' => 'Life Form', 'value' => false],
            ['name' => 'status', 'title' => 'Conversation status', 'value' => false],
            ['name' => 'height', 'title' => 'Height', 'value' => false],
            ['name' => 'value', 'title' => 'Value', 'value' => false],
            ['name' => 'usage', 'title' => 'Usage', 'value' => false],
            ['name' => 'colors', 'title' => 'Colors', 'value' => false],
            ['name' => 'garden', 'title' => 'Garden', 'value' => false],
            ['name' => 'internal_habitat', 'title' => 'Internal Habitat', 'value' => false],
            ['name' => 'entrance', 'title' => 'Entrance form', 'value' => false],
            ['name' => 'seeding_planting', 'title' => 'Seeding/Planting', 'value' => false],
            ['name' => 'transfer', 'title' => 'Transfer', 'value' => false],
            ['name' => 'seed_germination', 'title' => 'Seed germination', 'value' => false],
            ['name' => 'method', 'title' => 'Propagation method', 'value' => false],
            ['name' => 'planting_date', 'title' => 'Date of planting', 'value' => false],
            ['name' => 'cutting_rooting', 'title' => 'Percent of cutting rooting', 'value' => false],
            ['name' => 'treatment', 'title' => 'Treatment', 'value' => false],
            ['name' => 'growth_rate', 'title' => 'Growth rate', 'value' => false],
            ['name' => 'first_flowering', 'title' => 'First flowering', 'value' => false],
            ['name' => 'flowering_period', 'title' => 'Flowering period', 'value' => false],
            ['name' => 'seed', 'title' => 'Seed', 'value' => false],
            ['name' => 'tolerances', 'title' => 'Tolerances', 'value' => false],
            ['name' => 'irrigation', 'title' => 'Irrigation', 'value' => false],
            ['name' => 'soil', 'title' => 'Soil', 'value' => false],
            ['name' => 'planting_condition', 'title' => 'Planting conditions', 'value' => false],
            ['name' => 'sensitivity', 'title' => 'Sensitivity to the conditions', 'value' => false],
            ['name' => 'comment', 'title' => 'Comments', 'value' => false],
        ];
        return $this->sendResponse(compact('botanicals', 'keys'), 'Botanicals retrieved successfully');
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
     *          name="origins",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="collection_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="habitats",
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
        $botanical = $this->botanicalRepository->find($id, $this->botanicalRepository->getRelationFields());

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
     *          name="origins",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="collection_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Botanical")
     *      ),
     *      @SWG\Parameter(
     *          name="habitats",
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
