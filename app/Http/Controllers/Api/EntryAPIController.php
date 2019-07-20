<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateEntryAPIRequest;
use App\Http\Requests\Api\UpdateEntryAPIRequest;
use App\Models\Entry;
use App\Repositories\EntryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class EntryController
 * @package App\Http\Controllers\Api
 */

class EntryAPIController extends AppBaseController
{
    /** @var  EntryRepository */
    private $entryRepository;

    public function __construct(EntryRepository $entryRepo)
    {
        $this->entryRepository = $entryRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/entries",
     *      summary="Get a listing of the Entries.",
     *      tags={"Entry"},
     *      description="Get all Entries",
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
     *                  @SWG\Items(ref="#/definitions/Entry")
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
        $entries = $this->entryRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($entries->toArray(), 'Entries retrieved successfully');
    }

    /**
     * @param CreateEntryAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/entries",
     *      summary="Store a newly created Entry in storage",
     *      tags={"Entry"},
     *      description="Store Entry",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Entry")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Entry")
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
     *                  ref="#/definitions/Entry"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateEntryAPIRequest $request)
    {
        $input = $request->all();

        $entry = $this->entryRepository->create($input);

        return $this->sendResponse($entry->toArray(), 'Entry saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/entries/{id}",
     *      summary="Display the specified Entry",
     *      tags={"Entry"},
     *      description="Get Entry",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Entry",
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
     *                  ref="#/definitions/Entry"
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
        /** @var Entry $entry */
        $entry = $this->entryRepository->find($id);

        if ($entry === null) {
            return $this->sendError('Entry not found');
        }

        return $this->sendResponse($entry->toArray(), 'Entry retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateEntryAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/entries/{id}",
     *      summary="Update the specified Entry in storage",
     *      tags={"Entry"},
     *      description="Update Entry",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Entry",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Entry")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Entry")
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
     *                  ref="#/definitions/Entry"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateEntryAPIRequest $request)
    {
        $input = $request->all();

        /** @var Entry $entry */
        $entry = $this->entryRepository->find($id);

        if ($entry === null) {
            return $this->sendError('Entry not found');
        }

        $entry = $this->entryRepository->update($input, $id);

        return $this->sendResponse($entry->toArray(), 'Entry updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/entries/{id}",
     *      summary="Remove the specified Entry from storage",
     *      tags={"Entry"},
     *      description="Delete Entry",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Entry",
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
        /** @var Entry $entry */
        $entry = $this->entryRepository->find($id);

        if (empty($entry)) {
            return $this->sendError('Entry not found');
        }

        $entry->delete();

        return $this->sendResponse($id, 'Entry deleted successfully');
    }
}
