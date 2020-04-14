<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\NonflowerGeneralAPIRequest;
use App\Models\NonflowerGeneral;
use App\Repositories\NonflowerGeneralRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Response;

/**
 * Class NonflowerGeneralController
 * @package App\Http\Controllers\Api
 */
class NonflowerGeneralAPIController extends AppBaseController
{
    /** @var  NonflowerGeneralRepository */
    private $nonflowerGeneralRepository;

    public function __construct(NonflowerGeneralRepository $nonflowerGeneralRepo)
    {
        $this->nonflowerGeneralRepository = $nonflowerGeneralRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/nonflower_generals",
     *      summary="Get a listing of the NonflowerGenerals.",
     *      tags={"NonflowerGeneral"},
     *      description="Get all NonflowerGenerals",
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
     *                  @SWG\Items(ref="#/definitions/NonflowerGeneral")
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
        $nonflowerGenerals = $this->nonflowerGeneralRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            []
        );

        return $this->sendResponse($nonflowerGenerals->toArray(), ' NonflowerGenerals retrieved successfully');
    }

    /**
     * @param NonflowerGeneralAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/nonflower_generals",
     *      summary="Store a newly created NonflowerGeneral in storage",
     *      tags={"NonflowerGeneral"},
     *      description="Store NonflowerGeneral",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="NonflowerGeneral that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/NonflowerGeneral")
     *      ),
     *      @SWG\Parameter(
     *          name="type",
     *          in="body",
     *          description="NonflowerGeneral that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/NonflowerGeneral")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="NonflowerGeneral that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/NonflowerGeneral")
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
     *                  ref="#/definitions/NonflowerGeneral"
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
    public function store(NonflowerGeneralAPIRequest $request)
    {

        $input = $request->all();

        $nonflowerGeneral = $this->nonflowerGeneralRepository->create($input);

        return $this->sendResponse($nonflowerGeneral->toArray(), ' NonflowerGeneral saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/nonflower_generals/{id}",
     *      summary="Display the specified NonflowerGeneral",
     *      tags={"NonflowerGeneral"},
     *      description="Get NonflowerGeneral",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of NonflowerGeneral",
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
     *                  ref="#/definitions/NonflowerGeneral"
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
        /** @var NonflowerGeneral $nonflowerGeneral */
        $nonflowerGeneral = $this->nonflowerGeneralRepository->find($id, \request()->get('relations'));

        if (empty($nonflowerGeneral)) {
            return $this->sendError(' NonflowerGeneral not found');
        }

        return $this->sendResponse($nonflowerGeneral->toArray(), ' NonflowerGeneral retrieved successfully');
    }

    /**
     * @param int $id
     * @param NonflowerGeneralAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/nonflower_generals/{id}",
     *      summary="Update the specified NonflowerGeneral in storage",
     *      tags={"NonflowerGeneral"},
     *      description="Update NonflowerGeneral",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of NonflowerGeneral",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="NonflowerGeneral that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/NonflowerGeneral")
     *      ),
     *      @SWG\Parameter(
     *          name="type",
     *          in="body",
     *          description="NonflowerGeneral that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/NonflowerGeneral")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="NonflowerGeneral that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/NonflowerGeneral")
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
     *                  ref="#/definitions/NonflowerGeneral"
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
    public function update($id, NonflowerGeneralAPIRequest $request)
    {
        $input = $request->all();

        /** @var NonflowerGeneral $nonflowerGeneral */
        $nonflowerGeneral = $this->nonflowerGeneralRepository->find($id, \request()->get('relations'));

        if (empty($nonflowerGeneral)) {
            return $this->sendError(' NonflowerGeneral not found');
        }

        $nonflowerGeneral = $this->nonflowerGeneralRepository->update($input, $id);

        return $this->sendResponse($nonflowerGeneral->toArray(), 'NonflowerGeneral updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws Exception
     * @SWG\Delete(
     *      path="/nonflower_generals/{id}",
     *      summary="Remove the specified NonflowerGeneral from storage",
     *      tags={"NonflowerGeneral"},
     *      description="Delete NonflowerGeneral",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of NonflowerGeneral",
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
        /** @var NonflowerGeneral $nonflowerGeneral */
        $nonflowerGeneral = $this->nonflowerGeneralRepository->find($id, \request()->get('relations'));

        if (empty($nonflowerGeneral)) {
            return $this->sendError(' NonflowerGeneral not found');
        }

        $nonflowerGeneral->delete();

        return $this->sendResponse($id, ' NonflowerGeneral deleted successfully');
    }

    /**
     * @return Response
     *
     * @SWG\Get(
     *      path="/nonflower_generals/all",
     *      summary="Display the specified NonflowerGeneral",
     *      tags={"NonflowerGeneral"},
     *      description="Get NonflowerGeneral",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of NonflowerGeneral",
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
     *                  ref="#/definitions/NonflowerGeneral"
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

        $nonflowerGeneral = $this->nonflowerGeneralRepository->all()->groupBy('type');
        foreach ($nonflowerGeneral as $index => $item){
            $General[$index] = collect($item)->sortBy('name')->values()->all();
        }

        return $this->sendResponse($nonflowerGeneral->toArray(), ' NonflowerGeneral retrieved successfully');
    }


    /**
     * @param $type
     * @return Response
     *
     * @SWG\Get(
     *      path="/nonflower_generals/{type}/all",
     *      summary="Display the specified NonflowerGeneral",
     *      tags={"NonflowerGeneral"},
     *      description="Get NonflowerGeneral",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of NonflowerGeneral",
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
     *                  ref="#/definitions/NonflowerGeneral"
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

        $nonflowerGeneral = $this->nonflowerGeneralRepository->allWithType($type);


        return $this->sendResponse($nonflowerGeneral->toArray(), ' NonflowerGeneral retrieved successfully');
    }
}
