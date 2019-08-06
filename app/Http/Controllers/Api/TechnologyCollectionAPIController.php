<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateTechnologyCollectionAPIRequest;
use App\Http\Requests\Api\UpdateTechnologyCollectionAPIRequest;
use App\Models\TechnologyCollection;
use App\Repositories\TechnologyCollectionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class TechnologyCollectionController
 * @package App\Http\Controllers\Api
 */

class TechnologyCollectionAPIController extends AppBaseController
{
    /** @var  TechnologyCollectionRepository */
    private $technologyCollectionRepository;

    public function __construct(TechnologyCollectionRepository $technologyCollectionRepo)
    {
        $this->technologyCollectionRepository = $technologyCollectionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/technologyCollections",
     *      summary="Get a listing of the TechnologyCollections.",
     *      tags={"TechnologyCollection"},
     *      description="Get all TechnologyCollections",
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
     *                  @SWG\Items(ref="#/definitions/TechnologyCollection")
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
        $technologyCollections = $this->technologyCollectionRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($technologyCollections->toArray(), 'Technology Collections retrieved successfully');
    }

    /**
     * @param CreateTechnologyCollectionAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/technologyCollections",
     *      summary="Store a newly created TechnologyCollection in storage",
     *      tags={"TechnologyCollection"},
     *      description="Store TechnologyCollection",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="seed_technology_id",
     *          in="body",
     *          description="TechnologyCollection that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/TechnologyCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="collection_id",
     *          in="body",
     *          description="TechnologyCollection that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/TechnologyCollection")
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
     *                  ref="#/definitions/TechnologyCollection"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTechnologyCollectionAPIRequest $request)
    {
        $input = $request->all();

        $technologyCollection = $this->technologyCollectionRepository->create($input);

        return $this->sendResponse($technologyCollection->toArray(), 'Technology Collection saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/technologyCollections/{id}",
     *      summary="Display the specified TechnologyCollection",
     *      tags={"TechnologyCollection"},
     *      description="Get TechnologyCollection",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="seed_technology_id",
     *          in="body",
     *          description="TechnologyCollection that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/TechnologyCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="collection_id",
     *          in="body",
     *          description="TechnologyCollection that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/TechnologyCollection")
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
     *                  ref="#/definitions/TechnologyCollection"
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
        /** @var TechnologyCollection $technologyCollection */
        $technologyCollection = $this->technologyCollectionRepository->find($id, \request()->get('relations'));

        if (empty($technologyCollection)) {
            return $this->sendError('Technology Collection not found');
        }

        return $this->sendResponse($technologyCollection->toArray(), 'Technology Collection retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateTechnologyCollectionAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/technologyCollections/{id}",
     *      summary="Update the specified TechnologyCollection in storage",
     *      tags={"TechnologyCollection"},
     *      description="Update TechnologyCollection",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of TechnologyCollection",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="seed_technology_id",
     *          in="body",
     *          description="TechnologyCollection that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/TechnologyCollection")
     *      ),
     *      @SWG\Parameter(
     *          name="collection_id",
     *          in="body",
     *          description="TechnologyCollection that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/TechnologyCollection")
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
     *                  ref="#/definitions/TechnologyCollection"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTechnologyCollectionAPIRequest $request)
    {
        $input = $request->all();

        /** @var TechnologyCollection $technologyCollection */
        $technologyCollection = $this->technologyCollectionRepository->find($id, \request()->get('relations'));

        if (empty($technologyCollection)) {
            return $this->sendError('Technology Collection not found');
        }

        $technologyCollection = $this->technologyCollectionRepository->update($input, $id);

        return $this->sendResponse($technologyCollection->toArray(), 'TechnologyCollection updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/technologyCollections/{id}",
     *      summary="Remove the specified TechnologyCollection from storage",
     *      tags={"TechnologyCollection"},
     *      description="Delete TechnologyCollection",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of TechnologyCollection",
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
        /** @var TechnologyCollection $technologyCollection */
        $technologyCollection = $this->technologyCollectionRepository->find($id, \request()->get('relations'));

        if (empty($technologyCollection)) {
            return $this->sendError('Technology Collection not found');
        }

        $technologyCollection->delete();

        return $this->sendResponse($id, 'Technology Collection deleted successfully');
    }
}
