<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreatePermissionAPIRequest;
use App\Http\Requests\Api\UpdatePermissionAPIRequest;
use App\Models\Permission;
use App\Repositories\PermissionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PermissionController
 * @package App\Http\Controllers\Api
 */
class PermissionAPIController extends AppBaseController
{
    /** @var  PermissionRepository */
    private $permissionRepository;

    public function __construct(PermissionRepository $permissionRepo)
    {
        $this->permissionRepository = $permissionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/permissions",
     *      summary="Get a listing of the Permissions.",
     *      tags={"Permission"},
     *      description="Get all Permissions",
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
     *                  @SWG\Items(ref="#/definitions/Permission")
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
        $permissions = $this->permissionRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($permissions->toArray(), 'Permissions retrieved successfully');
    }

    /**
     * @param CreatePermissionAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/permissions",
     *      summary="Store a newly created Permission in storage",
     *      tags={"Permission"},
     *      description="Store Permission",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="user_id",
     *          in="body",
     *          description="Permission that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Permission")
     *      ),
     *      @SWG\Parameter(
     *          name="department_id",
     *          in="body",
     *          description="Permission that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Permission")
     *      ),
     *      @SWG\Parameter(
     *          name="group_id",
     *          in="body",
     *          description="Permission that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Permission")
     *      ),
     *      @SWG\Parameter(
     *          name="role_id",
     *          in="body",
     *          description="Permission that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Permission")
     *      ),
     *      @SWG\Parameter(
     *          name="requester_id",
     *          in="body",
     *          description="Permission that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Permission")
     *      ),
     *      @SWG\Parameter(
     *          name="responser_id",
     *          in="body",
     *          description="Permission that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Permission")
     *      ),
     *      @SWG\Parameter(
     *          name="permission_status",
     *          in="body",
     *          description="Permission that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Permission")
     *      ),
     *      @SWG\Parameter(
     *          name="request_date",
     *          in="body",
     *          description="Permission that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Permission")
     *      ),
     *      @SWG\Parameter(
     *          name="approval_date",
     *          in="body",
     *          description="Permission that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Permission")
     *      ),
     *      @SWG\Parameter(
     *          name="expire_date",
     *          in="body",
     *          description="Permission that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Permission")
     *      ),
     *      @SWG\Parameter(
     *          name="owner_crud",
     *          in="body",
     *          description="Permission that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Permission")
     *      ),
     *      @SWG\Parameter(
     *          name="same_level_crud",
     *          in="body",
     *          description="Permission that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Permission")
     *      ),
     *      @SWG\Parameter(
     *          name="upper_level_crud",
     *          in="body",
     *          description="Permission that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Permission")
     *      ),
     *      @SWG\Parameter(
     *          name="lower_level_crud",
     *          in="body",
     *          description="Permission that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Permission")
     *      ),
     *      @SWG\Parameter(
     *          name="organization_id",
     *          in="body",
     *          description="Group that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Group")
     *      ),
     *      @SWG\Parameter(
     *          name="division_id",
     *          in="body",
     *          description="Group that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Group")
     *      ),
     *      @SWG\Parameter(
     *          name="project_id",
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
     *                  ref="#/definitions/Permission"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePermissionAPIRequest $request)
    {
        $input = $request->all();

        $permission = $this->permissionRepository->create($input);

        return $this->sendResponse($permission->toArray(), 'Permission saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/permissions/{id}",
     *      summary="Display the specified Permission",
     *      tags={"Permission"},
     *      description="Get Permission",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Permission",
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
     *                  ref="#/definitions/Permission"
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
        /** @var Permission $permission */
        $permission = $this->permissionRepository->find($id, \request()->get('relations'));

        if (empty($permission)) {
            return $this->sendError('Permission not found');
        }

        return $this->sendResponse($permission->toArray(), 'Permission retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePermissionAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/permissions/{id}",
     *      summary="Update the specified Permission in storage",
     *      tags={"Permission"},
     *      description="Update Permission",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Permission",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="user_id",
     *          in="body",
     *          description="Permission that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Permission")
     *      ),
     *      @SWG\Parameter(
     *          name="department_id",
     *          in="body",
     *          description="Permission that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Permission")
     *      ),
     *      @SWG\Parameter(
     *          name="group_id",
     *          in="body",
     *          description="Permission that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Permission")
     *      ),
     *      @SWG\Parameter(
     *          name="role_id",
     *          in="body",
     *          description="Permission that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Permission")
     *      ),
     *      @SWG\Parameter(
     *          name="requester_id",
     *          in="body",
     *          description="Permission that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Permission")
     *      ),
     *      @SWG\Parameter(
     *          name="responser_id",
     *          in="body",
     *          description="Permission that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Permission")
     *      ),
     *      @SWG\Parameter(
     *          name="permission_status",
     *          in="body",
     *          description="Permission that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Permission")
     *      ),
     *      @SWG\Parameter(
     *          name="request_date",
     *          in="body",
     *          description="Permission that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Permission")
     *      ),
     *      @SWG\Parameter(
     *          name="approval_date",
     *          in="body",
     *          description="Permission that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Permission")
     *      ),
     *      @SWG\Parameter(
     *          name="expire_date",
     *          in="body",
     *          description="Permission that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Permission")
     *      ),
     *      @SWG\Parameter(
     *          name="owner_crud",
     *          in="body",
     *          description="Permission that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Permission")
     *      ),
     *      @SWG\Parameter(
     *          name="same_level_crud",
     *          in="body",
     *          description="Permission that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Permission")
     *      ),
     *      @SWG\Parameter(
     *          name="upper_level_crud",
     *          in="body",
     *          description="Permission that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Permission")
     *      ),
     *      @SWG\Parameter(
     *          name="lower_level_crud",
     *          in="body",
     *          description="Permission that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Permission")
     *      ),
     *      @SWG\Parameter(
     *          name="organization_id",
     *          in="body",
     *          description="Group that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Group")
     *      ),
     *      @SWG\Parameter(
     *          name="division_id",
     *          in="body",
     *          description="Group that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Group")
     *      ),
     *      @SWG\Parameter(
     *          name="project_id",
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
     *                  ref="#/definitions/Permission"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePermissionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Permission $permission */
        $permission = $this->permissionRepository->find($id, \request()->get('relations'));

        if (empty($permission)) {
            return $this->sendError('Permission not found');
        }

        $permission = $this->permissionRepository->update($input, $id);

        return $this->sendResponse($permission->toArray(), 'Permission updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/permissions/{id}",
     *      summary="Remove the specified Permission from storage",
     *      tags={"Permission"},
     *      description="Delete Permission",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Permission",
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
        /** @var Permission $permission */
        $permission = $this->permissionRepository->find($id, \request()->get('relations'));

        if (empty($permission)) {
            return $this->sendError('Permission not found');
        }

        $permission->delete();

        return $this->sendResponse($id, 'Permission deleted successfully');
    }
}
