<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateSeedTechnologyAPIRequest;
use App\Http\Requests\Api\UpdateSeedTechnologyAPIRequest;
use App\Models\SeedTechnology;
use App\Repositories\SeedTechnologyRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SeedTechnologyController
 * @package App\Http\Controllers\Api
 */

class SeedTechnologyAPIController extends AppBaseController
{
    /** @var  SeedTechnologyRepository */
    private $seedTechnologyRepository;

    public function __construct(SeedTechnologyRepository $seedTechnologyRepo)
    {
        $this->seedTechnologyRepository = $seedTechnologyRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/seed_technologies",
     *      summary="Get a listing of the SeedTechnologies.",
     *      tags={"SeedTechnology"},
     *      description="Get all SeedTechnologies",
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
     *                  @SWG\Items(ref="#/definitions/SeedTechnology")
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
    public function index(Request $request)
    {
        $seedTechnologies = $this->seedTechnologyRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($seedTechnologies->toArray(), 'Seed Technologies retrieved successfully');
    }

    /**
     * @param CreateSeedTechnologyAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/seed_technologies",
     *      summary="Store a newly created SeedTechnology in storage",
     *      tags={"SeedTechnology"},
     *      description="Store SeedTechnology",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="",
     *          in="body",
     *          description="SeedTechnology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedTechnology")
     *      ),
     *      @SWG\Parameter(
     *          name="seed_type",
     *          in="body",
     *          description="SeedTechnology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedTechnology")
     *      ),
     *      @SWG\Parameter(
     *          name="conserved_content",
     *          in="body",
     *          description="SeedTechnology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedTechnology")
     *      ),
     *      @SWG\Parameter(
     *          name="mean_seed_per_fruit",
     *          in="body",
     *          description="SeedTechnology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedTechnology")
     *      ),
     *      @SWG\Parameter(
     *          name="",
     *          in="body",
     *          description="SeedTechnology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedTechnology")
     *      ),
     *      @SWG\Parameter(
     *          name="thousand_seed_weight",
     *          in="body",
     *          description="SeedTechnology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedTechnology")
     *      ),
     *      @SWG\Parameter(
     *          name="thousand_fruit_weight",
     *          in="body",
     *          description="SeedTechnology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedTechnology")
     *      ),
     *      @SWG\Parameter(
     *          name="humidity",
     *          in="body",
     *          description="SeedTechnology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedTechnology")
     *      ),
     *      @SWG\Parameter(
     *          name="purity",
     *          in="body",
     *          description="SeedTechnology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedTechnology")
     *      ),
     *      @SWG\Parameter(
     *          name="empty_impurity_seeds",
     *          in="body",
     *          description="SeedTechnology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedTechnology")
     *      ),
     *      @SWG\Parameter(
     *          name="abnormal_seeding",
     *          in="body",
     *          description="SeedTechnology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedTechnology")
     *      ),
     *      @SWG\Parameter(
     *          name="rotten_seed",
     *          in="body",
     *          description="SeedTechnology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedTechnology")
     *      ),
     *      @SWG\Parameter(
     *          name="fresh_none_germinated",
     *          in="body",
     *          description="SeedTechnology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedTechnology")
     *      ),
     *      @SWG\Parameter(
     *          name="seed_origin",
     *          in="body",
     *          description="SeedTechnology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedTechnology")
     *      ),
     *      @SWG\Parameter(
     *          name="viability",
     *          in="body",
     *          description="SeedTechnology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedTechnology")
     *      ),
     *      @SWG\Parameter(
     *          name="other_detail",
     *          in="body",
     *          description="SeedTechnology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedTechnology")
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
     *                  ref="#/definitions/SeedTechnology"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSeedTechnologyAPIRequest $request)
    {
        $input = $request->all();

        $seedTechnology = $this->seedTechnologyRepository->create($input);

        return $this->sendResponse($seedTechnology->toArray(), 'Seed Technology saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/seed_technologies/{id}",
     *      summary="Display the specified SeedTechnology",
     *      tags={"SeedTechnology"},
     *      description="Get SeedTechnology",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedTechnology",
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
     *                  ref="#/definitions/SeedTechnology"
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
        /** @var SeedTechnology $seedTechnology */
        $seedTechnology = $this->seedTechnologyRepository->find($id, \request()->get('relations'));

        if (empty($seedTechnology)) {
            return $this->sendError('Seed Technology not found');
        }

        return $this->sendResponse($seedTechnology->toArray(), 'Seed Technology retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateSeedTechnologyAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/seed_technologies/{id}",
     *      summary="Update the specified SeedTechnology in storage",
     *      tags={"SeedTechnology"},
     *      description="Update SeedTechnology",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedTechnology",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="",
     *          in="body",
     *          description="SeedTechnology that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/SeedTechnology")
     *      ),
     *      @SWG\Parameter(
     *          name="",
     *          in="body",
     *          description="SeedTechnology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedTechnology")
     *      ),
     *      @SWG\Parameter(
     *          name="seed_type",
     *          in="body",
     *          description="SeedTechnology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedTechnology")
     *      ),
     *      @SWG\Parameter(
     *          name="conserved_content",
     *          in="body",
     *          description="SeedTechnology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedTechnology")
     *      ),
     *      @SWG\Parameter(
     *          name="mean_seed_per_fruit",
     *          in="body",
     *          description="SeedTechnology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedTechnology")
     *      ),
     *      @SWG\Parameter(
     *          name="thousand_seed_weight",
     *          in="body",
     *          description="SeedTechnology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedTechnology")
     *      ),
     *      @SWG\Parameter(
     *          name="thousand_fruit_weight",
     *          in="body",
     *          description="SeedTechnology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedTechnology")
     *      ),
     *      @SWG\Parameter(
     *          name="humidity",
     *          in="body",
     *          description="SeedTechnology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedTechnology")
     *      ),
     *      @SWG\Parameter(
     *          name="purity",
     *          in="body",
     *          description="SeedTechnology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedTechnology")
     *      ),
     *      @SWG\Parameter(
     *          name="empty_impurity_seeds",
     *          in="body",
     *          description="SeedTechnology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedTechnology")
     *      ),
     *      @SWG\Parameter(
     *          name="abnormal_seeding",
     *          in="body",
     *          description="SeedTechnology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedTechnology")
     *      ),
     *      @SWG\Parameter(
     *          name="rotten_seed",
     *          in="body",
     *          description="SeedTechnology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedTechnology")
     *      ),
     *      @SWG\Parameter(
     *          name="fresh_none_germinated",
     *          in="body",
     *          description="SeedTechnology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedTechnology")
     *      ),
     *      @SWG\Parameter(
     *          name="seed_origin",
     *          in="body",
     *          description="SeedTechnology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedTechnology")
     *      ),
     *      @SWG\Parameter(
     *          name="viability",
     *          in="body",
     *          description="SeedTechnology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedTechnology")
     *      ),
     *      @SWG\Parameter(
     *          name="other_detail",
     *          in="body",
     *          description="SeedTechnology that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SeedTechnology")
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
     *                  ref="#/definitions/SeedTechnology"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSeedTechnologyAPIRequest $request)
    {
        $input = $request->all();

        /** @var SeedTechnology $seedTechnology */
        $seedTechnology = $this->seedTechnologyRepository->find($id, \request()->get('relations'));

        if (empty($seedTechnology)) {
            return $this->sendError('Seed Technology not found');
        }

        $seedTechnology = $this->seedTechnologyRepository->update($input, $id);

        return $this->sendResponse($seedTechnology->toArray(), 'SeedTechnology updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/seed_technologies/{id}",
     *      summary="Remove the specified SeedTechnology from storage",
     *      tags={"SeedTechnology"},
     *      description="Delete SeedTechnology",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of SeedTechnology",
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
        /** @var SeedTechnology $seedTechnology */
        $seedTechnology = $this->seedTechnologyRepository->find($id, \request()->get('relations'));

        if (empty($seedTechnology)) {
            return $this->sendError('Seed Technology not found');
        }

        $seedTechnology->delete();

        return $this->sendResponse($id, 'Seed Technology deleted successfully');
    }
}
