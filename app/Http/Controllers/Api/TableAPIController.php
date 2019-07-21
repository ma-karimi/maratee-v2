<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateTableAPIRequest;
use App\Http\Requests\Api\UpdateTableAPIRequest;
use App\Models\Table;
use App\Repositories\TableRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class TableController
 * @package App\Http\Controllers\Api
 */

class TableAPIController extends AppBaseController
{
    /** @var  TableRepository */
    private $tableRepository;

    public function __construct(TableRepository $tableRepo)
    {
        $this->tableRepository = $tableRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/roles",
     *      summary="Get a listing of the Tables.",
     *      tags={"Table"},
     *      description="Get all Tables",
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
     *                  @SWG\Items(ref="#/definitions/Table")
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
        $tables = $this->tableRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($tables->toArray(), 'Tables retrieved successfully');
    }

    /**
     * @param CreateTableAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/roles",
     *      summary="Store a newly created Table in storage",
     *      tags={"Table"},
     *      description="Store Table",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="Table that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Table")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="Table that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Table")
     *      ),
     *      @SWG\Parameter(
     *          name="level",
     *          in="body",
     *          description="Table that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Table")
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
     *                  ref="#/definitions/Table"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTableAPIRequest $request)
    {
        $input = $request->all();

        $table = $this->tableRepository->create($input);

        return $this->sendResponse($table->toArray(), 'Table saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/roles/{id}",
     *      summary="Display the specified Table",
     *      tags={"Table"},
     *      description="Get Table",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Table",
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
     *                  ref="#/definitions/Table"
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
        /** @var Table $table */
        $table = $this->tableRepository->find($id);

        if (empty($table)) {
            return $this->sendError('Table not found');
        }

        return $this->sendResponse($table->toArray(), 'Table retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateTableAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/tables/{id}",
     *      summary="Update the specified Table in storage",
     *      tags={"Table"},
     *      description="Update Table",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Table",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="Table that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Table")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="Table that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Table")
     *      ),
     *      @SWG\Parameter(
     *          name="level",
     *          in="body",
     *          description="Table that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Table")
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
     *                  ref="#/definitions/Table"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTableAPIRequest $request)
    {
        $input = $request->all();

        /** @var Table $table */
        $table = $this->tableRepository->find($id);

        if (empty($table)) {
            return $this->sendError('Table not found');
        }

        $table = $this->tableRepository->update($input, $id);

        return $this->sendResponse($table->toArray(), 'Table updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/tables/{id}",
     *      summary="Remove the specified Table from storage",
     *      tags={"Table"},
     *      description="Delete Table",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Table",
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
        /** @var Table $table */
        $table = $this->tableRepository->find($id);

        if (empty($table)) {
            return $this->sendError('Table not found');
        }

        $table->delete();

        return $this->sendResponse($id, 'Table deleted successfully');
    }
}
