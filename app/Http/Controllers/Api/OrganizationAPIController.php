<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateOrganizationAPIRequest;
use App\Http\Requests\Api\UpdateOrganizationAPIRequest;
use App\Models\Organization;
use App\Repositories\OrganizationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class OrganizationController
 * @package App\Http\Controllers\Api
 */

class OrganizationAPIController extends AppBaseController
{
    /** @var  OrganizationRepository */
    private $organizationRepository;

    public function __construct(OrganizationRepository $organizationRepo)
    {
        $this->organizationRepository = $organizationRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/organizations",
     *      summary="Get a listing of the Organizations.",
     *      tags={"Organization"},
     *      description="Get all Organizations",
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
     *                  @SWG\Items(ref="#/definitions/Organization")
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
        $organizations = $this->organizationRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($organizations->toArray(), 'Organizations retrieved successfully');
    }

    /**
     * @param CreateOrganizationAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/organizations",
     *      summary="Store a newly created Organization in storage",
     *      tags={"Organization"},
     *      description="Store Organization",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="Organization that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Organization")
     *      ),
     *      @SWG\Parameter(
     *          name="phone",
     *          in="body",
     *          description="Organization that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Organization")
     *      ),
     *      @SWG\Parameter(
     *          name="domestic_code",
     *          in="body",
     *          description="Organization that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Organization")
     *      ),
     *      @SWG\Parameter(
     *          name="international_code",
     *          in="body",
     *          description="Organization that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Organization")
     *      ),
     *      @SWG\Parameter(
     *          name="is_herbarium",
     *          in="body",
     *          description="Organization that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Organization")
     *      ),
     *      @SWG\Parameter(
     *          name="email",
     *          in="body",
     *          description="Organization that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Organization")
     *      ),
     *      @SWG\Parameter(
     *          name="fax",
     *          in="body",
     *          description="Organization that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Organization")
     *      ),
     *      @SWG\Parameter(
     *          name="website",
     *          in="body",
     *          description="Organization that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Organization")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="Organization that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Organization")
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
     *                  ref="#/definitions/Organization"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateOrganizationAPIRequest $request)
    {
        $input = $request->all();

        $organization = $this->organizationRepository->create($input);

        return $this->sendResponse($organization->toArray(), 'Organization saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/organizations/{id}",
     *      summary="Display the specified Organization",
     *      tags={"Organization"},
     *      description="Get Organization",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Organization",
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
     *                  ref="#/definitions/Organization"
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
        /** @var Organization $organization */
        $organization = $this->organizationRepository->find($id, \request()->get('relations'));

        if (empty($organization)) {
            return $this->sendError('Organization not found');
        }

        return $this->sendResponse($organization->toArray(), 'Organization retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateOrganizationAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/organizations/{id}",
     *      summary="Update the specified Organization in storage",
     *      tags={"Organization"},
     *      description="Update Organization",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Organization",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="Organization that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Organization")
     *      ),
     *      @SWG\Parameter(
     *          name="phone",
     *          in="body",
     *          description="Organization that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Organization")
     *      ),
     *      @SWG\Parameter(
     *          name="domestic_code",
     *          in="body",
     *          description="Organization that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Organization")
     *      ),
     *      @SWG\Parameter(
     *          name="international_code",
     *          in="body",
     *          description="Organization that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Organization")
     *      ),
     *      @SWG\Parameter(
     *          name="is_herbarium",
     *          in="body",
     *          description="Organization that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Organization")
     *      ),
     *      @SWG\Parameter(
     *          name="email",
     *          in="body",
     *          description="Organization that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Organization")
     *      ),
     *      @SWG\Parameter(
     *          name="fax",
     *          in="body",
     *          description="Organization that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Organization")
     *      ),
     *      @SWG\Parameter(
     *          name="website",
     *          in="body",
     *          description="Organization that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Organization")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="Organization that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Organization")
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
     *                  ref="#/definitions/Organization"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateOrganizationAPIRequest $request)
    {
        $input = $request->all();

        /** @var Organization $organization */
        $organization = $this->organizationRepository->find($id, \request()->get('relations'));

        if (empty($organization)) {
            return $this->sendError('Organization not found');
        }

        $organization = $this->organizationRepository->update($input, $id);

        return $this->sendResponse($organization->toArray(), 'Organization updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/organizations/{id}",
     *      summary="Remove the specified Organization from storage",
     *      tags={"Organization"},
     *      description="Delete Organization",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Organization",
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
        /** @var Organization $organization */
        $organization = $this->organizationRepository->find($id, \request()->get('relations'));

        if (empty($organization)) {
            return $this->sendError('Organization not found');
        }

        $organization->delete();

        return $this->sendResponse($id, 'Organization deleted successfully');
    }
}
