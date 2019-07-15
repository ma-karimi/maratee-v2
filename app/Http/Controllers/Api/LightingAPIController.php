<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateLightingAPIRequest;
use App\Http\Requests\Api\UpdateLightingAPIRequest;
use App\Models\Lighting;
use App\Repositories\LightingRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class LightingController
 * @package App\Http\Controllers\Api
 */

class LightingAPIController extends AppBaseController
{
    /** @var  LightingRepository */
    private $lightingRepository;

    public function __construct(LightingRepository $lightingRepo)
    {
        $this->lightingRepository = $lightingRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/lightings",
     *      summary="Get a listing of the Lightings.",
     *      tags={"Lighting"},
     *      description="Get all Lightings",
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
     *                  @SWG\Items(ref="#/definitions/Lighting")
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
        $lightings = $this->lightingRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($lightings->toArray(), 'Lightings retrieved successfully');
    }

    /**
     * @param CreateLightingAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/lightings",
     *      summary="Store a newly created Lighting in storage",
     *      tags={"Lighting"},
     *      description="Store Lighting",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Lighting that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Lighting")
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
     *                  ref="#/definitions/Lighting"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateLightingAPIRequest $request)
    {
        $input = $request->all();

        $lighting = $this->lightingRepository->create($input);

        return $this->sendResponse($lighting->toArray(), 'Lighting saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/lightings/{id}",
     *      summary="Display the specified Lighting",
     *      tags={"Lighting"},
     *      description="Get Lighting",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Lighting",
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
     *                  ref="#/definitions/Lighting"
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
        /** @var Lighting $lighting */
        $lighting = $this->lightingRepository->find($id);

        if (empty($lighting)) {
            return $this->sendError('Lighting not found');
        }

        return $this->sendResponse($lighting->toArray(), 'Lighting retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateLightingAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/lightings/{id}",
     *      summary="Update the specified Lighting in storage",
     *      tags={"Lighting"},
     *      description="Update Lighting",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Lighting",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Lighting that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Lighting")
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
     *                  ref="#/definitions/Lighting"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateLightingAPIRequest $request)
    {
        $input = $request->all();

        /** @var Lighting $lighting */
        $lighting = $this->lightingRepository->find($id);

        if (empty($lighting)) {
            return $this->sendError('Lighting not found');
        }

        $lighting = $this->lightingRepository->update($input, $id);

        return $this->sendResponse($lighting->toArray(), 'Lighting updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/lightings/{id}",
     *      summary="Remove the specified Lighting from storage",
     *      tags={"Lighting"},
     *      description="Delete Lighting",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Lighting",
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
        /** @var Lighting $lighting */
        $lighting = $this->lightingRepository->find($id);

        if (empty($lighting)) {
            return $this->sendError('Lighting not found');
        }

        $lighting->delete();

        return $this->sendResponse($id, 'Lighting deleted successfully');
    }
}
