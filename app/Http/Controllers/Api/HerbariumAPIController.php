<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\HerbariumAPIRequest;
use App\Http\Requests\MediaAPIRequest;
use App\Models\Herbarium;
use App\Repositories\HerbariumRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Response;

/**
 * Class HerbariumController
 * @package App\Http\Controllers\Api
 */
class HerbariumAPIController extends AppBaseController
{
    /** @var  HerbariumRepository */
    private $herbariumRepository;

    public function __construct(HerbariumRepository $herbariumRepo)
    {
        $this->herbariumRepository = $herbariumRepo;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|Response
     *
     * @SWG\Get(
     *      path="/herbariums",
     *      summary="Get a listing of the Herbariums.",
     *      tags={"Herbarium"},
     *      description="Get all Herbariums",
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
     *                  @SWG\Items(ref="#/definitions/Herbarium")
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
        $herbariums = $this->herbariumRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $this->herbariumRepository->getRelationFields()
        );

        if (!empty($request->filled('print'))) {
            return view('print.herbarium', compact('herbariums'));
        }
        $keys = [
            ['name' => 'family', 'title' => 'Family', 'value' => false],
            ['name' => 'genus', 'title' => 'Genus', 'value' => false],
            ['name' => 'species', 'title' => 'Species', 'value' => false],
            ['name' => 'subspecies', 'title' => 'SubSpecies', 'value' => false],
            ['name' => 'variety', 'title' => 'Variety', 'value' => false],
            ['name' => 'scientific', 'title' => 'Scientific', 'value' => false],
            ['name' => 'local_name', 'title' => 'Local Name', 'value' => false],
            ['name' => 'author', 'title' => 'Author', 'value' => false],
            ['name' => 'location', 'title' => 'Location', 'value' => false],
            ['name' => 'collect', 'title' => 'Collect', 'value' => false],
            ['name' => 'determine', 'title' => 'Determine', 'value' => false],
            ['name' => 'description', 'title' => 'Description', 'value' => false],
            ['name' => 'herbarium', 'title' => 'Herbarium', 'value' => false],
            ['name' => 'borrow', 'title' => 'Borrow', 'value' => false],
            ['name' => 'visit', 'title' => 'Visit', 'value' => false],
            ['name' => 'exchange', 'title' => 'Exchange', 'value' => false],
            ['name' => 'type_sample_image', 'title' => 'Type Sample', 'value' => false],
            ['name' => 'consideration', 'title' => 'Consideration', 'value' => false],
        ];
        return $this->sendResponse(compact('herbariums', 'keys'), 'Herbariums retrieved successfully');
    }

    /**
     * @param HerbariumAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/herbariums",
     *      summary="Store a newly created Herbarium in storage",
     *      tags={"Herbarium"},
     *      description="Store Herbarium",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="herbarium_number",
     *          in="body",
     *          description="Plant Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="location_id",
     *          in="body",
     *          description="Plant Herbarium that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="organization_id",
     *          in="body",
     *          description="Plant Herbarium that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="herbarium_index",
     *          in="body",
     *          description="Plant Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="cf",
     *          in="body",
     *          description="s,u,f,g,v",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="taxonomy_id",
     *          in="body",
     *          description="Plant Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
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
     *                  ref="#/definitions/Herbarium"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     * @throws ValidationException
     */
    public function store(HerbariumAPIRequest $request)
    {

        $herbarium = $this->herbariumRepository->create($request);

        return $this->sendResponse($herbarium->toArray(), 'Herbarium saved successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|Response
     *
     * @SWG\Get(
     *      path="/herbariums/{id}",
     *      summary="Display the specified Herbarium",
     *      tags={"Herbarium"},
     *      description="Get Herbarium",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Herbarium",
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
     *                  ref="#/definitions/Herbarium"
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
        /** @var Herbarium $herbarium */
        $herbarium = $this->herbariumRepository->find($id, $this->herbariumRepository->getRelationFields());

        if ($herbarium === null) {
            return $this->sendError('Herbarium not found');
        }

        if (!empty(\request()->filled('print'))) {
            return view('print.herbarium', compact('herbarium'));
        }
        return $this->sendResponse($herbarium->toArray(), 'Herbarium retrieved successfully');
    }

    /**
     * @param int $id
     * @param HerbariumAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/herbariums/{id}",
     *      summary="Update the specified Herbarium in storage",
     *      tags={"Herbarium"},
     *      description="Update Herbarium",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Herbarium",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="herbarium_number",
     *          in="body",
     *          description="Plant Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="location_id",
     *          in="body",
     *          description="Plant Herbarium that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="organization_id",
     *          in="body",
     *          description="Plant Herbarium that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="herbarium_index",
     *          in="body",
     *          description="Plant Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="cf",
     *          in="body",
     *          description="s,u,f,g,v",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
     *      ),
     *      @SWG\Parameter(
     *          name="taxonomy_id",
     *          in="body",
     *          description="Plant Herbarium that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Herbarium")
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
     *                  ref="#/definitions/Herbarium"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     * @throws ValidationException
     */
    public function update($id, HerbariumAPIRequest $request)
    {

        /** @var Herbarium $herbarium */
        $herbarium = $this->herbariumRepository->find($id, []);

        if ($herbarium === null) {
            return $this->sendError('Herbarium not found');
        }

        $herbarium = $this->herbariumRepository->update($request, $id);

        return $this->sendResponse($herbarium->toArray(), 'Herbarium updated successfully');
    }


    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Post(
     *      path="/herbariums/{id}/media",
     *      tags={"Herbarium"},
     *      description="Store Herbarium Media",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Herbarium",
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
     * @throws Exception
     */
    public function media(MediaAPIRequest $mediaAPIRequest, $id)
    {
        $plant = $this->herbariumRepository->find($id, []);

        if (empty($plant)) {
            return $this->sendError('Herbarium not found');
        }

        $this->herbariumRepository->storeMedia($mediaAPIRequest->all(), $plant);

        return $this->sendResponse($id, 'Herbarium Media Stored successfully');
    }

}
