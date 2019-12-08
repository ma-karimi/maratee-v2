<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\HerbariumAPIRequest;
use App\Models\Herbarium;
use App\Repositories\HerbariumRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
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
     * @return Response
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
     * @throws \Exception
     */
    public function index(Request $request)
    {
        $herbariums = $this->herbariumRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('is_flowering') == 1 ? $this->getFieldRelations() : $this->getFieldNonFlowerRelations()
        );

        return $this->sendResponse($herbariums->toArray(), 'Herbariums retrieved successfully');
    }

    public function getFieldRelations()
    {
        return ['taxonomy', 'organization', 'media', 'determine', 'collect', 'location'];
    }

    private function getFieldNonFlowerRelations()
    {
        return ['generalPhytogeography', 'taxonomy', 'generalHabitat', 'media', 'generalSubstrate.parent', 'collect.actors', 'determine.actors', 'transactions', 'location'];
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
     */
    public function store(HerbariumAPIRequest $request)
    {

        $herbarium = $this->herbariumRepository->create($request);

        return $this->sendResponse($herbarium->toArray(), 'Herbarium saved successfully');
    }

    /**
     * @param int $id
     * @return Response
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
        $herbarium = $this->herbariumRepository->find($id);

        if ($herbarium === null) {
            return $this->sendError('Herbarium not found');
        }

        $herbarium = $herbarium->is_flowering == 1 ? $herbarium->load($this->getFieldRelations()) : $herbarium->load($this->getFieldNonFlowerRelations());
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
     * @throws \Exception
     * @SWG\Delete(
     *      path="/herbariums/{id}",
     *      summary="Remove the specified Herbarium from storage",
     *      tags={"Herbarium"},
     *      description="Delete Herbarium",
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
     */
    public function destroy($id)
    {
        /** @var Herbarium $herbarium */
        $herbarium = $this->herbariumRepository->find($id, []);

        if ($herbarium === null) {
            return $this->sendError('Herbarium not found');
        }

        $herbarium->delete();

        return $this->sendResponse($id, 'Herbarium deleted successfully');
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
     * @throws \Exception
     */
    public function media($id)
    {
        $plant = $this->herbariumRepository->find($id, []);

        if (empty($plant)) {
            return $this->sendError('Herbarium not found');
        }

        $this->herbariumRepository->storeMedia(\request()->all(), $plant);

        return $this->sendResponse($id, 'Herbarium Media Stored successfully');
    }


    public function excel(Request $request)
    {
        $herbariums = $this->herbariumRepository->all(
            [],
            null,
            null,
            $request->get('is_flowering') == 1 ? $this->getFieldRelations() : $this->getFieldNonFlowerRelations()
        );


        $view = \request()->is_flowering == 1 ? 'exports.herbarium' : 'exports.nonflower';
        $herbarium = \request()->is_flowering == 1 ? 'Herbarium' : 'NonFlower';
        return Excel::create("Export${$herbarium}List-" . date('Y-m-d-H-i-s'), function ($excel) use ($herbariums, $view, $herbarium) {

            $excel->sheet($herbarium, function ($sheet) use ($herbariums, $view) {
                $sheet->freezeFirstRow()
//                    ->setAutoSize(array(
//                        'J'
//                    ))
//                    ->setWidth('J', 45)
                    ->loadView($view, compact('herbariums'));

            });

        })->export('xls');
    }
}
