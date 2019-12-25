<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\CreateArticleHubAPIRequest;
use App\Http\Requests\Api\UpdateArticleHubAPIRequest;
use App\Models\ArticleHub;
use App\Repositories\ArticleHubRepository;
use Exception;
use Illuminate\Http\Request;
use Response;

/**
 * Class ArticleHubController
 * @package App\Http\Controllers\Api
 */
class ArticleHubAPIController extends AppBaseController
{
    /** @var  ArticleHubRepository */
    private $articleHubRepository;

    public function __construct(ArticleHubRepository $articleHubRepo)
    {
        $this->articleHubRepository = $articleHubRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/article_hubs",
     *      summary="Get a listing of the ArticleHubs.",
     *      tags={"ArticleHub"},
     *      description="Get all ArticleHubs",
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
     *                  @SWG\Items(ref="#/definitions/ArticleHub")
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
        $articleHubs = $this->articleHubRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($articleHubs->toArray(), 'Article Hubs retrieved successfully');
    }

    /**
     * @param CreateArticleHubAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/article_hubs",
     *      summary="Store a newly created ArticleHub in storage",
     *      tags={"ArticleHub"},
     *      description="Store ArticleHub",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="article_id",
     *          in="body",
     *          description="ArticleHub that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/ArticleHub")
     *      ),
     *      @SWG\Parameter(
     *          name="user_id",
     *          in="body",
     *          description="ArticleHub that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/ArticleHub")
     *      ),
     *      @SWG\Parameter(
     *          name="action_id",
     *          in="body",
     *          description="ArticleHub that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ArticleHub")
     *      ),
     *      @SWG\Parameter(
     *          name="location_id",
     *          in="body",
     *          description="ArticleHub that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ArticleHub")
     *      ),
     *      @SWG\Parameter(
     *          name="date",
     *          in="body",
     *          description="ArticleHub that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ArticleHub")
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
     *                  ref="#/definitions/ArticleHub"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateArticleHubAPIRequest $request)
    {
        $input = $request->all();

        $articleHub = $this->articleHubRepository->create($input);

        return $this->sendResponse($articleHub->toArray(), 'Article Hub saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/article_hubs/{id}",
     *      summary="Display the specified ArticleHub",
     *      tags={"ArticleHub"},
     *      description="Get ArticleHub",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ArticleHub",
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
     *                  ref="#/definitions/ArticleHub"
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
        /** @var ArticleHub $articleHub */
        $articleHub = $this->articleHubRepository->find($id, \request()->get('relations'));

        if ($articleHub === null) {
            return $this->sendError('Article Hub not found');
        }

        return $this->sendResponse($articleHub->toArray(), 'Article Hub retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateArticleHubAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/article_hubs/{id}",
     *      summary="Update the specified ArticleHub in storage",
     *      tags={"ArticleHub"},
     *      description="Update ArticleHub",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ArticleHub",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="article_id",
     *          in="body",
     *          description="ArticleHub that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/ArticleHub")
     *      ),
     *      @SWG\Parameter(
     *          name="user_id",
     *          in="body",
     *          description="ArticleHub that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/ArticleHub")
     *      ),
     *      @SWG\Parameter(
     *          name="action_id",
     *          in="body",
     *          description="ArticleHub that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ArticleHub")
     *      ),
     *      @SWG\Parameter(
     *          name="location_id",
     *          in="body",
     *          description="ArticleHub that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ArticleHub")
     *      ),
     *      @SWG\Parameter(
     *          name="date",
     *          in="body",
     *          description="ArticleHub that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ArticleHub")
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
     *                  ref="#/definitions/ArticleHub"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateArticleHubAPIRequest $request)
    {
        $input = $request->all();

        /** @var ArticleHub $articleHub */
        $articleHub = $this->articleHubRepository->find($id, \request()->get('relations'));

        if ($articleHub === null) {
            return $this->sendError('Article Hub not found');
        }

        $articleHub = $this->articleHubRepository->update($input, $id);

        return $this->sendResponse($articleHub->toArray(), 'ArticleHub updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws Exception
     * @SWG\Delete(
     *      path="/article_hubs/{id}",
     *      summary="Remove the specified ArticleHub from storage",
     *      tags={"ArticleHub"},
     *      description="Delete ArticleHub",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ArticleHub",
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
        /** @var ArticleHub $articleHub */
        $articleHub = $this->articleHubRepository->find($id, \request()->get('relations'));

        if ($articleHub === null) {
            return $this->sendError('Article Hub not found');
        }

        $articleHub->delete();

        return $this->sendResponse($id, 'Article Hub deleted successfully');
    }
}
