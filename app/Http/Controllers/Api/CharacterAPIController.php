<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateCharacterAPIRequest;
use App\Http\Requests\Api\UpdateCharacterAPIRequest;
use App\Models\Character;
use App\Repositories\CharacterRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class CharacterController
 * @package App\Http\Controllers\Api
 */

class CharacterAPIController extends AppBaseController
{
    /** @var  CharacterRepository */
    private $characterRepository;

    public function __construct(CharacterRepository $characterRepo)
    {
        $this->characterRepository = $characterRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/characters",
     *      summary="Get a listing of the Characters.",
     *      tags={"Character"},
     *      description="Get all Characters",
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
     *                  @SWG\Items(ref="#/definitions/Character")
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
        $characters = $this->characterRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($characters->toArray(), 'Characters retrieved successfully');
    }

    /**
     * @param CreateCharacterAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/characters",
     *      summary="Store a newly created Character in storage",
     *      tags={"Character"},
     *      description="Store Character",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="seed_id",
     *          in="body",
     *          description="Character that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Character")
     *      ),
     *      @SWG\Parameter(
     *          name="project_id",
     *          in="body",
     *          description="Character that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Character")
     *      ),
     *      @SWG\Parameter(
     *          name="department_id",
     *          in="body",
     *          description="Character that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Character")
     *      ),
     *      @SWG\Parameter(
     *          name="voucher_no",
     *          in="body",
     *          description="Character that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Character")
     *      ),
     *      @SWG\Parameter(
     *          name="type",
     *          in="body",
     *          description="Character that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Character")
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
     *                  ref="#/definitions/Character"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateCharacterAPIRequest $request)
    {
        $input = $request->all();

        $character = $this->characterRepository->create($input);

        return $this->sendResponse($character->toArray(), 'Character saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/characters/{id}",
     *      summary="Display the specified Character",
     *      tags={"Character"},
     *      description="Get Character",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Character",
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
     *                  ref="#/definitions/Character"
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
        /** @var Character $character */
        $character = $this->characterRepository->find($id);

        if (empty($character)) {
            return $this->sendError('Character not found');
        }

        return $this->sendResponse($character->toArray(), 'Character retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateCharacterAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/characters/{id}",
     *      summary="Update the specified Character in storage",
     *      tags={"Character"},
     *      description="Update Character",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Character",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="seed_id",
     *          in="body",
     *          description="Character that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Character")
     *      ),
     *      @SWG\Parameter(
     *          name="project_id",
     *          in="body",
     *          description="Character that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Character")
     *      ),
     *      @SWG\Parameter(
     *          name="department_id",
     *          in="body",
     *          description="Character that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Character")
     *      ),
     *      @SWG\Parameter(
     *          name="voucher_no",
     *          in="body",
     *          description="Character that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Character")
     *      ),
     *      @SWG\Parameter(
     *          name="type",
     *          in="body",
     *          description="Character that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Character")
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
     *                  ref="#/definitions/Character"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateCharacterAPIRequest $request)
    {
        $input = $request->all();

        /** @var Character $character */
        $character = $this->characterRepository->find($id);

        if (empty($character)) {
            return $this->sendError('Character not found');
        }

        $character = $this->characterRepository->update($input, $id);

        return $this->sendResponse($character->toArray(), 'Character updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/characters/{id}",
     *      summary="Remove the specified Character from storage",
     *      tags={"Character"},
     *      description="Delete Character",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Character",
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
        /** @var Character $character */
        $character = $this->characterRepository->find($id);

        if (empty($character)) {
            return $this->sendError('Character not found');
        }

        $character->delete();

        return $this->sendResponse($id, 'Character deleted successfully');
    }
}
