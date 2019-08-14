<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateCharacterTraitAPIRequest;
use App\Http\Requests\Api\UpdateCharacterTraitAPIRequest;
use App\Models\CharacterTrait;
use App\Repositories\CharacterTraitRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class CharacterTraitController
 * @package App\Http\Controllers\Api
 */

class CharacterTraitAPIController extends AppBaseController
{
    /** @var  CharacterTraitRepository */
    private $characterTraitRepository;

    public function __construct(CharacterTraitRepository $characterTraitRepo)
    {
        $this->characterTraitRepository = $characterTraitRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/characterTraits",
     *      summary="Get a listing of the CharacterTraits.",
     *      tags={"CharacterTrait"},
     *      description="Get all CharacterTraits",
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
     *                  @SWG\Items(ref="#/definitions/CharacterTrait")
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
        $characterTraits = $this->characterTraitRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($characterTraits->toArray(), 'Character Traits retrieved successfully');
    }

    /**
     * @param CreateCharacterTraitAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/characterTraits",
     *      summary="Store a newly created CharacterTrait in storage",
     *      tags={"CharacterTrait"},
     *      description="Store CharacterTrait",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="character_id",
     *          in="body",
     *          description="CharacterTrait that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/CharacterTrait")
     *      ),
     *      @SWG\Parameter(
     *          name="block_id",
     *          in="body",
     *          description="CharacterTrait that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/CharacterTrait")
     *      ),
     *      @SWG\Parameter(
     *          name="observation_no",
     *          in="body",
     *          description="CharacterTrait that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CharacterTrait")
     *      ),
     *      @SWG\Parameter(
     *          name="planting_date",
     *          in="body",
     *          description="CharacterTrait that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CharacterTrait")
     *      ),
     *      @SWG\Parameter(
     *          name="observation_date",
     *          in="body",
     *          description="CharacterTrait that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CharacterTrait")
     *      ),
     *      @SWG\Parameter(
     *          name="days_start_flowering",
     *          in="body",
     *          description="CharacterTrait that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CharacterTrait")
     *      ),
     *      @SWG\Parameter(
     *          name="days_flowering",
     *          in="body",
     *          description="CharacterTrait that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CharacterTrait")
     *      ),
     *      @SWG\Parameter(
     *          name="days_seed_ripening",
     *          in="body",
     *          description="CharacterTrait that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CharacterTrait")
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
     *                  ref="#/definitions/CharacterTrait"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateCharacterTraitAPIRequest $request)
    {
        $input = $request->all();

        $characterTrait = $this->characterTraitRepository->create($input);

        return $this->sendResponse($characterTrait->toArray(), 'Character Trait saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/characterTraits/{id}",
     *      summary="Display the specified CharacterTrait",
     *      tags={"CharacterTrait"},
     *      description="Get CharacterTrait",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of CharacterTrait",
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
     *                  ref="#/definitions/CharacterTrait"
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
        /** @var CharacterTrait $characterTrait */
        $characterTrait = $this->characterTraitRepository->find($id);

        if (empty($characterTrait)) {
            return $this->sendError('Character Trait not found');
        }

        return $this->sendResponse($characterTrait->toArray(), 'Character Trait retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateCharacterTraitAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/characterTraits/{id}",
     *      summary="Update the specified CharacterTrait in storage",
     *      tags={"CharacterTrait"},
     *      description="Update CharacterTrait",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of CharacterTrait",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="character_id",
     *          in="body",
     *          description="CharacterTrait that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/CharacterTrait")
     *      ),
     *      @SWG\Parameter(
     *          name="block_id",
     *          in="body",
     *          description="CharacterTrait that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/CharacterTrait")
     *      ),
     *      @SWG\Parameter(
     *          name="observation_no",
     *          in="body",
     *          description="CharacterTrait that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CharacterTrait")
     *      ),
     *      @SWG\Parameter(
     *          name="planting_date",
     *          in="body",
     *          description="CharacterTrait that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CharacterTrait")
     *      ),
     *      @SWG\Parameter(
     *          name="observation_date",
     *          in="body",
     *          description="CharacterTrait that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CharacterTrait")
     *      ),
     *      @SWG\Parameter(
     *          name="days_start_flowering",
     *          in="body",
     *          description="CharacterTrait that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CharacterTrait")
     *      ),
     *      @SWG\Parameter(
     *          name="days_flowering",
     *          in="body",
     *          description="CharacterTrait that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CharacterTrait")
     *      ),
     *      @SWG\Parameter(
     *          name="days_seed_ripening",
     *          in="body",
     *          description="CharacterTrait that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CharacterTrait")
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
     *                  ref="#/definitions/CharacterTrait"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateCharacterTraitAPIRequest $request)
    {
        $input = $request->all();

        /** @var CharacterTrait $characterTrait */
        $characterTrait = $this->characterTraitRepository->find($id);

        if (empty($characterTrait)) {
            return $this->sendError('Character Trait not found');
        }

        $characterTrait = $this->characterTraitRepository->update($input, $id);

        return $this->sendResponse($characterTrait->toArray(), 'CharacterTrait updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/characterTraits/{id}",
     *      summary="Remove the specified CharacterTrait from storage",
     *      tags={"CharacterTrait"},
     *      description="Delete CharacterTrait",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of CharacterTrait",
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
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var CharacterTrait $characterTrait */
        $characterTrait = $this->characterTraitRepository->find($id);

        if (empty($characterTrait)) {
            return $this->sendError('Character Trait not found');
        }

        $characterTrait->delete();

        return $this->sendResponse($id, 'Character Trait deleted successfully');
    }
}
