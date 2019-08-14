<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateseedFeatureAPIRequest;
use App\Http\Requests\Api\UpdateseedFeatureAPIRequest;
use App\Models\seedFeature;
use App\Repositories\SeedFeatureRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class seedFeatureController
 * @package App\Http\Controllers\Api
 */

class SeedFeatureAPIController extends AppBaseController
{
    /** @var  seedFeatureRepository */
    private $seedFeatureRepository;

    public function __construct(SeedFeatureRepository $seedFeatureRepo)
    {
        $this->seedFeatureRepository = $seedFeatureRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/seed_features",
     *      summary="Get a listing of the seedFeatures.",
     *      tags={"seedFeature"},
     *      description="Get all seedFeatures",
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
     *                  @SWG\Items(ref="#/definitions/SeedFeature")
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
        $seedFeatures = $this->seedFeatureRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($seedFeatures->toArray(), 'seedFeatures retrieved successfully');
    }

    /**
     * @param CreateseedFeatureAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/seed_features",
     *      summary="Store a newly created seedFeature in storage",
     *      tags={"seedFeature"},
     *      description="Store seedFeature",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="seedFeature that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedFeature")
     *      ),
     *      @SWG\Parameter(
     *          name="type",
     *          in="body",
     *          description="seedFeature that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedFeature")
     *      ),
     *      @SWG\Parameter(
     *          name="unit",
     *          in="body",
     *          description="seedFeature that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedFeature")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="seedFeature that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedFeature")
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
     *                  ref="#/definitions/SeedFeature"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateseedFeatureAPIRequest $request)
    {
        $input = $request->all();

        $seedFeature = $this->seedFeatureRepository->create($input);

        return $this->sendResponse($seedFeature->toArray(), 'seedFeature saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/seedFeatures/{id}",
     *      summary="Display the specified seedFeature",
     *      tags={"seedFeature"},
     *      description="Get seedFeature",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of seedFeature",
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
     *                  ref="#/definitions/SeedFeature"
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
        /** @var seedFeature $seedFeature */
        $seedFeature = $this->seedFeatureRepository->find($id, \request()->get('relations'));

        if ($seedFeature === null) {
            return $this->sendError('seedFeature not found');
        }

        return $this->sendResponse($seedFeature->toArray(), 'seedFeature retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateseedFeatureAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/seedFeatures/{id}",
     *      summary="Update the specified seedFeature in storage",
     *      tags={"seedFeature"},
     *      description="Update seedFeature",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of seedFeature",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="seedFeature that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedFeature")
     *      ),
     *      @SWG\Parameter(
     *          name="type",
     *          in="body",
     *          description="seedFeature that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedFeature")
     *      ),
     *      @SWG\Parameter(
     *          name="unit",
     *          in="body",
     *          description="seedFeature that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedFeature")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="seedFeature that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedFeature")
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
     *                  ref="#/definitions/SeedFeature"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateseedFeatureAPIRequest $request)
    {
        $input = $request->all();

        /** @var seedFeature $seedFeature */
        $seedFeature = $this->seedFeatureRepository->find($id, \request()->get('relations'));

        if ($seedFeature === null) {
            return $this->sendError('seedFeature not found');
        }

        $seedFeature = $this->seedFeatureRepository->update($input, $id);

        return $this->sendResponse($seedFeature->toArray(), 'seedFeature updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/seedFeatures/{id}",
     *      summary="Remove the specified seedFeature from storage",
     *      tags={"seedFeature"},
     *      description="Delete seedFeature",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of seedFeature",
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
        /** @var seedFeature $seedFeature */
        $seedFeature = $this->seedFeatureRepository->find($id, \request()->get('relations'));

        if ($seedFeature === null) {
            return $this->sendError('seedFeature not found');
        }

        $seedFeature->delete();

        return $this->sendResponse($id, 'seedFeature deleted successfully');
    }
}
