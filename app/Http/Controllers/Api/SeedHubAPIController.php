<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\CreateSeedHubAPIRequest;
use App\Http\Requests\Api\UpdateSeedHubAPIRequest;
use App\Models\SeedHub;
use App\Repositories\SeedHubRepository;
use Exception;
use Illuminate\Http\Request;
use Response;

/**
 * Class SeedHubController
 * @package App\Http\Controllers\Api
 */
class SeedHubAPIController extends AppBaseController
{
    /** @var  SeedHubRepository */
    private $seedHubRepository;

    public function __construct(SeedHubRepository $seedHubRepo)
    {
        $this->seedHubRepository = $seedHubRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/seed_hubs",
     *      summary="Get a listing of the SeedHubs.",
     *      tags={"SeedHub"},
     *      description="Get all SeedHubs",
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
     *                  @SWG\Items(ref="#/definitions/SeedHub")
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
        $seedHubs = $this->seedHubRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($seedHubs->toArray(), 'Seed Hubs retrieved successfully');
    }

    /**
     * @param CreateSeedHubAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/seed_hubs",
     *      summary="Store a newly created SeedHub in storage",
     *      tags={"SeedHub"},
     *      description="Store SeedHub",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="user_id",
     *          in="body",
     *          description="SeedHub that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedHub")
     *      ),
     *      @SWG\Parameter(
     *          name="seed_id",
     *          in="body",
     *          description="SeedHub that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedHub")
     *      ),
     *      @SWG\Parameter(
     *          name="location_id",
     *          in="body",
     *          description="SeedHub that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedHub")
     *      ),
     *      @SWG\Parameter(
     *          name="action_id",
     *          in="body",
     *          description="SeedHub that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedHub")
     *      ),
     *      @SWG\Parameter(
     *          name="project_id",
     *          in="body",
     *          description="SeedHub that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedHub")
     *      ),
     *      @SWG\Parameter(
     *          name="action_role",
     *          in="body",
     *          description="SeedHub that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedHub")
     *      ),
     *      @SWG\Parameter(
     *          name="action_role_description",
     *          in="body",
     *          description="SeedHub that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedHub")
     *      ),
     *      @SWG\Parameter(
     *          name="date",
     *          in="body",
     *          description="SeedHub that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedHub")
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
     *                  ref="#/definitions/SeedHub"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSeedHubAPIRequest $request)
    {
        $input = $request->all();

        $seedHub = $this->seedHubRepository->create($input);

        return $this->sendResponse($seedHub->toArray(), 'Seed Hub saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/seed_hubs/{id}",
     *      summary="Display the specified SeedHub",
     *      tags={"SeedHub"},
     *      description="Get SeedHub",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedHub",
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
     *                  ref="#/definitions/SeedHub"
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
        /** @var SeedHub $seedHub */
        $seedHub = $this->seedHubRepository->find($id, \request()->get('relations'));

        if (empty($seedHub)) {
            return $this->sendError('Seed Hub not found');
        }

        return $this->sendResponse($seedHub->toArray(), 'Seed Hub retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateSeedHubAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/seed_hubs/{id}",
     *      summary="Update the specified SeedHub in storage",
     *      tags={"SeedHub"},
     *      description="Update SeedHub",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedHub",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="user_id",
     *          in="body",
     *          description="SeedHub that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedHub")
     *      ),
     *      @SWG\Parameter(
     *          name="seed_id",
     *          in="body",
     *          description="SeedHub that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedHub")
     *      ),
     *      @SWG\Parameter(
     *          name="location_id",
     *          in="body",
     *          description="SeedHub that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedHub")
     *      ),
     *      @SWG\Parameter(
     *          name="action_id",
     *          in="body",
     *          description="SeedHub that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedHub")
     *      ),
     *      @SWG\Parameter(
     *          name="project_id",
     *          in="body",
     *          description="SeedHub that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedHub")
     *      ),
     *      @SWG\Parameter(
     *          name="action_role",
     *          in="body",
     *          description="SeedHub that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedHub")
     *      ),
     *      @SWG\Parameter(
     *          name="action_role_description",
     *          in="body",
     *          description="SeedHub that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedHub")
     *      ),
     *      @SWG\Parameter(
     *          name="date",
     *          in="body",
     *          description="SeedHub that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedHub")
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
     *                  ref="#/definitions/SeedHub"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSeedHubAPIRequest $request)
    {
        $input = $request->all();

        /** @var SeedHub $seedHub */
        $seedHub = $this->seedHubRepository->find($id, \request()->get('relations'));

        if (empty($seedHub)) {
            return $this->sendError('Seed Hub not found');
        }

        $seedHub = $this->seedHubRepository->update($input, $id);

        return $this->sendResponse($seedHub->toArray(), 'SeedHub updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws Exception
     * @SWG\Delete(
     *      path="/seed_hubs/{id}",
     *      summary="Remove the specified SeedHub from storage",
     *      tags={"SeedHub"},
     *      description="Delete SeedHub",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedHub",
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
        /** @var SeedHub $seedHub */
        $seedHub = $this->seedHubRepository->find($id, \request()->get('relations'));

        if (empty($seedHub)) {
            return $this->sendError('Seed Hub not found');
        }

        $seedHub->delete();

        return $this->sendResponse($id, 'Seed Hub deleted successfully');
    }
}
