<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\DistributionHubAPIRequest;
use App\Repositories\DistributionHubRepository;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class DistributionHubController
 * @package App\Http\Controllers\Api
 */

class DistributionHubAPIController extends AppBaseController
{
    /** @var  DistributionHubRepository */
    private $distributionHubRepository;

    public function __construct(DistributionHubRepository $distributionHubRepo)
    {
        $this->distributionHubRepository = $distributionHubRepo;
    }

    /**
     * @param $distributable_id
     * @param DistributionHubAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/distribution_hubs/{distributable_id}",
     *      summary="Store a newly created DistributionHub in storage",
     *      tags={"DistributionHub"},
     *      description="Store DistributionHub",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="geographical_ids",
     *          in="body",
     *          description="array",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/DistributionHub")
     *      ),
     *      @SWG\Parameter(
     *          name="distributable_type",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/DistributionHub")
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
     *                  ref="#/definitions/DistributionHub"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store($distributable_id, DistributionHubAPIRequest $request)
    {
        $input = $request->all();

        $this->distributionHubRepository->store($input, $distributable_id);

        return $this->sendResponse([], 'DistributionHub saved successfully');
    }
}
