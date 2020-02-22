<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\JournalAPIRequest;
use App\Models\Journal;
use App\Repositories\JournalRepository;
use Exception;
use Illuminate\Http\Request;


/**
 * Class JournalController
 * @package App\Http\Controllers\Api
 */
class JournalAPIController extends AppBaseController
{
    /** @var  JournalRepository */
    private $journalRepository;

    public function __construct(JournalRepository $journalRepository)
    {
        $this->journalRepository = $journalRepository;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/actors",
     *      summary="Get a listing of the Journals.",
     *      tags={"Journal"},
     *      description="Get all Journals",
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
     *                  @SWG\Items(ref="#/definitions/Journal")
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
        $journals = $this->journalRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($journals->toArray(), 'Journals retrieved successfully');
    }

    /**
     * @param JournalAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/actors",
     *      summary="Store a newly created Journal in storage",
     *      tags={"Journal"},
     *      description="Store Journal",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="title",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Journal")
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
     *                  ref="#/definitions/Journal"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(JournalAPIRequest $request)
    {
        $input = $request->all();

        $journal = $this->journalRepository->create($input);

        return $this->sendResponse($journal->toArray(), 'Journal saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/actors/{id}",
     *      summary="Display the specified Journal",
     *      tags={"Journal"},
     *      description="Get Journal",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Journal",
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
     *                  ref="#/definitions/Journal"
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
        /** @var Journal $journal */
        $journal = $this->journalRepository->find($id, \request()->get('relations'));

        if ($journal === null) {
            return $this->sendError('Journal not found');
        }

        return $this->sendResponse($journal->toArray(), 'Journal retrieved successfully');
    }

    /**
     * @param int $id
     * @param JournalAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/actors/{id}",
     *      summary="Update the specified Journal in storage",
     *      tags={"Journal"},
     *      description="Update Journal",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Journal",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="title",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Journal")
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
     *                  ref="#/definitions/Journal"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update($id, JournalAPIRequest $request)
    {
        $input = $request->all();

        /** @var Journal $journal */
        $journal = $this->journalRepository->find($id, \request()->get('relations'));

        if ($journal === null) {
            return $this->sendError('Journal not found');
        }

        $journal = $this->journalRepository->update($input, $id);

        return $this->sendResponse($journal->toArray(), 'Journal updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws Exception
     * @SWG\Delete(
     *      path="/actors/{id}",
     *      summary="Remove the specified Journal from storage",
     *      tags={"Journal"},
     *      description="Delete Journal",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Journal",
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
        /** @var Journal $journal */
        $journal = $this->journalRepository->find($id, \request()->get('relations'));

        if ($journal === null) {
            return $this->sendError('Journal not found');
        }

        $journal->delete();

        return $this->sendResponse($id, 'Journal deleted successfully');
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @throws Exception
     * @SWG\Get(
     *      path="/actors/all",
     *      summary="get all Journal Grouped By ",
     *      tags={"Taxonomy"},
     *      description="get all Journal Grouped By ",
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
     *                  @SWG\Items(ref="#/definitions/Journal")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function all(Request $request)
    {
        $taxonomies = $this->journalRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($taxonomies->toArray(), 'Journals retrieved successfully');
    }
}
