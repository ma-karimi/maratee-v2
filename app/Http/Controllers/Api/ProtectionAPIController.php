<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateProtectionAPIRequest;
use App\Http\Requests\Api\UpdateProtectionAPIRequest;
use App\Models\Protection;
use App\Repositories\ProtectionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ProtectionController
 * @package App\Http\Controllers\Api
 */

class ProtectionAPIController extends AppBaseController
{
    /** @var  ProtectionRepository */
    private $protectionRepository;

    public function __construct(ProtectionRepository $protectionRepo)
    {
        $this->protectionRepository = $protectionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/protections",
     *      summary="Get a listing of the Protections.",
     *      tags={"Protection"},
     *      description="Get all Protections",
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
     *                  @SWG\Items(ref="#/definitions/Protection")
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
        $protections = $this->protectionRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($protections->toArray(), 'Protections retrieved successfully');
    }

    /**
     * @param CreateProtectionAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/protections",
     *      summary="Store a newly created Protection in storage",
     *      tags={"Protection"},
     *      description="Store Protection",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="Propagation that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Propagation")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="Propagation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Propagation")
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
     *                  ref="#/definitions/Protection"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateProtectionAPIRequest $request)
    {
        $input = $request->all();

        $protection = $this->protectionRepository->create($input);

        return $this->sendResponse($protection->toArray(), 'Protection saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/protections/{id}",
     *      summary="Display the specified Protection",
     *      tags={"Protection"},
     *      description="Get Protection",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Protection",
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
     *                  ref="#/definitions/Protection"
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
        /** @var Protection $protection */
        $protection = $this->protectionRepository->find($id, \request()->get('relations'));

        if (empty($protection)) {
            return $this->sendError('Protection not found');
        }

        return $this->sendResponse($protection->toArray(), 'Protection retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateProtectionAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/protections/{id}",
     *      summary="Update the specified Protection in storage",
     *      tags={"Protection"},
     *      description="Update Protection",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Protection",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="Propagation that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Propagation")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="Propagation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Propagation")
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
     *                  ref="#/definitions/Protection"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateProtectionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Protection $protection */
        $protection = $this->protectionRepository->find($id, \request()->get('relations'));

        if (empty($protection)) {
            return $this->sendError('Protection not found');
        }

        $protection = $this->protectionRepository->update($input, $id);

        return $this->sendResponse($protection->toArray(), 'Protection updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/protections/{id}",
     *      summary="Remove the specified Protection from storage",
     *      tags={"Protection"},
     *      description="Delete Protection",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Protection",
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
        /** @var Protection $protection */
        $protection = $this->protectionRepository->find($id, \request()->get('relations'));

        if (empty($protection)) {
            return $this->sendError('Protection not found');
        }

        $protection->delete();

        return $this->sendResponse($id, 'Protection deleted successfully');
    }
}
