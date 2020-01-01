<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\BotanicalGeneralAPIRequest;
use App\Models\BotanicalGeneral;
use App\Repositories\BotanicalGeneralRepository;
use Exception;
use Illuminate\Http\Request;
use Response;

/**
 * Class BotanicalGeneralAPIController
 * @package App\Http\Controllers\Api
 */
class BotanicalGeneralAPIController extends AppBaseController
{
    /** @var  BotanicalGeneralRepository */
    private $botanicalGeneralRepository;

    public function __construct(BotanicalGeneralRepository $botanicalGeneralRepo)
    {
        $this->botanicalGeneralRepository = $botanicalGeneralRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/botanical_generals",
     *      summary="Get a listing of the BotanicalProperties.",
     *      tags={"BotanicalGeneral"},
     *      description="Get all BotanicalProperties",
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
     *                  @SWG\Items(ref="#/definitions/BotanicalGeneral")
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
        $botanicalProperties = $this->botanicalGeneralRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            []
        );
        return $this->sendResponse($botanicalProperties, 'Botanical Properties retrieved successfully');
    }

    public function all()
    {
        $botanicalProperties = $this->botanicalGeneralRepository->all();
        return $this->sendResponse($botanicalProperties, 'Botanical Properties retrieved successfully');
    }

    /**
     * @param BotanicalGeneralAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/botanical_generals",
     *      summary="Store a newly created BotanicalGeneral in storage",
     *      tags={"BotanicalGeneral"},
     *      description="Store BotanicalGeneral",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="type_id",
     *          in="body",
     *          required=true,
     *          description="1 => value , 2=>usage",
     *          @SWG\Schema(ref="#/definitions/BotanicalGeneral")
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BotanicalGeneral")
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
     *                  ref="#/definitions/BotanicalGeneral"
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
    public function store(BotanicalGeneralAPIRequest $request)
    {
        $input = $request->all();

        $botanicalGeneral = $this->botanicalGeneralRepository->create($input);

        return $this->sendResponse($botanicalGeneral->toArray(), 'Botanical General saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/botanical_generals/{id}",
     *      summary="Display the specified BotanicalGeneral",
     *      tags={"BotanicalGeneral"},
     *      description="Get BotanicalGeneral",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BotanicalGeneral",
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
     *                  ref="#/definitions/BotanicalGeneral"
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
        /** @var BotanicalGeneral $botanicalGeneral */
        $botanicalGeneral = $this->botanicalGeneralRepository->find($id, \request()->get('relations'));

        if ($botanicalGeneral === null) {
            return $this->sendError('Botanical General not found');
        }

        return $this->sendResponse($botanicalGeneral->toArray(), 'Botanical General retrieved successfully');
    }

    /**
     * @param int $id
     * @param BotanicalGeneralAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/botanical_generals/{id}",
     *      summary="Update the specified BotanicalGeneral in storage",
     *      tags={"BotanicalGeneral"},
     *      description="Update BotanicalGeneral",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BotanicalGeneral",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="type_id",
     *          in="body",
     *          required=true,
     *          description="1 => value , 2=>usage",
     *          @SWG\Schema(ref="#/definitions/BotanicalGeneral")
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/BotanicalGeneral")
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
     *                  ref="#/definitions/BotanicalGeneral"
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
    public function update($id, BotanicalGeneralAPIRequest $request)
    {
        $input = $request->all();

        /** @var BotanicalGeneral $botanicalGeneral */
        $botanicalGeneral = $this->botanicalGeneralRepository->find($id, \request()->get('relations'));

        if ($botanicalGeneral === null) {
            return $this->sendError('Botanical General not found');
        }

        $botanicalGeneral = $this->botanicalGeneralRepository->update($input, $id);

        return $this->sendResponse($botanicalGeneral->toArray(), 'BotanicalGeneral updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws Exception
     * @SWG\Delete(
     *      path="/botanical_generals/{id}",
     *      summary="Remove the specified BotanicalGeneral from storage",
     *      tags={"BotanicalGeneral"},
     *      description="Delete BotanicalGeneral",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of BotanicalGeneral",
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
        /** @var BotanicalGeneral $botanicalGeneral */
        $botanicalGeneral = $this->botanicalGeneralRepository->find($id, \request()->get('relations'));

        if (empty($botanicalGeneral)) {
            return $this->sendError('Botanical General not found');
        }

        $botanicalGeneral->delete();

        return $this->sendResponse($id, 'Botanical General deleted successfully');
    }
}
