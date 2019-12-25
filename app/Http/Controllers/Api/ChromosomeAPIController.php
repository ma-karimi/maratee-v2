<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\ChromosomeAPIRequest;
use App\Models\Chromosome;
use App\Repositories\ChromosomeRepository;
use Exception;
use Illuminate\Http\Request;
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
     * @throws Exception
     */
    public function index(Request $request)
    {
        $chromosomes = $this->chromosomeRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $this->getFieldRelations()
        );

        return $this->sendResponse($chromosomes->toArray(), 'Chromosomes retrieved successfully');
    }

    /**
     * @return array
     */
    private function getFieldRelations(): array
    {
        return ['article', 'taxonomy', 'generalClass', 'location'];
    }

    /**
     * @param ChromosomeAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/chromosomes",
     *      summary="Store a newly created Chromosome in storage",
     *      tags={"Chromosome"},
     *      description="Store Chromosome",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="v_number",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Chromosome")
     *      ),
     *      @SWG\Parameter(
     *          name="article_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Chromosome")
     *      ),
     *      @SWG\Parameter(
     *          name="location_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Chromosome")
     *      ),
     *      @SWG\Parameter(
     *          name="n_no",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Chromosome")
     *      ),
     *      @SWG\Parameter(
     *          name="n2_no",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Chromosome")
     *      ),
     *      @SWG\Parameter(
     *          name="taxonomy_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Chromosome")
     *      ),
     *      @SWG\Parameter(
     *          name="general_class_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Chromosome")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          required=false,
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
    public function store(ChromosomeAPIRequest $request)
    {

        $chromosome = $this->chromosomeRepository->create($request);

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
        $chromosome = $this->chromosomeRepository->find($id, $this->getFieldRelations()
        );

        if ($chromosome === null) {
            return $this->sendError('Chromosome not found');
        }

        return $this->sendResponse($chromosome->toArray(), 'Chromosome retrieved successfully');
    }

    /**
     * @param int $id
     * @param ChromosomeAPIRequest $request
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
     *          name="v_number",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Chromosome")
     *      ),
     *      @SWG\Parameter(
     *          name="article_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Chromosome")
     *      ),
     *      @SWG\Parameter(
     *          name="location_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Chromosome")
     *      ),
     *      @SWG\Parameter(
     *          name="n_no",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Chromosome")
     *      ),
     *      @SWG\Parameter(
     *          name="n2_no",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Chromosome")
     *      ),
     *      @SWG\Parameter(
     *          name="taxonomy_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Chromosome")
     *      ),
     *      @SWG\Parameter(
     *          name="general_class_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Chromosome")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          required=false,
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
    public function update($id, ChromosomeAPIRequest $request)
    {

        /** @var Chromosome $chromosome */
        $chromosome = $this->chromosomeRepository->find($id);

        if ($chromosome === null) {
            return $this->sendError('Chromosome not found');
        }

        $chromosome = $this->chromosomeRepository->update($request, $id);

        return $this->sendResponse($chromosome->toArray(), 'Chromosome updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws Exception
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
