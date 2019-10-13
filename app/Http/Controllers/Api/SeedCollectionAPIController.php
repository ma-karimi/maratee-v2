<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateSeedCollectionAPIRequest;
use App\Http\Requests\Api\UpdateSeedCollectionAPIRequest;
use App\Models\SeedCollection;
use App\Repositories\SeedCollectionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SeedCollectionController
 * @package App\Http\Controllers\Api
 */

class SeedCollectionAPIController extends AppBaseController
{
    /** @var  SeedCollectionRepository */
    private $seedCollectionRepository;

    public function __construct(SeedCollectionRepository $seedCollectionRepo)
    {
        $this->seedCollectionRepository = $seedCollectionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/seedCollections",
     *      summary="Get a listing of the SeedCollections.",
     *      tags={"SeedCollection"},
     *      description="Get all SeedCollections",
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
     *                  @SWG\Items(ref="#/definitions/SeedCollection")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     * @throws \Exception
     */
    public function index(Request $request)
    {
        $seedCollections = $this->seedCollectionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($seedCollections->toArray(), 'Seed Collections retrieved successfully');
    }

    /**
     * @param CreateSeedCollectionAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/seedCollections",
     *      summary="Store a newly created SeedCollection in storage",
     *      tags={"SeedCollection"},
     *      description="Store SeedCollection",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="SeedCollection that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
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
     *                  ref="#/definitions/SeedCollection"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSeedCollectionAPIRequest $request)
    {
        $input = $request->all();

        $seedCollection = $this->seedCollectionRepository->create($input);

        return $this->sendResponse($seedCollection->toArray(), 'Seed Collection saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/seedCollections/{id}",
     *      summary="Display the specified SeedCollection",
     *      tags={"SeedCollection"},
     *      description="Get SeedCollection",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedCollection",
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
     *                  ref="#/definitions/SeedCollection"
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
        /** @var SeedCollection $seedCollection */
        $seedCollection = $this->seedCollectionRepository->find($id);

        if (empty($seedCollection)) {
            return $this->sendError('Seed Collection not found');
        }

        return $this->sendResponse($seedCollection->toArray(), 'Seed Collection retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateSeedCollectionAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/seedCollections/{id}",
     *      summary="Update the specified SeedCollection in storage",
     *      tags={"SeedCollection"},
     *      description="Update SeedCollection",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedCollection",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="SeedCollection that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedCollection")
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
     *                  ref="#/definitions/SeedCollection"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSeedCollectionAPIRequest $request)
    {
        $input = $request->all();

        /** @var SeedCollection $seedCollection */
        $seedCollection = $this->seedCollectionRepository->find($id);

        if (empty($seedCollection)) {
            return $this->sendError('Seed Collection not found');
        }

        $seedCollection = $this->seedCollectionRepository->update($input, $id);

        return $this->sendResponse($seedCollection->toArray(), 'SeedCollection updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/seedCollections/{id}",
     *      summary="Remove the specified SeedCollection from storage",
     *      tags={"SeedCollection"},
     *      description="Delete SeedCollection",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedCollection",
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
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var SeedCollection $seedCollection */
        $seedCollection = $this->seedCollectionRepository->find($id);

        if (empty($seedCollection)) {
            return $this->sendError('Seed Collection not found');
        }

        $seedCollection->delete();

        return $this->sendResponse($id, 'Seed Collection deleted successfully');
    }
}
