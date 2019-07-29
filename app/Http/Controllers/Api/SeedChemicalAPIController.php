<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateSeedChemicalAPIRequest;
use App\Http\Requests\Api\UpdateSeedChemicalAPIRequest;
use App\Models\SeedChemical;
use App\Repositories\SeedChemicalRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SeedChemicalController
 * @package App\Http\Controllers\Api
 */

class SeedChemicalAPIController extends AppBaseController
{
    /** @var  SeedChemicalRepository */
    private $seedChemicalRepository;

    public function __construct(SeedChemicalRepository $seedChemicalRepo)
    {
        $this->seedChemicalRepository = $seedChemicalRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/seedChemicals",
     *      summary="Get a listing of the SeedChemicals.",
     *      tags={"SeedChemical"},
     *      description="Get all SeedChemicals",
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
     *                  @SWG\Items(ref="#/definitions/SeedChemical")
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
        $seedChemicals = $this->seedChemicalRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($seedChemicals->toArray(), 'Seed Chemicals retrieved successfully');
    }

    /**
     * @param CreateSeedChemicalAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/seedChemicals",
     *      summary="Store a newly created SeedChemical in storage",
     *      tags={"SeedChemical"},
     *      description="Store SeedChemical",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="chemical_id",
     *          in="body",
     *          description="SeedChemical that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedChemical")
     *      ),
     *      @SWG\Parameter(
     *          name="seed_id",
     *          in="body",
     *          description="SeedChemical that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedChemical")
     *      ),
     *      @SWG\Parameter(
     *          name="treatment",
     *          in="body",
     *          description="SeedChemical that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedChemical")
     *      ),
     *      @SWG\Parameter(
     *          name="repeat",
     *          in="body",
     *          description="SeedChemical that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedChemical")
     *      ),
     *      @SWG\Parameter(
     *          name="location_id",
     *          in="body",
     *          description="SeedChemical that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedChemical")
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
     *                  ref="#/definitions/SeedChemical"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSeedChemicalAPIRequest $request)
    {
        $input = $request->all();

        $seedChemical = $this->seedChemicalRepository->create($input);

        return $this->sendResponse($seedChemical->toArray(), 'Seed Chemical saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/seedChemicals/{id}",
     *      summary="Display the specified SeedChemical",
     *      tags={"SeedChemical"},
     *      description="Get SeedChemical",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedChemical",
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
     *                  ref="#/definitions/SeedChemical"
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
        /** @var SeedChemical $seedChemical */
        $seedChemical = $this->seedChemicalRepository->find($id);

        if (empty($seedChemical)) {
            return $this->sendError('Seed Chemical not found');
        }

        return $this->sendResponse($seedChemical->toArray(), 'Seed Chemical retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateSeedChemicalAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/seedChemicals/{id}",
     *      summary="Update the specified SeedChemical in storage",
     *      tags={"SeedChemical"},
     *      description="Update SeedChemical",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedChemical",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="chemical_id",
     *          in="body",
     *          description="SeedChemical that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedChemical")
     *      ),
     *      @SWG\Parameter(
     *          name="seed_id",
     *          in="body",
     *          description="SeedChemical that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedChemical")
     *      ),
     *      @SWG\Parameter(
     *          name="treatment",
     *          in="body",
     *          description="SeedChemical that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedChemical")
     *      ),
     *      @SWG\Parameter(
     *          name="repeat",
     *          in="body",
     *          description="SeedChemical that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedChemical")
     *      ),
     *      @SWG\Parameter(
     *          name="location_id",
     *          in="body",
     *          description="SeedChemical that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedChemical")
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
     *                  ref="#/definitions/SeedChemical"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSeedChemicalAPIRequest $request)
    {
        $input = $request->all();

        /** @var SeedChemical $seedChemical */
        $seedChemical = $this->seedChemicalRepository->find($id);

        if (empty($seedChemical)) {
            return $this->sendError('Seed Chemical not found');
        }

        $seedChemical = $this->seedChemicalRepository->update($input, $id);

        return $this->sendResponse($seedChemical->toArray(), 'SeedChemical updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/seedChemicals/{id}",
     *      summary="Remove the specified SeedChemical from storage",
     *      tags={"SeedChemical"},
     *      description="Delete SeedChemical",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedChemical",
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
        /** @var SeedChemical $seedChemical */
        $seedChemical = $this->seedChemicalRepository->find($id);

        if (empty($seedChemical)) {
            return $this->sendError('Seed Chemical not found');
        }

        $seedChemical->delete();

        return $this->sendResponse($id, 'Seed Chemical deleted successfully');
    }
}
