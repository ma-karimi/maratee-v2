<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\BaseDeleteAPIRequest;
use Illuminate\Container\Container as Application;
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
     *          description="class name (like plants)",
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
     *      @SWG\Items(type="string")
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
        $repo = 'App\\Repositories\\' . ucfirst(rtrim($class, 's') . 'Repository');
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
}
