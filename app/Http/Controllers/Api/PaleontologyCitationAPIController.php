<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreatePaleontologyCitationAPIRequest;
use App\Http\Requests\Api\UpdatePaleontologyCitationAPIRequest;
use App\Models\PaleontologyCitation;
use App\Repositories\PaleontologyCitationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PaleontologyCitationController
 * @package App\Http\Controllers\Api
 */

class PaleontologyCitationAPIController extends AppBaseController
{
    /** @var  PaleontologyCitationRepository */
    private $paleontologyCitationRepository;

    public function __construct(PaleontologyCitationRepository $paleontologyCitationRepo)
    {
        $this->paleontologyCitationRepository = $paleontologyCitationRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/paleontology_citations",
     *      summary="Get a listing of the PaleontologyCitations.",
     *      tags={"PaleontologyCitation"},
     *      description="Get all PaleontologyCitations",
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
     *                  @SWG\Items(ref="#/definitions/PaleontologyCitation")
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
        $paleontologyCitations = $this->paleontologyCitationRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($paleontologyCitations->toArray(), 'Paleontology Citations retrieved successfully');
    }

    /**
     * @param CreatePaleontologyCitationAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/paleontology_citations",
     *      summary="Store a newly created PaleontologyCitation in storage",
     *      tags={"PaleontologyCitation"},
     *      description="Store PaleontologyCitation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="paleontology_id",
     *          in="body",
     *          required=true,
     *     @SWG\Schema(ref="#/definitions/PaleontologyCitation")
     *      ),
     *      @SWG\Parameter(
     *          name="author_id",
     *          in="body",
     *          required=true,
     *     @SWG\Schema(ref="#/definitions/PaleontologyCitation")
     *      ),
     *      @SWG\Parameter(
     *          name="year",
     *          in="body",
     *          required=true,
     *     @SWG\Schema(ref="#/definitions/PaleontologyCitation")
     *      ),
     *      @SWG\Parameter(
     *          name="publication_name",
     *          in="body",
     *          required=false,
     *     @SWG\Schema(ref="#/definitions/PaleontologyCitation")
     *      ),
     *      @SWG\Parameter(
     *          name="volume",
     *          in="body",
     *          required=false,
     *     @SWG\Schema(ref="#/definitions/PaleontologyCitation")
     *      ),
     *      @SWG\Parameter(
     *          name="pages",
     *          in="body",
     *          required=false,
     *     @SWG\Schema(ref="#/definitions/PaleontologyCitation")
     *      ),
     *      @SWG\Parameter(
     *          name="plates",
     *          in="body",
     *          required=false,
     *     @SWG\Schema(ref="#/definitions/PaleontologyCitation")
     *      ),
     *      @SWG\Parameter(
     *          name="figures_number",
     *          in="body",
     *          required=false,
     *      @SWG\Schema(ref="#/definitions/PaleontologyCitation")
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
     *                  ref="#/definitions/PaleontologyCitation"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePaleontologyCitationAPIRequest $request)
    {
        $input = $request->all();

        $paleontologyCitation = $this->paleontologyCitationRepository->create($input);

        return $this->sendResponse($paleontologyCitation->toArray(), 'Paleontology Citation saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/paleontology_citations/{id}",
     *      summary="Display the specified PaleontologyCitation",
     *      tags={"PaleontologyCitation"},
     *      description="Get PaleontologyCitation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of PaleontologyCitation",
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
     *                  ref="#/definitions/PaleontologyCitation"
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
        /** @var PaleontologyCitation $paleontologyCitation */
        $paleontologyCitation = $this->paleontologyCitationRepository->find($id);

        if ($paleontologyCitation === null) {
            return $this->sendError('Paleontology Citation not found');
        }

        return $this->sendResponse($paleontologyCitation->toArray(), 'Paleontology Citation retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePaleontologyCitationAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/paleontology_citations/{id}",
     *      summary="Update the specified PaleontologyCitation in storage",
     *      tags={"PaleontologyCitation"},
     *      description="Update PaleontologyCitation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of PaleontologyCitation",
     *          type="integer",
     *          required=true,
     *          in="path",
     *     @SWG\Schema(ref="#/definitions/PaleontologyCitation")
     *      ),
     *      @SWG\Parameter(
     *          name="paleontology_id",
     *          in="body",
     *          required=true,
     *     @SWG\Schema(ref="#/definitions/PaleontologyCitation")
     *      ),
     *      @SWG\Parameter(
     *          name="author_id",
     *          in="body",
     *          required=true,
     *     @SWG\Schema(ref="#/definitions/PaleontologyCitation")
     *      ),
     *      @SWG\Parameter(
     *          name="year",
     *          in="body",
     *          required=true,
     *     @SWG\Schema(ref="#/definitions/PaleontologyCitation")
     *      ),
     *      @SWG\Parameter(
     *          name="publication_name",
     *          in="body",
     *          required=false,
     *     @SWG\Schema(ref="#/definitions/PaleontologyCitation")
     *      ),
     *      @SWG\Parameter(
     *          name="volume",
     *          in="body",
     *          required=false,
     *     @SWG\Schema(ref="#/definitions/PaleontologyCitation")
     *      ),
     *      @SWG\Parameter(
     *          name="pages",
     *          in="body",
     *          required=false,
     *     @SWG\Schema(ref="#/definitions/PaleontologyCitation")
     *      ),
     *      @SWG\Parameter(
     *          name="plates",
     *          in="body",
     *          required=false,
     *     @SWG\Schema(ref="#/definitions/PaleontologyCitation")
     *      ),
     *      @SWG\Parameter(
     *          name="figures_number",
     *          in="body",
     *          required=false,
     *     @SWG\Schema(ref="#/definitions/PaleontologyCitation")
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
     *                  ref="#/definitions/PaleontologyCitation"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePaleontologyCitationAPIRequest $request)
    {
        $input = $request->all();

        /** @var PaleontologyCitation $paleontologyCitation */
        $paleontologyCitation = $this->paleontologyCitationRepository->find($id);

        if ($paleontologyCitation === null) {
            return $this->sendError('Paleontology Citation not found');
        }

        $paleontologyCitation = $this->paleontologyCitationRepository->update($input, $id);

        return $this->sendResponse($paleontologyCitation->toArray(), 'PaleontologyCitation updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/paleontology_citations/{id}",
     *      summary="Remove the specified PaleontologyCitation from storage",
     *      tags={"PaleontologyCitation"},
     *      description="Delete PaleontologyCitation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of PaleontologyCitation",
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
        /** @var PaleontologyCitation $paleontologyCitation */
        $paleontologyCitation = $this->paleontologyCitationRepository->find($id);

        if ($paleontologyCitation === null) {
            return $this->sendError('Paleontology Citation not found');
        }

        $paleontologyCitation->delete();

        return $this->sendResponse($id, 'Paleontology Citation deleted successfully');
    }
}
