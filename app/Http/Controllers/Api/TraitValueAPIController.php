<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\CreateTraitValueAPIRequest;
use App\Http\Requests\Api\UpdateTraitValueAPIRequest;
use App\Models\TraitValue;
use App\Repositories\TraitValueRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class TraitValueController
 * @package App\Http\Controllers\Api
 */
class TraitValueAPIController extends AppBaseController
{
    /** @var  TraitValueRepository */
    private $traitValueRepository;

    public function __construct(TraitValueRepository $traitValueRepo)
    {
        $this->traitValueRepository = $traitValueRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/traitValues",
     *      summary="Get a listing of the TraitValues.",
     *      tags={"TraitValue"},
     *      description="Get all TraitValues",
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
     *                  @SWG\Items(ref="#/definitions/TraitValue")
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
        $traitValues = $this->traitValueRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($traitValues->toArray(), 'Trait Values retrieved successfully');
    }

    /**
     * @param CreateTraitValueAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/traitValues",
     *      summary="Store a newly created TraitValue in storage",
     *      tags={"TraitValue"},
     *      description="Store TraitValue",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="seed_feature_id",
     *          in="body",
     *          description="TraitValue that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/TraitValue")
     *      ),
     *      @SWG\Parameter(
     *          name="character_trait_id",
     *          in="body",
     *          description="TraitValue that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/TraitValue")
     *      ),
     *      @SWG\Parameter(
     *          name="value",
     *          in="body",
     *          description="TraitValue that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/TraitValue")
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
     *                  ref="#/definitions/TraitValue"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTraitValueAPIRequest $request)
    {
        $input = $request->all();

        $traitValue = $this->traitValueRepository->create($input);

        return $this->sendResponse($traitValue->toArray(), 'Trait Value saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/traitValues/{id}",
     *      summary="Display the specified TraitValue",
     *      tags={"TraitValue"},
     *      description="Get TraitValue",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of TraitValue",
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
     *                  ref="#/definitions/TraitValue"
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
        /** @var TraitValue $traitValue */
        $traitValue = $this->traitValueRepository->find($id);

        if (empty($traitValue)) {
            return $this->sendError('Trait Value not found');
        }

        return $this->sendResponse($traitValue->toArray(), 'Trait Value retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateTraitValueAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/traitValues/{id}",
     *      summary="Update the specified TraitValue in storage",
     *      tags={"TraitValue"},
     *      description="Update TraitValue",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of TraitValue",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="seed_feature_id",
     *          in="body",
     *          description="TraitValue that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/TraitValue")
     *      ),
     *      @SWG\Parameter(
     *          name="character_trait_id",
     *          in="body",
     *          description="TraitValue that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/TraitValue")
     *      ),
     *      @SWG\Parameter(
     *          name="value",
     *          in="body",
     *          description="TraitValue that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/TraitValue")
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
     *                  ref="#/definitions/TraitValue"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTraitValueAPIRequest $request)
    {
        $input = $request->all();

        /** @var TraitValue $traitValue */
        $traitValue = $this->traitValueRepository->find($id);

        if (empty($traitValue)) {
            return $this->sendError('Trait Value not found');
        }

        $traitValue = $this->traitValueRepository->update($input, $id);

        return $this->sendResponse($traitValue->toArray(), 'TraitValue updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/traitValues/{id}",
     *      summary="Remove the specified TraitValue from storage",
     *      tags={"TraitValue"},
     *      description="Delete TraitValue",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of TraitValue",
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
        /** @var TraitValue $traitValue */
        $traitValue = $this->traitValueRepository->find($id);

        if (empty($traitValue)) {
            return $this->sendError('Trait Value not found');
        }

        $traitValue->delete();

        return $this->sendResponse($id, 'Trait Value deleted successfully');
    }
}
