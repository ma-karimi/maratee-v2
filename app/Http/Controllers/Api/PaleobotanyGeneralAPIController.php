<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\GeneralAPIRequest;
use App\Models\General;
use App\Repositories\PaleobotanyGeneralRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Response;

/**
 * Class PaleoboatnyGeneralAPIController
 * @package App\Http\Controllers\Api
 */
class PaleobotanyGeneralAPIController extends AppBaseController
{
    /** @var  PaleobotanyGeneralRepository */
    private $PaleobotanyGeneralRepository;

    public function __construct(PaleobotanyGeneralRepository $GeneralRepo)
    {
        $this->PaleobotanyGeneralRepository = $GeneralRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/paleobotany_generals",
     *      summary="Get a listing of the Generals.",
     *      tags={"General"},
     *      description="Get all Generals",
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
     *                  @SWG\Items(ref="#/definitions/General")
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
        $Generals = $this->PaleobotanyGeneralRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            []
        );

        return $this->sendResponse($Generals->toArray(), ' Generals retrieved successfully');
    }

    /**
     * @param GeneralAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/paleobotany_generals",
     *      summary="Store a newly created General in storage",
     *      tags={"General"},
     *      description="Store General",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="General that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/General")
     *      ),
     *      @SWG\Parameter(
     *          name="type",
     *          in="body",
     *          description="General that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/General")
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
     *                  ref="#/definitions/General"
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
    public function store(GeneralAPIRequest $request)
    {

        $input = $request->all();

        $General = $this->PaleobotanyGeneralRepository->create($input);

        return $this->sendResponse($General->toArray(), ' General saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/paleobotany_generals/{id}",
     *      summary="Display the specified General",
     *      tags={"General"},
     *      description="Get General",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of General",
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
     *                  ref="#/definitions/General"
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
        /** @var General $General */
        $General = $this->PaleobotanyGeneralRepository->find($id, \request()->get('relations'));

        if (empty($General)) {
            return $this->sendError(' General not found');
        }

        return $this->sendResponse($General->toArray(), ' General retrieved successfully');
    }

    /**
     * @param int $id
     * @param GeneralAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/paleobotany_generals/{id}",
     *      summary="Update the specified General in storage",
     *      tags={"General"},
     *      description="Update General",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of General",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="General that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/General")
     *      ),
     *      @SWG\Parameter(
     *          name="type",
     *          in="body",
     *          description="General that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/General")
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
     *                  ref="#/definitions/General"
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
    public function update($id, GeneralAPIRequest $request)
    {
        $input = $request->all();

        /** @var General $General */
        $General = $this->PaleobotanyGeneralRepository->find($id, \request()->get('relations'));

        if (empty($General)) {
            return $this->sendError(' General not found');
        }

        $General = $this->PaleobotanyGeneralRepository->update($input, $id);

        return $this->sendResponse($General->toArray(), 'General updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws Exception
     * @SWG\Delete(
     *      path="/paleobotany_generals/{id}",
     *      summary="Remove the specified General from storage",
     *      tags={"General"},
     *      description="Delete General",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of General",
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
        /** @var General $General */
        $General = $this->PaleobotanyGeneralRepository->find($id, \request()->get('relations'));

        if (empty($General)) {
            return $this->sendError(' General not found');
        }

        $General->delete();

        return $this->sendResponse($id, ' General deleted successfully');
    }

    /**
     * @return Response
     *
     * @SWG\Get(
     *      path="/paleobotany_generals/all",
     *      summary="Display the specified General",
     *      tags={"General"},
     *      description="Get General",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of General",
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
     *                  ref="#/definitions/General"
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
    public function all()
    {

        $General = $this->PaleobotanyGeneralRepository->all()->groupBy('type');


        return $this->sendResponse($General->toArray(), ' General retrieved successfully');
    }
}
