<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateGeraminAPIRequest;
use App\Http\Requests\Api\UpdateGeraminAPIRequest;
use App\Models\Geramin;
use App\Repositories\GeraminRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class GeraminController
 * @package App\Http\Controllers\Api
 */

class GeraminAPIController extends AppBaseController
{
    /** @var  GeraminRepository */
    private $geraminRepository;

    public function __construct(GeraminRepository $geraminRepo)
    {
        $this->geraminRepository = $geraminRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/geramins",
     *      summary="Get a listing of the Geramins.",
     *      tags={"Geramin"},
     *      description="Get all Geramins",
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
     *                  @SWG\Items(ref="#/definitions/Geramin")
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
        $geramins = $this->geraminRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($geramins->toArray(), 'Geramins retrieved successfully');
    }

    /**
     * @param CreateGeraminAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/geramins",
     *      summary="Store a newly created Geramin in storage",
     *      tags={"Geramin"},
     *      description="Store Geramin",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="collection_id",
     *          in="body",
     *          description="Geramin that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Geramin")
     *      ),
     *      @SWG\Parameter(
     *          name="seed_id",
     *          in="body",
     *          description="Geramin that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Geramin")
     *      ),
     *      @SWG\Parameter(
     *          name="repeat",
     *          in="body",
     *          description="Geramin that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Geramin")
     *      ),
     *      @SWG\Parameter(
     *          name="bush",
     *          in="body",
     *          description="Geramin that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Geramin")
     *      ),
     *      @SWG\Parameter(
     *          name="average",
     *          in="body",
     *          description="Geramin that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Geramin")
     *      ),
     *      @SWG\Parameter(
     *          name="flowering_completion",
     *          in="body",
     *          description="Geramin that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Geramin")
     *      ),
     *      @SWG\Parameter(
     *          name="gdd_flowering",
     *          in="body",
     *          description="Geramin that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Geramin")
     *      ),
     *      @SWG\Parameter(
     *          name="essence_rate",
     *          in="body",
     *          description="Geramin that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Geramin")
     *      ),
     *      @SWG\Parameter(
     *          name="bush_weight",
     *          in="body",
     *          description="Geramin that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Geramin")
     *      ),
     *      @SWG\Parameter(
     *          name="bush_height",
     *          in="body",
     *          description="Geramin that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Geramin")
     *      ),
     *      @SWG\Parameter(
     *          name="big_bush_diameter",
     *          in="body",
     *          description="Geramin that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Geramin")
     *      ),
     *      @SWG\Parameter(
     *          name="small_bush_diameter",
     *          in="body",
     *          description="Geramin that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Geramin")
     *      ),
     *      @SWG\Parameter(
     *          name="flowering_bish_qt",
     *          in="body",
     *          description="Geramin that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Geramin")
     *      ),
     *      @SWG\Parameter(
     *          name="crown_coverage",
     *          in="body",
     *          description="Geramin that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Geramin")
     *      ),
     *      @SWG\Parameter(
     *          name="flower_color",
     *          in="body",
     *          description="Geramin that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Geramin")
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
     *                  ref="#/definitions/Geramin"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateGeraminAPIRequest $request)
    {
        $input = $request->all();

        $geramin = $this->geraminRepository->create($input);

        return $this->sendResponse($geramin->toArray(), 'Geramin saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/geramins/{id}",
     *      summary="Display the specified Geramin",
     *      tags={"Geramin"},
     *      description="Get Geramin",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Geramin",
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
     *                  ref="#/definitions/Geramin"
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
        /** @var Geramin $geramin */
        $geramin = $this->geraminRepository->find($id, \request()->get('relations'));

        if ($geramin === null) {
            return $this->sendError('Geramin not found');
        }

        return $this->sendResponse($geramin->toArray(), 'Geramin retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateGeraminAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/geramins/{id}",
     *      summary="Update the specified Geramin in storage",
     *      tags={"Geramin"},
     *      description="Update Geramin",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Geramin",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="collection_id",
     *          in="body",
     *          description="Geramin that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Geramin")
     *      ),
     *      @SWG\Parameter(
     *          name="seed_id",
     *          in="body",
     *          description="Geramin that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Geramin")
     *      ),
     *      @SWG\Parameter(
     *          name="repeat",
     *          in="body",
     *          description="Geramin that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Geramin")
     *      ),
     *      @SWG\Parameter(
     *          name="bush",
     *          in="body",
     *          description="Geramin that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Geramin")
     *      ),
     *      @SWG\Parameter(
     *          name="average",
     *          in="body",
     *          description="Geramin that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Geramin")
     *      ),
     *      @SWG\Parameter(
     *          name="flowering_completion",
     *          in="body",
     *          description="Geramin that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Geramin")
     *      ),
     *      @SWG\Parameter(
     *          name="gdd_flowering",
     *          in="body",
     *          description="Geramin that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Geramin")
     *      ),
     *      @SWG\Parameter(
     *          name="essence_rate",
     *          in="body",
     *          description="Geramin that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Geramin")
     *      ),
     *      @SWG\Parameter(
     *          name="bush_weight",
     *          in="body",
     *          description="Geramin that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Geramin")
     *      ),
     *      @SWG\Parameter(
     *          name="bush_height",
     *          in="body",
     *          description="Geramin that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Geramin")
     *      ),
     *      @SWG\Parameter(
     *          name="big_bush_diameter",
     *          in="body",
     *          description="Geramin that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Geramin")
     *      ),
     *      @SWG\Parameter(
     *          name="small_bush_diameter",
     *          in="body",
     *          description="Geramin that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Geramin")
     *      ),
     *      @SWG\Parameter(
     *          name="flowering_bish_qt",
     *          in="body",
     *          description="Geramin that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Geramin")
     *      ),
     *      @SWG\Parameter(
     *          name="crown_coverage",
     *          in="body",
     *          description="Geramin that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Geramin")
     *      ),
     *      @SWG\Parameter(
     *          name="flower_color",
     *          in="body",
     *          description="Geramin that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Geramin")
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
     *                  ref="#/definitions/Geramin"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateGeraminAPIRequest $request)
    {
        $input = $request->all();

        /** @var Geramin $geramin */
        $geramin = $this->geraminRepository->find($id, \request()->get('relations'));

        if ($geramin === null) {
            return $this->sendError('Geramin not found');
        }

        $geramin = $this->geraminRepository->update($input, $id);

        return $this->sendResponse($geramin->toArray(), 'Geramin updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/geramins/{id}",
     *      summary="Remove the specified Geramin from storage",
     *      tags={"Geramin"},
     *      description="Delete Geramin",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Geramin",
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
        /** @var Geramin $geramin */
        $geramin = $this->geraminRepository->find($id, \request()->get('relations'));

        if ($geramin === null) {
            return $this->sendError('Geramin not found');
        }

        $geramin->delete();

        return $this->sendResponse($id, 'Geramin deleted successfully');
    }
}
