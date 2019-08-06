<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateHerbariumAppendixAPIRequest;
use App\Http\Requests\Api\UpdateHerbariumAppendixAPIRequest;
use App\Models\HerbariumAppendix;
use App\Repositories\HerbariumAppendixRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class HerbariumAppendixController
 * @package App\Http\Controllers\Api
 */

class HerbariumAppendixAPIController extends AppBaseController
{
    /** @var  HerbariumAppendixRepository */
    private $herbariumAppendixRepository;

    public function __construct(HerbariumAppendixRepository $herbariumAppendixRepo)
    {
        $this->herbariumAppendixRepository = $herbariumAppendixRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/herbariumAppendixes",
     *      summary="Get a listing of the HerbariumAppendixes.",
     *      tags={"HerbariumAppendix"},
     *      description="Get all HerbariumAppendixes",
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
     *                  @SWG\Items(ref="#/definitions/HerbariumAppendix")
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
        $herbariumAppendixes = $this->herbariumAppendixRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($herbariumAppendixes->toArray(), 'Herbarium Appendixes retrieved successfully');
    }

    /**
     * @param CreateHerbariumAppendixAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/herbariumAppendixes",
     *      summary="Store a newly created HerbariumAppendix in storage",
     *      tags={"HerbariumAppendix"},
     *      description="Store HerbariumAppendix",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="herbarium_id",
     *          in="body",
     *          description="HerbariumAppendix that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/HerbariumAppendix")
     *      ),
     *      @SWG\Parameter(
     *          name="appendix",
     *          in="body",
     *          description="HerbariumAppendix that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/HerbariumAppendix")
     *      ),
     *      @SWG\Parameter(
     *          name="destination_herbarium_id",
     *          in="body",
     *          description="HerbariumAppendix that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/HerbariumAppendix")
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
     *                  ref="#/definitions/HerbariumAppendix"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateHerbariumAppendixAPIRequest $request)
    {
        $input = $request->all();

        $herbariumAppendix = $this->herbariumAppendixRepository->create($input);

        return $this->sendResponse($herbariumAppendix->toArray(), 'Herbarium Appendix saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/herbariumAppendixes/{id}",
     *      summary="Display the specified HerbariumAppendix",
     *      tags={"HerbariumAppendix"},
     *      description="Get HerbariumAppendix",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of HerbariumAppendix",
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
     *                  ref="#/definitions/HerbariumAppendix"
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
        /** @var HerbariumAppendix $herbariumAppendix */
        $herbariumAppendix = $this->herbariumAppendixRepository->find($id, \request()->get('relations'));

        if ($herbariumAppendix === null) {
            return $this->sendError('Herbarium Appendix not found');
        }

        return $this->sendResponse($herbariumAppendix->toArray(), 'Herbarium Appendix retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateHerbariumAppendixAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/herbariumAppendixes/{id}",
     *      summary="Update the specified HerbariumAppendix in storage",
     *      tags={"HerbariumAppendix"},
     *      description="Update HerbariumAppendix",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of HerbariumAppendix",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="herbarium_id",
     *          in="body",
     *          description="HerbariumAppendix that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/HerbariumAppendix")
     *      ),
     *      @SWG\Parameter(
     *          name="appendix",
     *          in="body",
     *          description="HerbariumAppendix that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/HerbariumAppendix")
     *      ),
     *      @SWG\Parameter(
     *          name="destination_herbarium_id",
     *          in="body",
     *          description="HerbariumAppendix that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/HerbariumAppendix")
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
     *                  ref="#/definitions/HerbariumAppendix"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateHerbariumAppendixAPIRequest $request)
    {
        $input = $request->all();

        /** @var HerbariumAppendix $herbariumAppendix */
        $herbariumAppendix = $this->herbariumAppendixRepository->find($id, \request()->get('relations'));

        if ($herbariumAppendix === null) {
            return $this->sendError('Herbarium Appendix not found');
        }

        $herbariumAppendix = $this->herbariumAppendixRepository->update($input, $id);

        return $this->sendResponse($herbariumAppendix->toArray(), 'HerbariumAppendix updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/herbariumAppendixes/{id}",
     *      summary="Remove the specified HerbariumAppendix from storage",
     *      tags={"HerbariumAppendix"},
     *      description="Delete HerbariumAppendix",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of HerbariumAppendix",
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
        /** @var HerbariumAppendix $herbariumAppendix */
        $herbariumAppendix = $this->herbariumAppendixRepository->find($id, \request()->get('relations'));

        if (empty($herbariumAppendix)) {
            return $this->sendError('Herbarium Appendix not found');
        }

        $herbariumAppendix->delete();

        return $this->sendResponse($id, 'Herbarium Appendix deleted successfully');
    }
}
