<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateMethodAPIRequest;
use App\Http\Requests\Api\UpdateMethodAPIRequest;
use App\Models\Method;
use App\Repositories\MethodRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class MethodController
 * @package App\Http\Controllers\Api
 */

class MethodAPIController extends AppBaseController
{
    /** @var  MethodRepository */
    private $methodRepository;

    public function __construct(MethodRepository $methodRepo)
    {
        $this->methodRepository = $methodRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/methods",
     *      summary="Get a listing of the Methods.",
     *      tags={"Method"},
     *      description="Get all Methods",
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
     *                  @SWG\Items(ref="#/definitions/Method")
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
        $methods = $this->methodRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($methods->toArray(), 'Methods retrieved successfully');
    }

    /**
     * @param CreateMethodAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/methods",
     *      summary="Store a newly created Method in storage",
     *      tags={"Method"},
     *      description="Store Method",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="Method that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Method")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="Method that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Method")
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
     *                  ref="#/definitions/Method"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateMethodAPIRequest $request)
    {
        $input = $request->all();

        $method = $this->methodRepository->create($input);

        return $this->sendResponse($method->toArray(), 'Method saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/methods/{id}",
     *      summary="Display the specified Method",
     *      tags={"Method"},
     *      description="Get Method",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Method",
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
     *                  ref="#/definitions/Method"
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
        /** @var Method $method */
        $method = $this->methodRepository->find($id, \request()->get('relations'));

        if ($method === null) {
            return $this->sendError('Method not found');
        }

        return $this->sendResponse($method->toArray(), 'Method retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateMethodAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/methods/{id}",
     *      summary="Update the specified Method in storage",
     *      tags={"Method"},
     *      description="Update Method",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Method",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="Method that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Method")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="Method that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Method")
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
     *                  ref="#/definitions/Method"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateMethodAPIRequest $request)
    {
        $input = $request->all();

        /** @var Method $method */
        $method = $this->methodRepository->find($id, \request()->get('relations'));

        if ($method === null) {
            return $this->sendError('Method not found');
        }

        $method = $this->methodRepository->update($input, $id);

        return $this->sendResponse($method->toArray(), 'Method updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/methods/{id}",
     *      summary="Remove the specified Method from storage",
     *      tags={"Method"},
     *      description="Delete Method",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Method",
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
        /** @var Method $method */
        $method = $this->methodRepository->find($id, \request()->get('relations'));

        if ($method === null) {
            return $this->sendError('Method not found');
        }

        $method->delete();

        return $this->sendResponse($id, 'Method deleted successfully');
    }
}
