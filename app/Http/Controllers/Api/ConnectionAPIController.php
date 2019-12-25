<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\CreateConnectionAPIRequest;
use App\Http\Requests\Api\UpdateConnectionAPIRequest;
use App\Models\Connection;
use App\Repositories\ConnectionRepository;
use Exception;
use Illuminate\Http\Request;
use Response;

/**
 * Class ConnectionController
 * @package App\Http\Controllers\Api
 */
class ConnectionAPIController extends AppBaseController
{
    /** @var  ConnectionRepository */
    private $connectionRepository;

    public function __construct(ConnectionRepository $connectionRepo)
    {
        $this->connectionRepository = $connectionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/connections",
     *      summary="Get a listing of the Connections.",
     *      tags={"Connection"},
     *      description="Get all Connections",
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
     *                  @SWG\Items(ref="#/definitions/Connection")
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
        $connections = $this->connectionRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($connections->toArray(), 'Connections retrieved successfully');
    }

    /**
     * @param CreateConnectionAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/connections",
     *      summary="Store a newly created Connection in storage",
     *      tags={"Connection"},
     *      description="Store Connection",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Connection")
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
     *                  ref="#/definitions/Connection"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateConnectionAPIRequest $request)
    {
        $input = $request->all();

        $connection = $this->connectionRepository->create($input);

        return $this->sendResponse($connection->toArray(), 'Connection saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/connections/{id}",
     *      summary="Display the specified Connection",
     *      tags={"Connection"},
     *      description="Get Connection",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Connection",
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
     *                  ref="#/definitions/Connection"
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
        /** @var Connection $connection */
        $connection = $this->connectionRepository->find($id, \request()->get('relations'));

        if ($connection === null) {
            return $this->sendError('Connection not found');
        }

        return $this->sendResponse($connection->toArray(), 'Connection retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateConnectionAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/connections/{id}",
     *      summary="Update the specified Connection in storage",
     *      tags={"Connection"},
     *      description="Update Connection",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Connection",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Connection")
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
     *                  ref="#/definitions/Connection"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateConnectionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Connection $connection */
        $connection = $this->connectionRepository->find($id, \request()->get('relations'));

        if ($connection === null) {
            return $this->sendError('Connection not found');
        }

        $connection = $this->connectionRepository->update($input, $id);

        return $this->sendResponse($connection->toArray(), 'Connection updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws Exception
     * @SWG\Delete(
     *      path="/connections/{id}",
     *      summary="Remove the specified Connection from storage",
     *      tags={"Connection"},
     *      description="Delete Connection",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Connection",
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
        /** @var Connection $connection */
        $connection = $this->connectionRepository->find($id, \request()->get('relations'));

        if ($connection === null) {
            return $this->sendError('Connection not found');
        }

        $connection->delete();

        return $this->sendResponse($id, 'Connection deleted successfully');
    }
}
