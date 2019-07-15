<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateEntryHubAPIRequest;
use App\Http\Requests\Api\UpdateEntryHubAPIRequest;
use App\Models\EntryHub;
use App\Repositories\EntryHubRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class EntryHubController
 * @package App\Http\Controllers\Api
 */

class EntryHubAPIController extends AppBaseController
{
    /** @var  EntryHubRepository */
    private $entryHubRepository;

    public function __construct(EntryHubRepository $entryHubRepo)
    {
        $this->entryHubRepository = $entryHubRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/entryHubs",
     *      summary="Get a listing of the EntryHubs.",
     *      tags={"EntryHub"},
     *      description="Get all EntryHubs",
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
     *                  @SWG\Items(ref="#/definitions/EntryHub")
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
        $entryHubs = $this->entryHubRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($entryHubs->toArray(), 'Entry Hubs retrieved successfully');
    }

    /**
     * @param CreateEntryHubAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/entryHubs",
     *      summary="Store a newly created EntryHub in storage",
     *      tags={"EntryHub"},
     *      description="Store EntryHub",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="EntryHub that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/EntryHub")
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
     *                  ref="#/definitions/EntryHub"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateEntryHubAPIRequest $request)
    {
        $input = $request->all();

        $entryHub = $this->entryHubRepository->create($input);

        return $this->sendResponse($entryHub->toArray(), 'Entry Hub saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/entryHubs/{id}",
     *      summary="Display the specified EntryHub",
     *      tags={"EntryHub"},
     *      description="Get EntryHub",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of EntryHub",
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
     *                  ref="#/definitions/EntryHub"
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
        /** @var EntryHub $entryHub */
        $entryHub = $this->entryHubRepository->find($id);

        if (empty($entryHub)) {
            return $this->sendError('Entry Hub not found');
        }

        return $this->sendResponse($entryHub->toArray(), 'Entry Hub retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateEntryHubAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/entryHubs/{id}",
     *      summary="Update the specified EntryHub in storage",
     *      tags={"EntryHub"},
     *      description="Update EntryHub",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of EntryHub",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="EntryHub that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/EntryHub")
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
     *                  ref="#/definitions/EntryHub"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateEntryHubAPIRequest $request)
    {
        $input = $request->all();

        /** @var EntryHub $entryHub */
        $entryHub = $this->entryHubRepository->find($id);

        if (empty($entryHub)) {
            return $this->sendError('Entry Hub not found');
        }

        $entryHub = $this->entryHubRepository->update($input, $id);

        return $this->sendResponse($entryHub->toArray(), 'EntryHub updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/entryHubs/{id}",
     *      summary="Remove the specified EntryHub from storage",
     *      tags={"EntryHub"},
     *      description="Delete EntryHub",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of EntryHub",
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
        /** @var EntryHub $entryHub */
        $entryHub = $this->entryHubRepository->find($id);

        if (empty($entryHub)) {
            return $this->sendError('Entry Hub not found');
        }

        $entryHub->delete();

        return $this->sendResponse($id, 'Entry Hub deleted successfully');
    }
}
