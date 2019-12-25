<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\Botanical\BotanicalPropertyAPIRequest;
use App\Models\BotanicalProperty;
use App\Repositories\BotanicalPropertyRepository;
use Exception;
use Illuminate\Http\Request;
use Response;

/**
 * Class BotanicalPropertyController
 * @package App\Http\Controllers\Api
 */
class BotanicalPropertyAPIController extends AppBaseController
{
    /** @var  BotanicalPropertyRepository */
    private $botanicalPropertyRepository;

    public function __construct(BotanicalPropertyRepository $botanicalPropertyRepo)
    {
        $this->botanicalPropertyRepository = $botanicalPropertyRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/botanical_properties",
     *      summary="Get a listing of the BotanicalProperties.",
     *      tags={"BotanicalProperty"},
     *      description="Get all BotanicalProperties",
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
     *                  @SWG\Items(ref="#/definitions/BotanicalProperty")
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
        $botanicalProperties = $this->botanicalPropertyRepository->all(
            [],
            null,
            null
        );
        return $this->sendResponse($botanicalProperties, 'Botanical Properties retrieved successfully');
    }

    /**
     * @param BotanicalPropertyAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/botanical_properties",
     *      summary="Store a newly created BotanicalProperty in storage",
     *      tags={"BotanicalProperty"},
     *      description="Store BotanicalProperty",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="botanical_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BotanicalProperty")
     *      ),
     *      @SWG\Parameter(
     *          name="type_id",
     *          in="body",
     *          required=true,
     *          description="1 => value , 2=>usage",
     *          @SWG\Schema(ref="#/definitions/BotanicalProperty")
     *      ),
     *      @SWG\Parameter(
     *          name="property_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BotanicalProperty")
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
     *                  ref="#/definitions/BotanicalProperty"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(BotanicalPropertyAPIRequest $request)
    {
        $input = $request->all();

        $botanicalProperty = $this->botanicalPropertyRepository->create($input);

        return $this->sendResponse($botanicalProperty->toArray(), 'Botanical Property saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/botanical_properties/{id}",
     *      summary="Display the specified BotanicalProperty",
     *      tags={"BotanicalProperty"},
     *      description="Get BotanicalProperty",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BotanicalProperty",
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
     *                  ref="#/definitions/BotanicalProperty"
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
        /** @var BotanicalProperty $botanicalProperty */
        $botanicalProperty = $this->botanicalPropertyRepository->find($id, \request()->get('relations'));

        if ($botanicalProperty === null) {
            return $this->sendError('Botanical Property not found');
        }

        return $this->sendResponse($botanicalProperty->toArray(), 'Botanical Property retrieved successfully');
    }

    /**
     * @param int $id
     * @param BotanicalPropertyAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/botanical_properties/{id}",
     *      summary="Update the specified BotanicalProperty in storage",
     *      tags={"BotanicalProperty"},
     *      description="Update BotanicalProperty",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BotanicalProperty",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="botanical_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BotanicalProperty")
     *      ),
     *      @SWG\Parameter(
     *          name="type_id",
     *          in="body",
     *          required=true,
     *          description="1 => value , 2=>usage",
     *          @SWG\Schema(ref="#/definitions/BotanicalProperty")
     *      ),
     *      @SWG\Parameter(
     *          name="property_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BotanicalProperty")
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
     *                  ref="#/definitions/BotanicalProperty"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, BotanicalPropertyAPIRequest $request)
    {
        $input = $request->all();

        /** @var BotanicalProperty $botanicalProperty */
        $botanicalProperty = $this->botanicalPropertyRepository->find($id, \request()->get('relations'));

        if ($botanicalProperty === null) {
            return $this->sendError('Botanical Property not found');
        }

        $botanicalProperty = $this->botanicalPropertyRepository->update($input, $id);

        return $this->sendResponse($botanicalProperty->toArray(), 'BotanicalProperty updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws Exception
     * @SWG\Delete(
     *      path="/botanical_properties/{id}",
     *      summary="Remove the specified BotanicalProperty from storage",
     *      tags={"BotanicalProperty"},
     *      description="Delete BotanicalProperty",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BotanicalProperty",
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
        /** @var BotanicalProperty $botanicalProperty */
        $botanicalProperty = $this->botanicalPropertyRepository->find($id, \request()->get('relations'));

        if (empty($botanicalProperty)) {
            return $this->sendError('Botanical Property not found');
        }

        $botanicalProperty->delete();

        return $this->sendResponse($id, 'Botanical Property deleted successfully');
    }
}
