<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateChromosomeAPIRequest;
use App\Http\Requests\Api\UpdateChromosomeAPIRequest;
use App\Models\Chromosome;
use App\Repositories\ChromosomeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ChromosomeController
 * @package App\Http\Controllers\Api
 */

class ChromosomeAPIController extends AppBaseController
{
    /** @var  ChromosomeRepository */
    private $chromosomeRepository;

    public function __construct(ChromosomeRepository $chromosomeRepo)
    {
        $this->chromosomeRepository = $chromosomeRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/chromosomes",
     *      summary="Get a listing of the Chromosomes.",
     *      tags={"Chromosome"},
     *      description="Get all Chromosomes",
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
     *                  @SWG\Items(ref="#/definitions/Chromosome")
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
        $chromosomes = $this->chromosomeRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($chromosomes->toArray(), 'Chromosomes retrieved successfully');
    }

    /**
     * @param CreateChromosomeAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/chromosomes",
     *      summary="Store a newly created Chromosome in storage",
     *      tags={"Chromosome"},
     *      description="Store Chromosome",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="n_no",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Chromosome")
     *      ),
     *      @SWG\Parameter(
     *          name="2n_no",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Chromosome")
     *      ),
     *      @SWG\Parameter(
     *          name="notes",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Chromosome")
     *      ),
     *      @SWG\Parameter(
     *          name="herbarium_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Chromosome")
     *      ),
     *      @SWG\Parameter(
     *          name="cryo_bank_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Chromosome")
     *      ),
     *      @SWG\Parameter(
     *          name="article_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Chromosome")
     *      ),
     *      @SWG\Parameter(
     *          name="location_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Chromosome")
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
     *                  ref="#/definitions/Chromosome"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateChromosomeAPIRequest $request)
    {
        $input = $request->all();

        $chromosome = $this->chromosomeRepository->create($input);

        return $this->sendResponse($chromosome->toArray(), 'Chromosome saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/chromosomes/{id}",
     *      summary="Display the specified Chromosome",
     *      tags={"Chromosome"},
     *      description="Get Chromosome",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Chromosome",
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
     *                  ref="#/definitions/Chromosome"
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
        /** @var Chromosome $chromosome */
        $chromosome = $this->chromosomeRepository->find($id);

        if ($chromosome === null) {
            return $this->sendError('Chromosome not found');
        }

        return $this->sendResponse($chromosome->toArray(), 'Chromosome retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateChromosomeAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/chromosomes/{id}",
     *      summary="Update the specified Chromosome in storage",
     *      tags={"Chromosome"},
     *      description="Update Chromosome",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Chromosome",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="n_no",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Chromosome")
     *      ),
     *      @SWG\Parameter(
     *          name="2n_no",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Chromosome")
     *      ),
     *      @SWG\Parameter(
     *          name="notes",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Chromosome")
     *      ),
     *      @SWG\Parameter(
     *          name="herbarium_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Chromosome")
     *      ),
     *      @SWG\Parameter(
     *          name="cryo_bank_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Chromosome")
     *      ),
     *      @SWG\Parameter(
     *          name="article_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Chromosome")
     *      ),
     *      @SWG\Parameter(
     *          name="location_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Chromosome")
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
     *                  ref="#/definitions/Chromosome"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateChromosomeAPIRequest $request)
    {
        $input = $request->all();

        /** @var Chromosome $chromosome */
        $chromosome = $this->chromosomeRepository->find($id);

        if ($chromosome === null) {
            return $this->sendError('Chromosome not found');
        }

        $chromosome = $this->chromosomeRepository->update($input, $id);

        return $this->sendResponse($chromosome->toArray(), 'Chromosome updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/chromosomes/{id}",
     *      summary="Remove the specified Chromosome from storage",
     *      tags={"Chromosome"},
     *      description="Delete Chromosome",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Chromosome",
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
        /** @var Chromosome $chromosome */
        $chromosome = $this->chromosomeRepository->find($id);

        if ($chromosome === null) {
            return $this->sendError('Chromosome not found');
        }

        $chromosome->delete();

        return $this->sendResponse($id, 'Chromosome deleted successfully');
    }
}
