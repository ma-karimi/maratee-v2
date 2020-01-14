<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\CreateGeneralAPIRequest;
use App\Http\Requests\Api\UpdateGeneralAPIRequest;
use App\Models\General;
use App\Repositories\GeneralRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Response;

/**
 * Class GeneralController
 * @package App\Http\Controllers\Api
 */
class GeneralAPIController extends AppBaseController
{
    /** @var  GeneralRepository */
    private $GeneralRepository;

    public function __construct(GeneralRepository $GeneralRepo)
    {
        $this->GeneralRepository = $GeneralRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/generals",
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
        $Generals = $this->GeneralRepository->all(
            [],
            null,
            null,
            []
        );

        return $this->sendResponse($Generals->toArray(), ' Generals retrieved successfully');
    }

    /**
     * @param CreateGeneralAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/generals",
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
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="General that should be stored",
     *          required=false,
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
    public function store(CreateGeneralAPIRequest $request)
    {

        $input = $request->all();

        $General = $this->GeneralRepository->create($input);

        return $this->sendResponse($General->toArray(), ' General saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/generals/{id}",
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
        $General = $this->GeneralRepository->find($id, \request()->get('relations'));

        if (empty($General)) {
            return $this->sendError(' General not found');
        }

        return $this->sendResponse($General->toArray(), ' General retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateGeneralAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/generals/{id}",
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
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="General that should be stored",
     *          required=false,
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
    public function update($id, UpdateGeneralAPIRequest $request)
    {
        $input = $request->all();

        /** @var General $General */
        $General = $this->GeneralRepository->find($id, \request()->get('relations'));

        if (empty($General)) {
            return $this->sendError(' General not found');
        }

        $General = $this->GeneralRepository->update($input, $id);

        return $this->sendResponse($General->toArray(), 'General updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws Exception
     * @SWG\Delete(
     *      path="/generals/{id}",
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
        $General = $this->GeneralRepository->find($id, \request()->get('relations'));

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
     *      path="/generals/all",
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

        $General = $this->GeneralRepository->all()->groupBy('type');


        return $this->sendResponse($General->toArray(), ' General retrieved successfully');
    }


    /**
     * @param $type
     * @return Response
     *
     * @SWG\Get(
     *      path="/generals/{type}/all",
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
     * @throws ValidationException
     */
    public function type($type)
    {

        $General = $this->GeneralRepository->allWithType($type);


        return $this->sendResponse($General->toArray(), ' General retrieved successfully');
    }
}
