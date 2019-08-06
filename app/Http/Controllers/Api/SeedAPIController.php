<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateSeedAPIRequest;
use App\Http\Requests\Api\UpdateSeedAPIRequest;
use App\Models\Seed;
use App\Repositories\SeedRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class SeedController
 * @package App\Http\Controllers\Api
 */

class SeedAPIController extends AppBaseController
{
    /** @var  SeedRepository */
    private $seedRepository;

    public function __construct(SeedRepository $seedRepo)
    {
        $this->seedRepository = $seedRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/seeds",
     *      summary="Get a listing of the Seeds.",
     *      tags={"Seed"},
     *      description="Get all Seeds",
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
     *                  @SWG\Items(ref="#/definitions/Seed")
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
        $seeds = $this->seedRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($seeds->toArray(), 'Seeds retrieved successfully');
    }

    /**
     * @param CreateSeedAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/seeds",
     *      summary="Store a newly created Seed in storage",
     *      tags={"Seed"},
     *      description="Store Seed",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="herbarium_id",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="protection_id",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="department_id",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="field_code",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="correct_field_code",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="sample_code",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="voucher_no",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="transmittance",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="land_form",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="slope_direction",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="landscape",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="slope_degree",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="soil_depth",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="density",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="drainage",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="soil_ph",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="salinity",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="lime",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="climate",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="extent_population",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="vegetation",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="soil_erosion",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="land_reforming",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="sample_type",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="flowering",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="pollination",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="pollination_agent",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="fruit_type",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="seeding_bush_qt",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="collecting_type",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="seeding_month",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="reproduction",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="vegetative_form",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="height",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="mother_health",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="department_id",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="send_date",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="collected_qt",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="must_collected_qt",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="critical_extensions_qt",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="notes",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
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
     *                  ref="#/definitions/Seed"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSeedAPIRequest $request)
    {
        $input = $request->all();

        $seed = $this->seedRepository->create($input);

        return $this->sendResponse($seed->toArray(), 'Seed saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/seeds/{id}",
     *      summary="Display the specified Seed",
     *      tags={"Seed"},
     *      description="Get Seed",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Seed",
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
     *                  ref="#/definitions/Seed"
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
        /** @var Seed $seed */
        $seed = $this->seedRepository->find($id, \request()->get('relations'));

        if (empty($seed)) {
            return $this->sendError('Seed not found');
        }

        return $this->sendResponse($seed->toArray(), 'Seed retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateSeedAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/seeds/{id}",
     *      summary="Update the specified Seed in storage",
     *      tags={"Seed"},
     *      description="Update Seed",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Seed",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="herbarium_id",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="protection_id",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="department_id",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="field_code",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="correct_field_code",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="sample_code",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="voucher_no",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="transmittance",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="land_form",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="slope_direction",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="landscape",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="slope_degree",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="soil_depth",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="density",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="drainage",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="soil_ph",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="salinity",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="lime",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="climate",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="extent_population",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="vegetation",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="soil_erosion",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="land_reforming",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="sample_type",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="flowering",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="pollination",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="pollination_agent",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="fruit_type",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="seeding_bush_qt",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="collecting_type",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="seeding_month",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="reproduction",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="vegetative_form",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="height",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="mother_health",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="department_id",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="send_date",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="collected_qt",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="must_collected_qt",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="critical_extensions_qt",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
     *      ),
     *      @SWG\Parameter(
     *          name="notes",
     *          in="body",
     *          description="Seed that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Seed")
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
     *                  ref="#/definitions/Seed"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSeedAPIRequest $request)
    {
        $input = $request->all();

        /** @var Seed $seed */
        $seed = $this->seedRepository->find($id, \request()->get('relations'));

        if (empty($seed)) {
            return $this->sendError('Seed not found');
        }

        $seed = $this->seedRepository->update($input, $id);

        return $this->sendResponse($seed->toArray(), 'Seed updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/seeds/{id}",
     *      summary="Remove the specified Seed from storage",
     *      tags={"Seed"},
     *      description="Delete Seed",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Seed",
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
        /** @var Seed $seed */
        $seed = $this->seedRepository->find($id, \request()->get('relations'));

        if (empty($seed)) {
            return $this->sendError('Seed not found');
        }

        $seed->delete();

        return $this->sendResponse($id, 'Seed deleted successfully');
    }
}
