<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\NonflowerAPIRequest;
use App\Models\Nonflower;
use App\Repositories\NonflowerRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Response;

/**
 * Class NonflowerController
 * @package App\Http\Controllers\Api
 */
class NonflowerAPIController extends AppBaseController
{
    /** @var  NonflowerRepository */
    private $nonflowerRepository;

    public function __construct(NonflowerRepository $nonflowerRepo)
    {
        $this->nonflowerRepository = $nonflowerRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/nonflowers",
     *      summary="Get a listing of the Nonflowers.",
     *      tags={"Nonflower"},
     *      description="Get all Nonflowers",
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
     *                  @SWG\Items(ref="#/definitions/Nonflower")
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
        $nonflowers = $this->nonflowerRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $this->nonflowerRepository->getRelationFields()
        );

        return $this->sendResponse($nonflowers->toArray(), 'Nonflowers retrieved successfully');
    }

    /**
     * @param NonflowerAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/nonflowers",
     *      summary="Store a newly created Nonflower in storage",
     *      tags={"Nonflower"},
     *      description="Store Nonflower",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="herbarium_number",
     *          in="body",
     *          description="Plant Nonflower that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Nonflower")
     *      ),
     *      @SWG\Parameter(
     *          name="location_id",
     *          in="body",
     *          description="Plant Nonflower that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Nonflower")
     *      ),
     *      @SWG\Parameter(
     *          name="taxonomy_id",
     *          in="body",
     *          description="Plant Nonflower that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Nonflower")
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
     *                  ref="#/definitions/Nonflower"
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
    public function store(NonflowerAPIRequest $request)
    {

        $nonflower = $this->nonflowerRepository->create($request);

        return $this->sendResponse($nonflower->toArray(), 'Nonflower saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/nonflowers/{id}",
     *      summary="Display the specified Nonflower",
     *      tags={"Nonflower"},
     *      description="Get Nonflower",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Nonflower",
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
     *                  ref="#/definitions/Nonflower"
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
        /** @var Nonflower $nonflower */
        $nonflower = $this->nonflowerRepository->find($id, $this->nonflowerRepository->getRelationFields());

        if ($nonflower === null) {
            return $this->sendError('Nonflower not found');
        }

        return $this->sendResponse($nonflower->toArray(), 'Nonflower retrieved successfully');
    }

    /**
     * @param int $id
     * @param NonflowerAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/nonflowers/{id}",
     *      summary="Update the specified Nonflower in storage",
     *      tags={"Nonflower"},
     *      description="Update Nonflower",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Nonflower",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="herbarium_number",
     *          in="body",
     *          description="Plant Nonflower that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Nonflower")
     *      ),
     *      @SWG\Parameter(
     *          name="location_id",
     *          in="body",
     *          description="Plant Nonflower that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Nonflower")
     *      ),
     *      @SWG\Parameter(
     *          name="taxonomy_id",
     *          in="body",
     *          description="Plant Nonflower that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Nonflower")
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
     *                  ref="#/definitions/Nonflower"
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
    public function update($id, NonflowerAPIRequest $request)
    {

        /** @var Nonflower $nonflower */
        $nonflower = $this->nonflowerRepository->find($id, []);

        if ($nonflower === null) {
            return $this->sendError('Nonflower not found');
        }

        $nonflower = $this->nonflowerRepository->update($request, $id);

        return $this->sendResponse($nonflower->toArray(), 'Nonflower updated successfully');
    }


    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Post(
     *      path="/nonflowers/{id}/media",
     *      tags={"Nonflower"},
     *      description="Store Nonflower Media",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Nonflower",
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
     * @throws Exception
     */
    public function media($id)
    {
        $plant = $this->nonflowerRepository->find($id, []);

        if (empty($plant)) {
            return $this->sendError('Nonflower not found');
        }

        $this->nonflowerRepository->storeMedia(\request()->all(), $plant);

        return $this->sendResponse($id, 'Nonflower Media Stored successfully');
    }
}
