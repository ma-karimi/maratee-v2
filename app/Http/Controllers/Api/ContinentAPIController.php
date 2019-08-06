<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\CreateContinentAPIRequest;
use App\Http\Requests\Api\UpdateContinentAPIRequest;
use App\Models\Continent;
use App\Models\Province;
use App\Repositories\ContinentRepository;
use Illuminate\Http\Request;
use PragmaRX\Countries\Package\Countries;
use Response;

/**
 * Class ContinentController
 * @package App\Http\Controllers\Api
 */
class ContinentAPIController extends AppBaseController
{
    /** @var  ContinentRepository */
    private $continentRepository;

    public function __construct(ContinentRepository $continentRepo)
    {
        $this->continentRepository = $continentRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/continents",
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
        $continents = $this->continentRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($continents->toArray(), 'Continents retrieved successfully');
    }

    /**
     * @param CreateContinentAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/continents",
     *      summary="Store a newly created Constituent in storage",
     *      tags={"Constituent"},
     *      description="Store Constituent",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          required=true,
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
    public function store(CreateContinentAPIRequest $request)
    {
        $input = $request->all();

        $continent = $this->continentRepository->create($input);

        return $this->sendResponse($continent->toArray(), 'Continent saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/continents/{id}",
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
        /** @var Continent $continent */
        $continent = $this->continentRepository->find($id, \request()->get('relations'));

        if ($continent === null) {
            return $this->sendError('Continent not found');
        }

        return $this->sendResponse($continent->toArray(), 'Continent retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateContinentAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/continents/{id}",
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
     *          name="name",
     *          in="body",
     *          required=true,
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
    public function update($id, UpdateContinentAPIRequest $request)
    {
        $input = $request->all();

        /** @var Continent $continent */
        $continent = $this->continentRepository->find($id, \request()->get('relations'));

        if ($continent === null) {
            return $this->sendError('Continent not found');
        }

        $continent = $this->continentRepository->update($input, $id);

        return $this->sendResponse($continent->toArray(), 'Continent updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/continents/{id}",
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
        /** @var Continent $continent */
        $continent = $this->continentRepository->find($id, \request()->get('relations'));

        if ($continent === null) {
            return $this->sendError('Continent not found');
        }

        $continent->delete();

        return $this->sendResponse($id, 'Continent deleted successfully');
    }
}
