<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateGroupAPIRequest;
use App\Http\Requests\Api\UpdateGroupAPIRequest;
use App\Models\Group;
use App\Repositories\GroupRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class GroupController
 * @package App\Http\Controllers\Api
 */

class GroupAPIController extends AppBaseController
{
    /** @var  GroupRepository */
    private $groupRepository;

    public function __construct(GroupRepository $groupRepo)
    {
        $this->groupRepository = $groupRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/groups",
     *      summary="Get a listing of the Groups.",
     *      tags={"Group"},
     *      description="Get all Groups",
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
     *                  @SWG\Items(ref="#/definitions/Group")
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
        $groups = $this->groupRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($groups->toArray(), 'Groups retrieved successfully');
    }

    /**
     * @param CreateGroupAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/groups",
     *      summary="Store a newly created Group in storage",
     *      tags={"Group"},
     *      description="Store Group",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="Group that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Group")
     *      ),
     *      @SWG\Parameter(
     *          name="owner_crud",
     *          in="body",
     *          description="Group that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Group")
     *      ),
     *      @SWG\Parameter(
     *          name="same_level_crud",
     *          in="body",
     *          description="Group that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Group")
     *      ),
     *      @SWG\Parameter(
     *          name="upper_level_crud",
     *          in="body",
     *          description="Group that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Group")
     *      ),
     *      @SWG\Parameter(
     *          name="lower_level_crud",
     *          in="body",
     *          description="Group that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Group")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="Group that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Group")
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
     *                  ref="#/definitions/Group"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateGroupAPIRequest $request)
    {
        $input = $request->all();

        $group = $this->groupRepository->create($input);

        return $this->sendResponse($group->toArray(), 'Group saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/groups/{id}",
     *      summary="Display the specified Group",
     *      tags={"Group"},
     *      description="Get Group",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Group",
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
     *                  ref="#/definitions/Group"
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
        /** @var Group $group */
        $group = $this->groupRepository->find($id);

        if (empty($group)) {
            return $this->sendError('Group not found');
        }

        return $this->sendResponse($group->toArray(), 'Group retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateGroupAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/groups/{id}",
     *      summary="Update the specified Group in storage",
     *      tags={"Group"},
     *      description="Update Group",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Group",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="name",
     *          in="body",
     *          description="Group that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Group")
     *      ),
     *      @SWG\Parameter(
     *          name="owner_crud",
     *          in="body",
     *          description="Group that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Group")
     *      ),
     *      @SWG\Parameter(
     *          name="same_level_crud",
     *          in="body",
     *          description="Group that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Group")
     *      ),
     *      @SWG\Parameter(
     *          name="upper_level_crud",
     *          in="body",
     *          description="Group that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Group")
     *      ),
     *      @SWG\Parameter(
     *          name="description",
     *          in="body",
     *          description="Group that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Group")
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
     *                  ref="#/definitions/Group"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateGroupAPIRequest $request)
    {
        $input = $request->all();

        /** @var Group $group */
        $group = $this->groupRepository->find($id);

        if (empty($group)) {
            return $this->sendError('Group not found');
        }

        $group = $this->groupRepository->update($input, $id);

        return $this->sendResponse($group->toArray(), 'Group updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/groups/{id}",
     *      summary="Remove the specified Group from storage",
     *      tags={"Group"},
     *      description="Delete Group",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Group",
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
        /** @var Group $group */
        $group = $this->groupRepository->find($id);

        if (empty($group)) {
            return $this->sendError('Group not found');
        }

        $group->delete();

        return $this->sendResponse($id, 'Group deleted successfully');
    }
}
