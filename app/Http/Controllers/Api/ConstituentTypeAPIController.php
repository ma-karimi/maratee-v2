<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateConstituentTypeAPIRequest;
use App\Http\Requests\Api\UpdateConstituentTypeAPIRequest;
use App\Models\ConstituentType;
use App\Repositories\ConstituentTypeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ConstituentTypeTypeController
 * @package App\Http\Controllers\Api
 */

class ConstituentTypeAPIController extends AppBaseController
{
    /** @var  ConstituentTypeRepository */
    private $constituentTypeRepository;

    public function __construct(ConstituentTypeRepository $constituentTypeRepo)
    {
        $this->constituentTypeRepository = $constituentTypeRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/constituent_types",
     *      summary="Get a listing of the ConstituentTypes.",
     *      tags={"ConstituentType"},
     *      description="Get all ConstituentTypes",
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
     *                  @SWG\Items(ref="#/definitions/ConstituentType")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     * @throws \Exception
     */
    public function index(Request $request)
    {
        $constituents = $this->constituentTypeRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($constituents->toArray(), 'ConstituentTypes retrieved successfully');
    }

    /**
     * @param CreateConstituentTypeAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/constituent_types",
     *      summary="Store a newly created ConstituentType in storage",
     *      tags={"ConstituentType"},
     *      description="Store ConstituentType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="ConstituentType that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/ConstituentType")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="ConstituentType that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ConstituentType")
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
     *                  ref="#/definitions/ConstituentType"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateConstituentTypeAPIRequest $request)
    {
        $input = $request->all();

        $constituent = $this->constituentTypeRepository->create($input);

        return $this->sendResponse($constituent->toArray(), 'ConstituentType saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/constituent_types/{id}",
     *      summary="Display the specified ConstituentType",
     *      tags={"ConstituentType"},
     *      description="Get ConstituentType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ConstituentType",
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
     *                  ref="#/definitions/ConstituentType"
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
        /** @var ConstituentType $constituent */
        $constituent = $this->constituentTypeRepository->find($id, \request()->get('relations'));

        if ($constituent === null) {
            return $this->sendError('ConstituentType not found');
        }

        return $this->sendResponse($constituent->toArray(), 'ConstituentType retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateConstituentTypeAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/constituent_types/{id}",
     *      summary="Update the specified ConstituentType in storage",
     *      tags={"ConstituentType"},
     *      description="Update ConstituentType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ConstituentType",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="ConstituentType that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/ConstituentType")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="ConstituentType that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ConstituentType")
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
     *                  ref="#/definitions/ConstituentType"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateConstituentTypeAPIRequest $request)
    {
        $input = $request->all();

        /** @var ConstituentType $constituent */
        $constituent = $this->constituentTypeRepository->find($id, \request()->get('relations'));

        if ($constituent === null) {
            return $this->sendError('ConstituentType not found');
        }

        $constituent = $this->constituentTypeRepository->update($input, $id);

        return $this->sendResponse($constituent->toArray(), 'ConstituentType updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/constituent_types/{id}",
     *      summary="Remove the specified ConstituentType from storage",
     *      tags={"ConstituentType"},
     *      description="Delete ConstituentType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ConstituentType",
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
        /** @var ConstituentType $constituent */
        $constituent = $this->constituentTypeRepository->find($id, \request()->get('relations'));

        if ($constituent === null) {
            return $this->sendError('ConstituentType not found');
        }

        $constituent->delete();

        return $this->sendResponse($id, 'ConstituentType deleted successfully');
    }
}
