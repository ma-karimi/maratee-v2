<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\CitationAPIRequest;
use App\Models\Citation;
use App\Repositories\CitationRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Response;

/**
 * Class CitationAPIController
 * @package App\Http\Controllers\Api
 */
class CitationAPIController extends AppBaseController
{
    /** @var  CitationRepository */
    private $citationRepository;

    public function __construct(CitationRepository $citationRepo)
    {
        $this->citationRepository = $citationRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/citations",
     *      summary="Get a listing of the Citations.",
     *      tags={"Citation"},
     *      description="Get all Citations",
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
     *                  @SWG\Items(ref="#/definitions/Citation")
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
        $citations = $this->citationRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($citations->toArray(), 'Citations retrieved successfully');
    }

    public function all(Request $request)
    {
        $citations = $this->citationRepository->all();

        return $this->sendResponse($citations->toArray(), 'Citations retrieved successfully');
    }

    /**
     * @param CitationAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/citations",
     *      summary="Store a newly created Citation in storage",
     *      tags={"Citation"},
     *      description="Store Citation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="author_id",
     *          in="body",
     *          required=true,
     *     @SWG\Schema(ref="#/definitions/Citation")
     *      ),
     *      @SWG\Parameter(
     *          name="year",
     *          in="body",
     *          required=true,
     *     @SWG\Schema(ref="#/definitions/Citation")
     *      ),
     *      @SWG\Parameter(
     *          name="publication_name",
     *          in="body",
     *          required=false,
     *     @SWG\Schema(ref="#/definitions/Citation")
     *      ),
     *      @SWG\Parameter(
     *          name="volume",
     *          in="body",
     *          required=false,
     *     @SWG\Schema(ref="#/definitions/Citation")
     *      ),
     *      @SWG\Parameter(
     *          name="pages",
     *          in="body",
     *          required=false,
     *     @SWG\Schema(ref="#/definitions/Citation")
     *      ),
     *      @SWG\Parameter(
     *          name="plates",
     *          in="body",
     *          required=false,
     *     @SWG\Schema(ref="#/definitions/Citation")
     *      ),
     *      @SWG\Parameter(
     *          name="figures_number",
     *          in="body",
     *          required=false,
     *      @SWG\Schema(ref="#/definitions/Citation")
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
     *                  ref="#/definitions/Citation"
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
    public function store(CitationAPIRequest $request)
    {
        $input = $request->all();

        $citation = $this->citationRepository->create($input);

        return $this->sendResponse($citation->toArray(), 'Citation saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/citations/{id}",
     *      summary="Display the specified Citation",
     *      tags={"Citation"},
     *      description="Get Citation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Citation",
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
     *                  ref="#/definitions/Citation"
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
        /** @var Citation $citation */
        $citation = $this->citationRepository->find($id, \request()->get('relations'));

        if ($citation === null) {
            return $this->sendError('Citation not found');
        }

        return $this->sendResponse($citation->toArray(), 'Citation retrieved successfully');
    }

    /**
     * @param int $id
     * @param CitationAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/citations/{id}",
     *      summary="Update the specified Citation in storage",
     *      tags={"Citation"},
     *      description="Update Citation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Citation",
     *          type="integer",
     *          required=true,
     *          in="path",
     *     @SWG\Schema(ref="#/definitions/Citation")
     *      ),
     *      @SWG\Parameter(
     *          name="actor_id",
     *          in="body",
     *          required=true,
     *     @SWG\Schema(ref="#/definitions/Citation")
     *      ),
     *      @SWG\Parameter(
     *          name="year",
     *          in="body",
     *          required=true,
     *     @SWG\Schema(ref="#/definitions/Citation")
     *      ),
     *      @SWG\Parameter(
     *          name="publication_name",
     *          in="body",
     *          required=false,
     *     @SWG\Schema(ref="#/definitions/Citation")
     *      ),
     *      @SWG\Parameter(
     *          name="volume",
     *          in="body",
     *          required=false,
     *     @SWG\Schema(ref="#/definitions/Citation")
     *      ),
     *      @SWG\Parameter(
     *          name="pages",
     *          in="body",
     *          required=false,
     *     @SWG\Schema(ref="#/definitions/Citation")
     *      ),
     *      @SWG\Parameter(
     *          name="plates",
     *          in="body",
     *          required=false,
     *     @SWG\Schema(ref="#/definitions/Citation")
     *      ),
     *      @SWG\Parameter(
     *          name="figures_number",
     *          in="body",
     *          required=false,
     *     @SWG\Schema(ref="#/definitions/Citation")
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
     *                  ref="#/definitions/Citation"
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
    public function update($id, CitationAPIRequest $request)
    {
        $input = $request->all();

        /** @var Citation $citation */
        $citation = $this->citationRepository->find($id);

        if ($citation === null) {
            return $this->sendError('Citation not found');
        }

        $citation = $this->citationRepository->update($input, $id);

        return $this->sendResponse($citation->toArray(), 'Citation updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/citations/{id}",
     *      summary="Remove the specified Citation from storage",
     *      tags={"Citation"},
     *      description="Delete Citation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Citation",
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
     * @throws Exception
     */
    public function destroy($id)
    {
        /** @var Citation $citation */
        $citation = $this->citationRepository->find($id, \request()->get('relations'));

        if ($citation === null) {
            return $this->sendError('Citation not found');
        }

        $citation->delete();

        return $this->sendResponse($id, 'Citation deleted successfully');
    }
}
