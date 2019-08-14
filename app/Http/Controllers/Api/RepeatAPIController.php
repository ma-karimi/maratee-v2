<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateRepeatAPIRequest;
use App\Http\Requests\Api\UpdateRepeatAPIRequest;
use App\Models\Repeat;
use App\Repositories\RepeatRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class RepeatController
 * @package App\Http\Controllers\Api
 */

class RepeatAPIController extends AppBaseController
{
    /** @var  RepeatRepository */
    private $repeatRepository;

    public function __construct(RepeatRepository $repeatRepo)
    {
        $this->repeatRepository = $repeatRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/repeats",
     *      summary="Get a listing of the Repeats.",
     *      tags={"Repeat"},
     *      description="Get all Repeats",
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
     *                  @SWG\Items(ref="#/definitions/Repeat")
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
        $repeats = $this->repeatRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($repeats->toArray(), 'Repeats retrieved successfully');
    }

    /**
     * @param CreateRepeatAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/repeats",
     *      summary="Store a newly created Repeat in storage",
     *      tags={"Repeat"},
     *      description="Store Repeat",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="germination_id",
     *          in="body",
     *          description="Repeat that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Repeat")
     *      ),
     *      @SWG\Parameter(
     *          name="repeat",
     *          in="body",
     *          description="Repeat that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Repeat")
     *      ),
     *      @SWG\Parameter(
     *          name="date",
     *          in="body",
     *          description="Repeat that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Repeat")
     *      ),
     *      @SWG\Parameter(
     *          name="count_no",
     *          in="body",
     *          description="Repeat that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Repeat")
     *      ),
     *      @SWG\Parameter(
     *          name="germination_number",
     *          in="body",
     *          description="Repeat that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Repeat")
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
     *                  ref="#/definitions/Repeat"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateRepeatAPIRequest $request)
    {
        $input = $request->all();

        $repeat = $this->repeatRepository->create($input);

        return $this->sendResponse($repeat->toArray(), 'Repeat saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/repeats/{id}",
     *      summary="Display the specified Repeat",
     *      tags={"Repeat"},
     *      description="Get Repeat",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Repeat",
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
     *                  ref="#/definitions/Repeat"
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
        /** @var Repeat $repeat */
        $repeat = $this->repeatRepository->find($id);

        if (empty($repeat)) {
            return $this->sendError('Repeat not found');
        }

        return $this->sendResponse($repeat->toArray(), 'Repeat retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateRepeatAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/repeats/{id}",
     *      summary="Update the specified Repeat in storage",
     *      tags={"Repeat"},
     *      description="Update Repeat",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Repeat",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="germination_id",
     *          in="body",
     *          description="Repeat that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Repeat")
     *      ),
     *      @SWG\Parameter(
     *          name="repeat",
     *          in="body",
     *          description="Repeat that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Repeat")
     *      ),
     *      @SWG\Parameter(
     *          name="date",
     *          in="body",
     *          description="Repeat that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Repeat")
     *      ),
     *      @SWG\Parameter(
     *          name="count_no",
     *          in="body",
     *          description="Repeat that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Repeat")
     *      ),
     *      @SWG\Parameter(
     *          name="germination_number",
     *          in="body",
     *          description="Repeat that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Repeat")
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
     *                  ref="#/definitions/Repeat"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateRepeatAPIRequest $request)
    {
        $input = $request->all();

        /** @var Repeat $repeat */
        $repeat = $this->repeatRepository->find($id);

        if (empty($repeat)) {
            return $this->sendError('Repeat not found');
        }

        $repeat = $this->repeatRepository->update($input, $id);

        return $this->sendResponse($repeat->toArray(), 'Repeat updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/repeats/{id}",
     *      summary="Remove the specified Repeat from storage",
     *      tags={"Repeat"},
     *      description="Delete Repeat",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Repeat",
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
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var Repeat $repeat */
        $repeat = $this->repeatRepository->find($id);

        if (empty($repeat)) {
            return $this->sendError('Repeat not found');
        }

        $repeat->delete();

        return $this->sendResponse($id, 'Repeat deleted successfully');
    }
}
