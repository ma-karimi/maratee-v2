<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateBorrowAPIRequest;
use App\Http\Requests\Api\UpdateBorrowAPIRequest;
use App\Models\Borrow;
use App\Repositories\BorrowRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class BorrowController
 * @package App\Http\Controllers\Api
 */

class BorrowAPIController extends AppBaseController
{
    /** @var  BorrowRepository */
    private $borrowRepository;

    public function __construct(BorrowRepository $borrowRepo)
    {
        $this->borrowRepository = $borrowRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/borrows",
     *      summary="Get a listing of the Borrows.",
     *      tags={"Borrow"},
     *      description="Get all Borrows",
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
     *                  @SWG\Items(ref="#/definitions/Borrow")
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
        $borrows = $this->borrowRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($borrows->toArray(), 'Borrows retrieved successfully');
    }

    /**
     * @param CreateBorrowAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/borrows",
     *      summary="Store a newly created Borrow in storage",
     *      tags={"Borrow"},
     *      description="Store Borrow",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Borrow that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Borrow")
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
     *                  ref="#/definitions/Borrow"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateBorrowAPIRequest $request)
    {
        $input = $request->all();

        $borrow = $this->borrowRepository->create($input);

        return $this->sendResponse($borrow->toArray(), 'Borrow saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/borrows/{id}",
     *      summary="Display the specified Borrow",
     *      tags={"Borrow"},
     *      description="Get Borrow",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Borrow",
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
     *                  ref="#/definitions/Borrow"
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
        /** @var Borrow $borrow */
        $borrow = $this->borrowRepository->find($id);

        if (empty($borrow)) {
            return $this->sendError('Borrow not found');
        }

        return $this->sendResponse($borrow->toArray(), 'Borrow retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateBorrowAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/borrows/{id}",
     *      summary="Update the specified Borrow in storage",
     *      tags={"Borrow"},
     *      description="Update Borrow",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Borrow",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Borrow that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Borrow")
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
     *                  ref="#/definitions/Borrow"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateBorrowAPIRequest $request)
    {
        $input = $request->all();

        /** @var Borrow $borrow */
        $borrow = $this->borrowRepository->find($id);

        if (empty($borrow)) {
            return $this->sendError('Borrow not found');
        }

        $borrow = $this->borrowRepository->update($input, $id);

        return $this->sendResponse($borrow->toArray(), 'Borrow updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/borrows/{id}",
     *      summary="Remove the specified Borrow from storage",
     *      tags={"Borrow"},
     *      description="Delete Borrow",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Borrow",
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
        /** @var Borrow $borrow */
        $borrow = $this->borrowRepository->find($id);

        if (empty($borrow)) {
            return $this->sendError('Borrow not found');
        }

        $borrow->delete();

        return $this->sendResponse($id, 'Borrow deleted successfully');
    }
}
