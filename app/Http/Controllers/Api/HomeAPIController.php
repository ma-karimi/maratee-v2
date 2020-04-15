<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\Botanical\BotanicalAPIRequest;
use App\Http\Requests\Api\Botanical\BotanicalInformationAPIRequest;
use App\Http\Requests\Api\Botanical\BotanicalIrrigationAPIRequest;
use App\Http\Requests\Api\Botanical\BotanicalLocationAPIRequest;
use App\Http\Requests\Api\Botanical\BotanicalMediaAPIRequest;
use App\Http\Requests\Api\Botanical\BotanicalSoilAPIRequest;
use App\Models\Botanical;
use App\Repositories\BotanicalRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Response;

/**
 * Class HomeAPIController
 * @package App\Http\Controllers\Api
 */
class HomeAPIController extends AppBaseController
{

    public $classes= [
        ['name'=>'botanicals', 'repository'=>'BotanicalRepository'],
        ['name'=>'plants', 'repository'=>'PlantRepository'],
        ['name'=>'medicinal_properties', 'repository'=>'MedicinalPlantRepository'],
        ['name'=>'medicinal_applications', 'repository'=>'MedicinalApplicationRepository'],
        ['name'=>'natural_compounds', 'repository'=>'NaturalCompoundRepository'],
        ['name'=>'herbariums', 'repository'=>'HerbariumRepository'],

    ];

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/botanicals",
     *      summary="Get a listing of the Botanicals.",
     *      tags={"Botanical"},
     *      description="Get all Botanicals",
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
     *                  @SWG\Items(ref="#/definitions/Botanical")
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

        $botanicals = $this->botanicalRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $this->getRelationFields()
        );

        return $this->sendResponse($botanicals->toArray(), 'Botanicals retrieved successfully');
    }

    private function getRelationFields()
    {
        return ['distributions', 'protection:id,name', 'internalHabitats', 'gardens', 'origins', 'habitats', 'botanicalIrrigation', 'plantingConditions', 'propagations', 'usages', 'values', 'operations', 'media', 'taxonomy', 'locations', 'cycles', 'flowerColors', 'fruitColors', 'foliageColors', 'soil', 'summerTolerance', 'winterTolerance', 'seedGermination', 'seedRate', 'growthRate', 'wooden', 'soilTypes', 'collection'];
    }
}
