<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\CreateLifeFormAPIRequest;
use App\Http\Requests\Api\UpdateLifeFormAPIRequest;
use App\Models\LifeForm;
use App\Repositories\LifeFormRepository;
use Exception;
use Illuminate\Http\Request;
use Response;

/**
 * Class LifeFormController
 * @package App\Http\Controllers\Api
 */
class LifeFormAPIController extends AppBaseController
{
    /** @var  LifeFormRepository */
    private $lifeFormRepository;

    public function __construct(LifeFormRepository $lifeFormRepo)
    {
        $this->lifeFormRepository = $lifeFormRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/life_forms",
     *      summary="Get a listing of the LifeForms.",
     *      tags={"LifeForm"},
     *      description="Get all LifeForms",
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
     *                  @SWG\Items(ref="#/definitions/LifeForm")
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
        $lifeForms = $this->lifeFormRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($lifeForms->toArray(), 'Life Forms retrieved successfully');
    }

    /**
     * @param CreateLifeFormAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/life_forms",
     *      summary="Store a newly created LifeForm in storage",
     *      tags={"LifeForm"},
     *      description="Store LifeForm",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="LifeForm that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/LifeForm")
     *      ),
     *      @SWG\Parameter(
     *          name="type",
     *          in="body",
     *           description="select one of wooden,leaf, herbaceous, life_cycle",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/LifeForm")
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
     *                  ref="#/definitions/LifeForm"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateLifeFormAPIRequest $request)
    {
        $input = $request->all();

        $lifeForm = $this->lifeFormRepository->create($input);

        return $this->sendResponse($lifeForm->toArray(), 'Life Form saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/life_forms/{id}",
     *      summary="Display the specified LifeForm",
     *      tags={"LifeForm"},
     *      description="Get LifeForm",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of LifeForm",
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
     *                  ref="#/definitions/LifeForm"
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
        /** @var LifeForm $lifeForm */
        $lifeForm = $this->lifeFormRepository->find($id);

        if (empty($lifeForm)) {
            return $this->sendError('Life Form not found');
        }

        return $this->sendResponse($lifeForm->toArray(), 'Life Form retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateLifeFormAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/life_forms/{id}",
     *      summary="Update the specified LifeForm in storage",
     *      tags={"LifeForm"},
     *      description="Update LifeForm",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of LifeForm",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="LifeForm that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/LifeForm")
     *      ),
     *      @SWG\Parameter(
     *          name="type",
     *          in="body",
     *          description="select one of wooden,leaf, herbaceous, life_cycle",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/LifeForm")
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
     *                  ref="#/definitions/LifeForm"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateLifeFormAPIRequest $request)
    {
        $input = $request->all();

        /** @var LifeForm $lifeForm */
        $lifeForm = $this->lifeFormRepository->find($id);

        if (empty($lifeForm)) {
            return $this->sendError('Life Form not found');
        }

        $lifeForm = $this->lifeFormRepository->update($input, $id);

        return $this->sendResponse($lifeForm->toArray(), 'LifeForm updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/life_forms/{id}",
     *      summary="Remove the specified LifeForm from storage",
     *      tags={"LifeForm"},
     *      description="Delete LifeForm",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of LifeForm",
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
    public function destroy($id)
    {
        /** @var LifeForm $lifeForm */
        $lifeForm = $this->lifeFormRepository->find($id);

        if (empty($lifeForm)) {
            return $this->sendError('Life Form not found');
        }

        $lifeForm->delete();

        return $this->sendResponse($id, 'Life Form deleted successfully');
    }
}
