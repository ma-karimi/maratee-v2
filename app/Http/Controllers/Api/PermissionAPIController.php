<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Repositories\PermissionRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
     * @throws Exception
     */
    public function index(Request $request)
    {
        $permissions = $this->permissionRepository->all();

        $permissions = $permissions->map(function ($data){
           $array['name'] = ucfirst(str_replace(':', ' ', $data['name']));
           $array['id'] = $data['id'];

           return $array;
        });

        return $this->sendResponse($permissions, 'Permissions retrieved successfully');
    }
}
