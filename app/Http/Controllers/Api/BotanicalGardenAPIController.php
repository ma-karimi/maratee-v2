<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\Botanical\BotanicalGardenAPIRequest;
use App\Models\BotanicalGarden;
use App\Repositories\BotanicalGardenRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Response;

/**
 * Class BotanicalGardenAPIController
 * @package App\Http\Controllers\Api
 */
class BotanicalGardenAPIController extends AppBaseController
{
    /** @var  BotanicalGardenRepository */
    private $botanicalGardenRepository;

    public function __construct(BotanicalGardenRepository $botanicalGardenRepo)
    {
        $this->botanicalGardenRepository = $botanicalGardenRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/botanical_gardens",
     *      summary="Get a listing of the BotanicalGardens.",
     *      tags={"BotanicalGarden"},
     *      description="Get all BotanicalGardens",
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
     *                  @SWG\Items(ref="#/definitions/BotanicalGarden")
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
        $botanicalGardens = $this->botanicalGardenRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($botanicalGardens->toArray(), 'Botanical Gardens retrieved successfully');
    }

    /**
     * @param BotanicalGardenAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/botanical_gardens",
     *      summary="Store a newly created BotanicalGarden in storage",
     *      tags={"BotanicalGarden"},
     *      description="Store BotanicalGarden",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="botanical_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BotanicalGarden")
     *      ),
     *      @SWG\Parameter(
     *          name="internal_habitat_id",
     *          in="body",
     *          description=""
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BotanicalGarden")
     *      ),
     *      @SWG\Parameter(
     *          name="garden_id",
     *          description="",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BotanicalGarden")
     *      ),
     *      @SWG\Parameter(
     *          name="entrances",
     *           description="[]",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BotanicalGarden")
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
     *                  ref="#/definitions/BotanicalGarden"
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
    public function store(BotanicalGardenAPIRequest $request)
    {
        $input = $request->all();

        $botanicalGarden = $this->botanicalGardenRepository->create($input);

        return $this->sendResponse($botanicalGarden->toArray(), 'Botanical Garden saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/botanical_gardens/{id}",
     *      summary="Display the specified BotanicalGarden",
     *      tags={"BotanicalGarden"},
     *      description="Get BotanicalGarden",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BotanicalGarden",
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
     *                  ref="#/definitions/BotanicalGarden"
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
        /** @var BotanicalGarden $botanicalGarden */
        $botanicalGarden = $this->botanicalGardenRepository->find($id, \request()->get('relations'));

        if ($botanicalGarden === null) {
            return $this->sendError('Botanical Garden not found');
        }

        return $this->sendResponse($botanicalGarden->toArray(), 'Botanical Garden retrieved successfully');
    }

    /**
     * @param int $id
     * @param BotanicalGardenAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/botanical_gardens/{id}",
     *      summary="Update the specified BotanicalGarden in storage",
     *      tags={"BotanicalGarden"},
     *      description="Update BotanicalGarden",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BotanicalGarden",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="botanical_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BotanicalGarden")
     *      ),
     *      @SWG\Parameter(
     *          name="internal_habitat_id",
     *          in="body",
     *          description=""
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BotanicalGarden")
     *      ),
     *      @SWG\Parameter(
     *          name="garden_id",
     *          description="",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BotanicalGarden")
     *      ),
     *      @SWG\Parameter(
     *          name="entrances",
     *           description="[]",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/BotanicalGarden")
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
     *                  ref="#/definitions/BotanicalGarden"
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
    public function update($id, BotanicalGardenAPIRequest $request)
    {
        $input = $request->all();

        /** @var BotanicalGarden $botanicalGarden */
        $botanicalGarden = $this->botanicalGardenRepository->find($id, \request()->get('relations'));

        if ($botanicalGarden === null) {
            return $this->sendError('Botanical Garden not found');
        }

        $botanicalGarden = $this->botanicalGardenRepository->update($input, $id);

        return $this->sendResponse($botanicalGarden->toArray(), 'BotanicalGarden updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws Exception
     * @SWG\Delete(
     *      path="/botanical_gardens/{id}",
     *      summary="Remove the specified BotanicalGarden from storage",
     *      tags={"BotanicalGarden"},
     *      description="Delete BotanicalGarden",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BotanicalGarden",
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
        /** @var BotanicalGarden $botanicalGarden */
        $botanicalGarden = $this->botanicalGardenRepository->find($id, \request()->get('relations'));

        if ($botanicalGarden === null) {
            return $this->sendError('Botanical Garden not found');
        }

        $botanicalGarden->delete();

        return $this->sendResponse($id, 'Botanical Garden deleted successfully');
    }
}
