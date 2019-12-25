<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\PlantGeographicalAPIRequest;
use App\Models\PlantGeographical;
use App\Repositories\PlantGeographicalRepository;
use Exception;
use Illuminate\Http\Request;
use Response;

/**
 * Class PlantGeographicalController
 * @package App\Http\Controllers\Api
 */
class PlantGeographicalAPIController extends AppBaseController
{
    /** @var  PlantGeographicalRepository */
    private $plantGeographicalRepository;

    public function __construct(PlantGeographicalRepository $plantGeographicalRepo)
    {
        $this->plantGeographicalRepository = $plantGeographicalRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/plant_geographicals",
     *      summary="Get a listing of the PlantGeographicals.",
     *      tags={"PlantGeographical"},
     *      description="Get all PlantGeographicals",
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
     *                  @SWG\Items(ref="#/definitions/PlantGeographical")
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
        $plantGeographicals = $this->plantGeographicalRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($plantGeographicals->toArray(), 'PlantGeographicals retrieved successfully');
    }

    /**
     * @param PlantGeographicalAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/plant_geographicals",
     *      summary="Store a newly created PlantGeographical in storage",
     *      tags={"PlantGeographical"},
     *      description="Store PlantGeographical",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="plant_id",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PlantGeographical")
     *      ),
     *      @SWG\Parameter(
     *          name="geographical_ids",
     *          in="body",
     *          description="array",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/PlantGeographical")
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
     *                  ref="#/definitions/PlantGeographical"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(PlantGeographicalAPIRequest $request)
    {
        $input = $request->all();

        $this->plantGeographicalRepository->store($input);

        return $this->sendResponse([], 'PlantGeographical saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws Exception
     * @SWG\Delete(
     *      path="/plant_geographicals/{id}",
     *      summary="Remove the specified PlantGeographical from storage",
     *      tags={"PlantGeographical"},
     *      description="Delete PlantGeographical",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of PlantGeographical",
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
        /** @var PlantGeographical $plantGeographical */
        $plantGeographical = $this->plantGeographicalRepository->find($id, \request()->get('relations'));

        if ($plantGeographical === null) {
            return $this->sendError('PlantGeographical not found');
        }

        $plantGeographical->delete();

        return $this->sendResponse($id, 'PlantGeographical deleted successfully');
    }
}
