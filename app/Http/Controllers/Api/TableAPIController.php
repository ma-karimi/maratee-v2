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


    public function index(Request $request)
    {
        $tables = $this->tableRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($tables->toArray(), 'Tables retrieved successfully');
    }


    public function store(CreateTableAPIRequest $request)
    {
        $input = $request->all();

        $table = $this->tableRepository->create($input);

        return $this->sendResponse($table->toArray(), 'Table saved successfully');
    }

    public function show($id)
    {
        /** @var Table $table */
        $table = $this->tableRepository->find($id, \request()->get('relations'));

        if (empty($table)) {
            return $this->sendError('Table not found');
        }

        return $this->sendResponse($table->toArray(), 'Table retrieved successfully');
    }


    public function update($id, UpdateTableAPIRequest $request)
    {
        $input = $request->all();

        /** @var Table $table */
        $table = $this->tableRepository->find($id, \request()->get('relations'));

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
        $table = $this->tableRepository->find($id, \request()->get('relations'));

        if (empty($table)) {
            return $this->sendError('Table not found');
        }

        $table->delete();

        return $this->sendResponse($id, 'Table deleted successfully');
    }
}
