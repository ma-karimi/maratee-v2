<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\ActionableRequest;
use App\Http\Requests\Api\HerbariumAPIRequest;
use App\Models\Herbarium;
use App\Repositories\HerbariumRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class HerbariumController
 * @package App\Http\Controllers\Api
 */

class HerbariumAPIController extends AppBaseController
{
    /** @var  HerbariumRepository */
    private $herbariumRepository;

    public function __construct(HerbariumRepository $herbariumRepo)
    {
        $this->herbariumRepository = $herbariumRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/herbariums",
     *      summary="Get a listing of the Herbariums.",
     *      tags={"Herbarium"},
     *      description="Get all Herbariums",
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
     *                  @SWG\Items(ref="#/definitions/Herbarium")
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
        $herbariums = $this->herbariumRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($herbariums->toArray(), 'Herbariums retrieved successfully');
    }

    /**
     * @param HerbariumAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/herbariums",
     *      summary="Store a newly created Herbarium in storage",
     *      tags={"Herbarium"},
     *      description="Store Herbarium",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="herbarium_number",
     *          in="body",
     *          description="Plant Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="location_id",
     *          in="body",
     *          description="Plant Herbarium that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="organization_id",
     *          in="body",
     *          description="Plant Herbarium that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="herbarium_index",
     *          in="body",
     *          description="Plant Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="cf",
     *          in="body",
     *          description="s,u,f,g,v",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="taxonomy_id",
     *          in="body",
     *          description="Plant Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
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
     *                  ref="#/definitions/Herbarium"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(HerbariumAPIRequest $request)
    {
        $input = $request->all();

        $herbarium = $this->herbariumRepository->create($input);

        return $this->sendResponse($herbarium->toArray(), 'Herbarium saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/herbariums/{id}",
     *      summary="Display the specified Herbarium",
     *      tags={"Herbarium"},
     *      description="Get Herbarium",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Herbarium",
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
     *                  ref="#/definitions/Herbarium"
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
        /** @var Herbarium $herbarium */
        $herbarium = $this->herbariumRepository->find($id, \request()->get('relations'));

        if ($herbarium === null) {
            return $this->sendError('Herbarium not found');
        }

        return $this->sendResponse($herbarium->toArray(), 'Herbarium retrieved successfully');
    }

    /**
     * @param int $id
     * @param HerbariumAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/herbariums/{id}",
     *      summary="Update the specified Herbarium in storage",
     *      tags={"Herbarium"},
     *      description="Update Herbarium",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Herbarium",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="herbarium_number",
     *          in="body",
     *          description="Plant Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="location_id",
     *          in="body",
     *          description="Plant Herbarium that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="organization_id",
     *          in="body",
     *          description="Plant Herbarium that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="herbarium_index",
     *          in="body",
     *          description="Plant Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="cf",
     *          in="body",
     *          description="s,u,f,g,v",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="taxonomy_id",
     *          in="body",
     *          description="Plant Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
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
     *                  ref="#/definitions/Herbarium"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, HerbariumAPIRequest $request)
    {
        $input = $request->all();

        /** @var Herbarium $herbarium */
        $herbarium = $this->herbariumRepository->find($id, \request()->get('relations'));

        if ($herbarium === null) {
            return $this->sendError('Herbarium not found');
        }

        $herbarium = $this->herbariumRepository->update($input, $id);

        return $this->sendResponse($herbarium->toArray(), 'Herbarium updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/herbariums/{id}",
     *      summary="Remove the specified Herbarium from storage",
     *      tags={"Herbarium"},
     *      description="Delete Herbarium",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Herbarium",
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
        /** @var Herbarium $herbarium */
        $herbarium = $this->herbariumRepository->find($id, \request()->get('relations'));

        if ($herbarium === null) {
            return $this->sendError('Herbarium not found');
        }

        $herbarium->delete();

        return $this->sendResponse($id, 'Herbarium deleted successfully');
    }


    /**
     * @param $id
     * @param ActionableRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/plants/{id}/determine",
     *      summary="Store Determine action for Given Plant Herbarium",
     *      tags={"Plant Action"},
     *      description="Store Plant Herbarium Action",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="actors",
     *          in="body",
     *          description="ids of actors",
     *          required=true,
     *          @SWG\Schema(type="array", @SWG\Items(type="integer"))
     *      ),
     *      @SWG\Parameter(
     *          name="date",
     *          in="body",
     *          description="Plant Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ActionHub")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="Plant Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ActionHub")
     *      ),
     *      @SWG\Parameter(
     *          name="project_id",
     *          in="body",
     *          description="Plant Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ActionHub")
     *      ),
     *      @SWG\Parameter(
     *          name="department_id",
     *          in="body",
     *          description="Plant Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ActionHub")
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
     *                  ref="#/definitions/Herbarium"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function storeDetermine($id, ActionableRequest $request)
    {
        $input = $request->all();

        $result = $this->herbariumRepository->storeAction($id, $input, 1);

        return $this->sendResponse($result->toArray(), 'Plant Action saved successfully');
    }

    /**
     * @param $id
     * @param ActionableRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/plants/{id}/collect",
     *      summary="Store Collect action for Given Plant Herbarium",
     *      tags={"Plant Action"},
     *      description="Store Plant Herbarium Action",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="actors",
     *          in="body",
     *          description="ids of actors",
     *          required=true,
     *          @SWG\Schema(type="array", @SWG\Items(type="integer"))
     *      ),
     *      @SWG\Parameter(
     *          name="date",
     *          in="body",
     *          description="Plant Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ActionHub")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="Plant Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ActionHub")
     *      ),
     *      @SWG\Parameter(
     *          name="project_id",
     *          in="body",
     *          description="Plant Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ActionHub")
     *      ),
     *      @SWG\Parameter(
     *          name="department_id",
     *          in="body",
     *          description="Plant Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ActionHub")
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
     *                  ref="#/definitions/Herbarium"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function storeCollect($id, ActionableRequest $request)
    {
        $input = $request->all();

        $result = $this->herbariumRepository->storeAction($id, $input, 2);

        return $this->sendResponse($result->toArray(), 'Plant Action saved successfully');
    }

    /**
     * @param $id
     * @param ActionableRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/plants/{id}/research",
     *      summary="Store Research action for Given Plant Herbarium",
     *      tags={"Plant Action"},
     *      description="Store Plant Herbarium Action",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="actors",
     *          in="body",
     *          description="ids of actors",
     *          required=true,
     *          @SWG\Schema(type="array", @SWG\Items(type="integer"))
     *      ),
     *      @SWG\Parameter(
     *          name="date",
     *          in="body",
     *          description="Plant Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ActionHub")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="Plant Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ActionHub")
     *      ),
     *      @SWG\Parameter(
     *          name="project_id",
     *          in="body",
     *          description="Plant Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ActionHub")
     *      ),
     *      @SWG\Parameter(
     *          name="department_id",
     *          in="body",
     *          description="Plant Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ActionHub")
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
     *                  ref="#/definitions/Herbarium"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function storeResearch($id, ActionableRequest $request)
    {
        $input = $request->all();

        $result = $this->herbariumRepository->storeAction($id, $input, 3);

        return $this->sendResponse($result->toArray(), 'Plant Action saved successfully');
    }
}
