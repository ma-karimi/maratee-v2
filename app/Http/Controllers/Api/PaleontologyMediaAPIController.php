<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreatePaleontologyMediaAPIRequest;
use App\Http\Requests\Api\UpdatePaleontologyMediaAPIRequest;
use App\Models\PaleontologyMedia;
use App\Repositories\PaleontologyMediaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PaleontologyMediaController
 * @package App\Http\Controllers\Api
 */

class PaleontologyMediaAPIController extends AppBaseController
{
    /** @var  PaleontologyMediaRepository */
    private $paleontologyMediaRepository;

    public function __construct(PaleontologyMediaRepository $paleontologyMediaRepo)
    {
        $this->paleontologyMediaRepository = $paleontologyMediaRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/paleontologyMedia",
     *      summary="Get a listing of the PaleontologyMedia.",
     *      tags={"PaleontologyMedia"},
     *      description="Get all PaleontologyMedia",
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
     *                  @SWG\Items(ref="#/definitions/PaleontologyMedia")
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
        $paleontologyMedia = $this->paleontologyMediaRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($paleontologyMedia->toArray(), 'Paleontology Media retrieved successfully');
    }

    /**
     * @param CreatePaleontologyMediaAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/paleontologyMedia",
     *      summary="Store a newly created PaleontologyMedia in storage",
     *      tags={"PaleontologyMedia"},
     *      description="Store PaleontologyMedia",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="media_id",
     *          in="body",
     *          description="PaleontologyMedia that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PaleontologyMedia")
     *      ),
     *      @SWG\Parameter(
     *          name="user_id",
     *          in="body",
     *          description="PaleontologyMedia that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PaleontologyMedia")
     *      ),
     *      @SWG\Parameter(
     *          name="exchange_id",
     *          in="body",
     *          description="PaleontologyMedia that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PaleontologyMedia")
     *      ),
     *      @SWG\Parameter(
     *          name="credential_id",
     *          in="body",
     *          description="PaleontologyMedia that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PaleontologyMedia")
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
     *                  ref="#/definitions/PaleontologyMedia"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePaleontologyMediaAPIRequest $request)
    {
        $input = $request->all();

        $paleontologyMedia = $this->paleontologyMediaRepository->create($input);

        return $this->sendResponse($paleontologyMedia->toArray(), 'Paleontology Media saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/paleontologyMedia/{id}",
     *      summary="Display the specified PaleontologyMedia",
     *      tags={"PaleontologyMedia"},
     *      description="Get PaleontologyMedia",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of PaleontologyMedia",
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
     *                  ref="#/definitions/PaleontologyMedia"
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
        /** @var PaleontologyMedia $paleontologyMedia */
        $paleontologyMedia = $this->paleontologyMediaRepository->find($id, \request()->get('relations'));

        if (empty($paleontologyMedia)) {
            return $this->sendError('Paleontology Media not found');
        }

        return $this->sendResponse($paleontologyMedia->toArray(), 'Paleontology Media retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePaleontologyMediaAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/paleontologyMedia/{id}",
     *      summary="Update the specified PaleontologyMedia in storage",
     *      tags={"PaleontologyMedia"},
     *      description="Update PaleontologyMedia",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of PaleontologyMedia",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="media_id",
     *          in="body",
     *          description="PaleontologyMedia that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PaleontologyMedia")
     *      ),
     *      @SWG\Parameter(
     *          name="user_id",
     *          in="body",
     *          description="PaleontologyMedia that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PaleontologyMedia")
     *      ),
     *      @SWG\Parameter(
     *          name="exchange_id",
     *          in="body",
     *          description="PaleontologyMedia that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PaleontologyMedia")
     *      ),
     *      @SWG\Parameter(
     *          name="credential_id",
     *          in="body",
     *          description="PaleontologyMedia that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/PaleontologyMedia")
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
     *                  ref="#/definitions/PaleontologyMedia"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePaleontologyMediaAPIRequest $request)
    {
        $input = $request->all();

        /** @var PaleontologyMedia $paleontologyMedia */
        $paleontologyMedia = $this->paleontologyMediaRepository->find($id, \request()->get('relations'));

        if (empty($paleontologyMedia)) {
            return $this->sendError('Paleontology Media not found');
        }

        $paleontologyMedia = $this->paleontologyMediaRepository->update($input, $id);

        return $this->sendResponse($paleontologyMedia->toArray(), 'PaleontologyMedia updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/paleontologyMedia/{id}",
     *      summary="Remove the specified PaleontologyMedia from storage",
     *      tags={"PaleontologyMedia"},
     *      description="Delete PaleontologyMedia",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of PaleontologyMedia",
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
        /** @var PaleontologyMedia $paleontologyMedia */
        $paleontologyMedia = $this->paleontologyMediaRepository->find($id, \request()->get('relations'));

        if (empty($paleontologyMedia)) {
            return $this->sendError('Paleontology Media not found');
        }

        $paleontologyMedia->delete();

        return $this->sendResponse($id, 'Paleontology Media deleted successfully');
    }
}
