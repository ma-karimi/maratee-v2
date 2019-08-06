<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreatePaleontologCitationAPIRequest;
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
     *      path="/paleontologyCitations",
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
     */
    public function index(Request $request)
    {
        $paleontologyCitations = $this->paleontologyCitationRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($paleontologyCitations->toArray(), 'Paleontology Citations retrieved successfully');
    }

    /**
     * @param CreatePaleontologyCitationAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/paleontologyCitations",
     *      summary="Store a newly created PaleontologyCitation in storage",
     *      tags={"PaleontologyCitation"},
     *      description="Store PaleontologyCitation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="paleontology_id",
     *          in="body",
     *          description="PaleontologyCitation that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PaleontologyCitation")
     *      ),
     *      @SWG\Parameter(
     *          name="article_id",
     *          in="body",
     *          description="PaleontologyCitation that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PaleontologyCitation")
     *      ),
     *      @SWG\Parameter(
     *          name="user_id",
     *          in="body",
     *          description="PaleontologyCitation that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PaleontologyCitation")
     *      ),
     *      @SWG\Parameter(
     *          name="media_id",
     *          in="body",
     *          description="PaleontologyCitation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PaleontologyCitation")
     *      ),
     *      @SWG\Parameter(
     *          name="plates_no",
     *          in="body",
     *          description="PaleontologyCitation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PaleontologyCitation")
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
    public function store(CreatePaleontologCitationAPIRequest $request)
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
     *      path="/paleontologyCitations/{id}",
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
        $paleontologyCitation = $this->paleontologyCitationRepository->find($id, \request()->get('relations'));

        if (empty($paleontologyCitation)) {
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
     *      path="/paleontologyCitations/{id}",
     *      summary="Update the specified PaleontologyCitation in storage",
     *      tags={"PaleontologyCitation"},
     *      description="Update PaleontologyCitation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of PaleontologyCitation",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="paleontology_id",
     *          in="body",
     *          description="PaleontologyCitation that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PaleontologyCitation")
     *      ),
     *      @SWG\Parameter(
     *          name="article_id",
     *          in="body",
     *          description="PaleontologyCitation that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PaleontologyCitation")
     *      ),
     *      @SWG\Parameter(
     *          name="user_id",
     *          in="body",
     *          description="PaleontologyCitation that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PaleontologyCitation")
     *      ),
     *      @SWG\Parameter(
     *          name="media_id",
     *          in="body",
     *          description="PaleontologyCitation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PaleontologyCitation")
     *      ),
     *      @SWG\Parameter(
     *          name="plates_no",
     *          in="body",
     *          description="PaleontologyCitation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PaleontologyCitation")
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
        $paleontologyCitation = $this->paleontologyCitationRepository->find($id, \request()->get('relations'));

        if (empty($paleontologyCitation)) {
            return $this->sendError('Paleontology Citation not found');
        }

        $paleontologyCitation = $this->paleontologyCitationRepository->update($input, $id);

        return $this->sendResponse($paleontologyCitation->toArray(), 'PaleontologyCitation updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/paleontologyCitations/{id}",
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
     */
    public function destroy($id)
    {
        /** @var PaleontologyCitation $paleontologyCitation */
        $paleontologyCitation = $this->paleontologyCitationRepository->find($id, \request()->get('relations'));

        if (empty($paleontologyCitation)) {
            return $this->sendError('Paleontology Citation not found');
        }

        $paleontologyCitation->delete();

        return $this->sendResponse($id, 'Paleontology Citation deleted successfully');
    }
}
