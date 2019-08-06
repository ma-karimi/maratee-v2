<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Models\Contracts\RelationshipsTrait;
use Illuminate\Http\Request;
use Response;

/**
 * Class ActionController
 * @package App\Http\Controllers\Api
 */

class HelpersAPIController extends AppBaseController
{
    use RelationshipsTrait;

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
        $models=[];
        $classes=$request->classes;
        foreach ($classes as $index => $class) {
            $model='App\\Models\\'.ucfirst(rtrim($class,'s'));
            $models[$class]= self::relationshipsText( $model);
        }
        return $this->sendResponse($models,'Relations retrieved successfully');
    }
}
