<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateCredentialAPIRequest;
use App\Http\Requests\Api\UpdateCredentialAPIRequest;
use App\Models\Credential;
use App\Repositories\CredentialRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class CredentialController
 * @package App\Http\Controllers\Api
 */

class CredentialAPIController extends AppBaseController
{
    /** @var  CredentialRepository */
    private $credentialRepository;

    public function __construct(CredentialRepository $credentialRepo)
    {
        $this->credentialRepository = $credentialRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/credentials",
     *      summary="Get a listing of the Credentials.",
     *      tags={"Credential"},
     *      description="Get all Credentials",
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
     *                  @SWG\Items(ref="#/definitions/Credential")
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
        $credentials = $this->credentialRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($credentials->toArray(), 'Credentials retrieved successfully');
    }

    /**
     * @param CreateCredentialAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/credentials",
     *      summary="Store a newly created Credential in storage",
     *      tags={"Credential"},
     *      description="Store Credential",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Credential that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Credential")
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
     *                  ref="#/definitions/Credential"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateCredentialAPIRequest $request)
    {
        $input = $request->all();

        $credential = $this->credentialRepository->create($input);

        return $this->sendResponse($credential->toArray(), 'Credential saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/credentials/{id}",
     *      summary="Display the specified Credential",
     *      tags={"Credential"},
     *      description="Get Credential",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Credential",
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
     *                  ref="#/definitions/Credential"
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
        /** @var Credential $credential */
        $credential = $this->credentialRepository->find($id);

        if (empty($credential)) {
            return $this->sendError('Credential not found');
        }

        return $this->sendResponse($credential->toArray(), 'Credential retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateCredentialAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/credentials/{id}",
     *      summary="Update the specified Credential in storage",
     *      tags={"Credential"},
     *      description="Update Credential",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Credential",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Credential that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Credential")
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
     *                  ref="#/definitions/Credential"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateCredentialAPIRequest $request)
    {
        $input = $request->all();

        /** @var Credential $credential */
        $credential = $this->credentialRepository->find($id);

        if (empty($credential)) {
            return $this->sendError('Credential not found');
        }

        $credential = $this->credentialRepository->update($input, $id);

        return $this->sendResponse($credential->toArray(), 'Credential updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/credentials/{id}",
     *      summary="Remove the specified Credential from storage",
     *      tags={"Credential"},
     *      description="Delete Credential",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Credential",
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
        /** @var Credential $credential */
        $credential = $this->credentialRepository->find($id);

        if (empty($credential)) {
            return $this->sendError('Credential not found');
        }

        $credential->delete();

        return $this->sendResponse($id, 'Credential deleted successfully');
    }
}
