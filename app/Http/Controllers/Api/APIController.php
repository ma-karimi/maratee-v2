<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\CreateHubRequest;
use App\Http\Requests\Api\DeleteHubRequest;
use App\Http\Requests\BaseDeleteAPIRequest;
use App\Models\Contracts\Relationships;
use App\Services\Course\Backend\ExportUserCourse;
use Illuminate\Container\Container as Application;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Response;

/**
 * Class ActionController
 * @package App\Http\Controllers\Api
 */
class APIController extends AppBaseController
{
    use Relationships;

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
        $result = $repo->createHub($request->class_id, $request->relation, $request->ids, $request->except('class_id', 'relation', 'ids'));
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

    public function all($class)
    {
        $name = Str::singular(Str::studly($class));
        $repo = 'App\\Repositories\\' . $name . 'Repository';
        $repo = resolve($repo);
        $result = $repo->all()->load(Arr::flatten($repo->model()::getAllRelations()));
        if (\request()->filled('excel')) {
            $model = Str::ucfirst(\request('model'));
            $file = 'App\\Exports\\' . $model . 'Export';
            $file_excel = "Export${model}List-" . date('Y-m-d-H-i-s') . '.xlsx';
            Excel::store(new $file($result), 'public/' . $file_excel);
            return $this->sendResponse(Storage::url($file_excel), 'success');
        }
        return $this->sendResponse($result, $name . ' loaded successfully');
    }

    /**
     * @param int $id
     * @param null $delete
     * @return Response
     *
     * @throws Exception
     * @SWG\Delete(
     *      path="/{class}/{id}/{delete}",
     *      summary="Remove the specified Taxonomy from storage",
     *      tags={"Class"},
     *      description="Delete Taxonomy",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="class",
     *          description="Class",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Class",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="delete",
     *          description="",
     *          type="string",
     *          required=false,
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
    public function destroy($class, $id, $delete = null)
    {

        $name = Str::singular(Str::studly($class));
        $repo = 'App\\Repositories\\' . $name . 'Repository';
        $repo = resolve($repo);

        $result = $repo->find($id);

        $hasManyRelations = self::relationshipsWithType($result)['HasMany'];
        $result->load($hasManyRelations->toArray());
        if ($result === null) {
            return $this->sendError("${name} not found");
        }

        if($delete === null){
            $result = $result->loadCount($hasManyRelations->toArray());
            return $this->sendResponse($result, "${name} retrieved successfully");
        }

        if ($delete === 'delete') {
            $result->delete();
        }
        return $this->sendResponse($id, "${name} deleted successfully");
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/relations",
     *      summary="Get all RelationShips Of Given Classes.",
     *      tags={"Relation"},
     *      description="Get all RelationShips Of Given Classes",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="classes",
     *          description="class name like plants",
     *          type="array",
     *          required=true,
     *          in="path",
     *          @SWG\Items(
     *             type="string"
     *         )
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
    public function relations(Request $request)
    {
        $models = [];
        $classes = $request->classes;
//        foreach ($classes as $index => $class) {
//            $model='App\\Models\\'.ucfirst(rtrim($class,'s'));
//            $models[$class]= self::relationshipsText( $model);
//        }
        foreach ($classes as $index => $class) {
            $model = 'App\\Models\\' . Str::singular(Str::studly($class));
            $models[$class] = self::relationshipsWithType($model);
        }
        return $this->sendResponse($models, 'Relations retrieved successfully');
    }

}
