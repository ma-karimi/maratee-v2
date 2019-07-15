<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateConstituentAPIRequest;
use App\Http\Requests\Api\UpdateConstituentAPIRequest;
use App\Models\Constituent;
use App\Repositories\ConstituentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ConstituentController
 * @package App\Http\Controllers\Api
 */

class ConstituentAPIController extends AppBaseController
{
    /** @var  ConstituentRepository */
    private $constituentRepository;

    public function __construct(ConstituentRepository $constituentRepo)
    {
        $this->constituentRepository = $constituentRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/constituents",
     *      summary="Get a listing of the Constituents.",
     *      tags={"Constituent"},
     *      description="Get all Constituents",
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
     *                  @SWG\Items(ref="#/definitions/Constituent")
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
        $constituents = $this->constituentRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($constituents->toArray(), 'Constituents retrieved successfully');
    }

    /**
     * @param CreateConstituentAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/constituents",
     *      summary="Store a newly created Constituent in storage",
     *      tags={"Constituent"},
     *      description="Store Constituent",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Constituent that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Constituent")
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
     *                  ref="#/definitions/Constituent"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateConstituentAPIRequest $request)
    {
        $input = $request->all();

        $constituent = $this->constituentRepository->create($input);

        return $this->sendResponse($constituent->toArray(), 'Constituent saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/constituents/{id}",
     *      summary="Display the specified Constituent",
     *      tags={"Constituent"},
     *      description="Get Constituent",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Constituent",
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
     *                  ref="#/definitions/Constituent"
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
        /** @var Constituent $constituent */
        $constituent = $this->constituentRepository->find($id);

        if (empty($constituent)) {
            return $this->sendError('Constituent not found');
        }

        return $this->sendResponse($constituent->toArray(), 'Constituent retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateConstituentAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/constituents/{id}",
     *      summary="Update the specified Constituent in storage",
     *      tags={"Constituent"},
     *      description="Update Constituent",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Constituent",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Constituent that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Constituent")
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
     *                  ref="#/definitions/Constituent"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateConstituentAPIRequest $request)
    {
        $input = $request->all();

        /** @var Constituent $constituent */
        $constituent = $this->constituentRepository->find($id);

        if (empty($constituent)) {
            return $this->sendError('Constituent not found');
        }

        $constituent = $this->constituentRepository->update($input, $id);

        return $this->sendResponse($constituent->toArray(), 'Constituent updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/constituents/{id}",
     *      summary="Remove the specified Constituent from storage",
     *      tags={"Constituent"},
     *      description="Delete Constituent",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Constituent",
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
        /** @var Constituent $constituent */
        $constituent = $this->constituentRepository->find($id);

        if (empty($constituent)) {
            return $this->sendError('Constituent not found');
        }

        $constituent->delete();

        return $this->sendResponse($id, 'Constituent deleted successfully');
    }
}
