<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\CreateHubRequest;
use App\Http\Requests\Api\DeleteHubRequest;
use App\Http\Requests\Api\StoreHubRequest;
use App\Http\Requests\BaseDeleteAPIRequest;
use Illuminate\Container\Container as Application;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Response;

/**
 * Class ActionController
 * @package App\Http\Controllers\Api
 */
class APIController extends AppBaseController
{
    /**
     * @param BaseDeleteAPIRequest $request
     * @param $class
     * @return Response
     *
     * @SWG\Delete(
     *      path="/{class}/multiple_delete",
     *      summary="Remove Multiple Records of Given Class Model",
     *      tags={"API"},
     *      description="Remove Multiple Records",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="class",
     *          description="class name e.g. plants",
     *          type="string",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="ids",
     *          description="ids of model",
     *           type="array",
     *          required=true,
     *          in="path",
     *      @SWG\Items(type="integer")
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
    public function multipleDestroy(BaseDeleteAPIRequest $request, $class)
    {
        $repo = 'App\\Repositories\\' . Str::singular(Str::studly($class)) . 'Repository';
        $repo = new $repo(new Application());
        foreach ($request->ids as $id) {
            $record = $repo->find($id, \request()->get('relations'));
            if ($record === null) {
                return $this->sendError('Record not found');
            }
            $record->delete();
        }

        return $this->sendResponse($request->ids, 'Record(s) deleted successfully');
    }

    /**
     * @param CreateHubRequest $request
     * @param $class
     * @return Response
     *
     * @SWG\Post(
     *      path="/{class}/hub",
     *      summary="Store Related Models to a record",
     *      tags={"API"},
     *      description="Store Related Models to a record",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="class_id",
     *          description="id of record",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="relation",
     *          description="realtion name e.g. locations",
     *           type="string",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="ids",
     *          description="ids of related model",
     *           type="array",
     *          required=true,
     *          in="path",
     *      @SWG\Items(type="integer")
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
    public function storeHub(CreateHubRequest $request, $class)
    {
        $repo = 'App\\Repositories\\' . Str::singular(Str::studly($class)) . 'Repository';
        $repo = resolve($repo);
        $result = $repo->createHub($request->class_id, $request->relation, $request->ids);
        return $this->sendResponse($result, 'Record(s) added successfully');
    }

    /**
     * @param DeleteHubRequest $request
     * @param $class
     * @return Response
     *
     * @SWG\Delete(
     *      path="/{class}/hub",
     *      summary="Remove Related Models from a record",
     *      tags={"API"},
     *      description="Remove Related Models from a record",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="class_id",
     *          description="id of record",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="relation",
     *          description="realtion name e.g. locations",
     *           type="string",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="ids",
     *          description="ids of related model",
     *           type="array",
     *          required=true,
     *          in="path",
     *      @SWG\Items(type="integer")
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
    public function destroyHub(DeleteHubRequest $request, $class)
    {
        $repo = 'App\\Repositories\\' . Str::singular(Str::studly($class)) . 'Repository';
        $repo = resolve($repo);
        $result = $repo->deleteHub($request->class_id, $request->relation, $request->ids);
        return $this->sendResponse($result, 'Record(s) deleted successfully');
    }
    /**
     * @param $class
     * @return Response
     *
     * @SWG\Get(
     *      path="/{class}/constants",
     *      summary="Get Constants Of Given Class",
     *      tags={"API"},
     *      description="Get Constants Of Given Class",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="class",
     *          description="class name e.g herbariums",
     *          type="string",
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
    public function getConstants($class)
    {
        $repo = 'App\\Repositories\\' . Str::singular(Str::studly($class)) . 'Repository';
        $repo = resolve($repo);
        $result = $repo->getConstants($class);
        return $this->sendResponse($result, 'Constant(s) loaded successfully');
    }


}
