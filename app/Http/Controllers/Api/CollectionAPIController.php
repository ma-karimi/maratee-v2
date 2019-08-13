<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateCollectionAPIRequest;
use App\Http\Requests\Api\UpdateCollectionAPIRequest;
use App\Models\Collection;
use App\Repositories\CollectionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class CollectionController
 * @package App\Http\Controllers\Api
 */

class CollectionAPIController extends AppBaseController
{
    /** @var  CollectionRepository */
    private $collectionRepository;

    public function __construct(CollectionRepository $collectionRepo)
    {
        $this->collectionRepository = $collectionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/collections",
     *      summary="Get a listing of the Collections.",
     *      tags={"Collection"},
     *      description="Get all Collections",
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
     *                  @SWG\Items(ref="#/definitions/Collection")
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
        $collections = $this->collectionRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($collections->toArray(), 'Collections retrieved successfully');
    }

    /**
     * @param CreateCollectionAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/collections",
     *      summary="Store a newly created Collection in storage",
     *      tags={"Collection"},
     *      description="Store Collection",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Collection")
     *      ),
     *      @SWG\Parameter(
     *          name="type",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Collection")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Collection")
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
     *                  ref="#/definitions/Collection"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateCollectionAPIRequest $request)
    {
        $input = $request->all();

        $collection = $this->collectionRepository->create($input);

        return $this->sendResponse($collection->toArray(), 'Collection saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/collections/{id}",
     *      summary="Display the specified Collection",
     *      tags={"Collection"},
     *      description="Get Collection",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Collection",
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
     *                  ref="#/definitions/Collection"
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
        /** @var Collection $collection */
        $collection = $this->collectionRepository->find($id, \request()->get('relations'));

        if ($collection === null) {
            return $this->sendError('Collection not found');
        }

        return $this->sendResponse($collection->toArray(), 'Collection retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateCollectionAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/collections/{id}",
     *      summary="Update the specified Collection in storage",
     *      tags={"Collection"},
     *      description="Update Collection",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Collection",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Collection")
     *      ),
     *      @SWG\Parameter(
     *          name="type",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Collection")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Collection")
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
     *                  ref="#/definitions/Collection"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateCollectionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Collection $collection */
        $collection = $this->collectionRepository->find($id, \request()->get('relations'));

        if ($collection === null) {
            return $this->sendError('Collection not found');
        }

        $collection = $this->collectionRepository->update($input, $id);

        return $this->sendResponse($collection->toArray(), 'Collection updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/collections/{id}",
     *      summary="Remove the specified Collection from storage",
     *      tags={"Collection"},
     *      description="Delete Collection",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Collection",
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
        /** @var Collection $collection */
        $collection = $this->collectionRepository->find($id, \request()->get('relations'));

        if ($collection === null) {
            return $this->sendError('Collection not found');
        }

        $collection->delete();

        return $this->sendResponse($id, 'Collection deleted successfully');
    }
}
