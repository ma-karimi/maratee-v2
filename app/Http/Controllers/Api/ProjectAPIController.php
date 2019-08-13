<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateProjectAPIRequest;
use App\Http\Requests\Api\UpdateProjectAPIRequest;
use App\Models\Project;
use App\Repositories\ProjectRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ProjectController
 * @package App\Http\Controllers\Api
 */

class ProjectAPIController extends AppBaseController
{
    /** @var  ProjectRepository */
    private $projectRepository;

    public function __construct(ProjectRepository $projectRepo)
    {
        $this->projectRepository = $projectRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/projects",
     *      summary="Get a listing of the Projects.",
     *      tags={"Project"},
     *      description="Get all Projects",
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
     *                  @SWG\Items(ref="#/definitions/Project")
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
        $projects = $this->projectRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($projects->toArray(), 'Projects retrieved successfully');
    }

    /**
     * @param CreateProjectAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/projects",
     *      summary="Store a newly created Project in storage",
     *      tags={"Project"},
     *      description="Store Project",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="title",
     *          in="body",
     *          description="Project that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Project")
     *      ),
     *      @SWG\Parameter(
     *          name="project_leader_id",
     *          in="body",
     *          description="Project that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Project")
     *      ),
     *      @SWG\Parameter(
     *          name="research_leader_id",
     *          in="body",
     *          description="Project that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Project")
     *      ),
     *      @SWG\Parameter(
     *          name="research_title",
     *          in="body",
     *          description="Project that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Project")
     *      ),
     *      @SWG\Parameter(
     *          name="project_no",
     *          in="body",
     *          description="Project that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Project")
     *      ),
     *      @SWG\Parameter(
     *          name="research_no",
     *          in="body",
     *          description="Project that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Project")
     *      ),
     *      @SWG\Parameter(
     *          name="project_leader",
     *          in="body",
     *          description="Project that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Project")
     *      ),
     *      @SWG\Parameter(
     *          name="plan_id",
     *          in="body",
     *          description="Project that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Project")
     *      ),
     *      @SWG\Parameter(
     *          name="research_leader",
     *          in="body",
     *          description="Project that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Project")
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
     *                  ref="#/definitions/Project"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateProjectAPIRequest $request)
    {
        $input = $request->all();

        $project = $this->projectRepository->create($input);

        return $this->sendResponse($project->toArray(), 'Project saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/projects/{id}",
     *      summary="Display the specified Project",
     *      tags={"Project"},
     *      description="Get Project",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Project",
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
     *                  ref="#/definitions/Project"
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
        /** @var Project $project */
        $project = $this->projectRepository->find($id, \request()->get('relations'));

        if (empty($project)) {
            return $this->sendError('Project not found');
        }

        return $this->sendResponse($project->toArray(), 'Project retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateProjectAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/projects/{id}",
     *      summary="Update the specified Project in storage",
     *      tags={"Project"},
     *      description="Update Project",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Project",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="title",
     *          in="body",
     *          description="Project that should be stored",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/Project")
     *      ),
     *      @SWG\Parameter(
     *          name="project_leader_id",
     *          in="body",
     *          description="Project that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Project")
     *      ),
     *      @SWG\Parameter(
     *          name="research_leader_id",
     *          in="body",
     *          description="Project that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Project")
     *      ),
     *      @SWG\Parameter(
     *          name="research_title",
     *          in="body",
     *          description="Project that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Project")
     *      ),
     *      @SWG\Parameter(
     *          name="project_no",
     *          in="body",
     *          description="Project that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Project")
     *      ),
     *      @SWG\Parameter(
     *          name="research_no",
     *          in="body",
     *          description="Project that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Project")
     *      ),
     *      @SWG\Parameter(
     *          name="plan_id",
     *          in="body",
     *          description="Project that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Project")
     *      ),
     *      @SWG\Parameter(
     *          name="project_leader",
     *          in="body",
     *          description="Project that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Project")
     *      ),
     *      @SWG\Parameter(
     *          name="research_leader",
     *          in="body",
     *          description="Project that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Project")
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
     *                  ref="#/definitions/Project"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateProjectAPIRequest $request)
    {
        $input = $request->all();

        /** @var Project $project */
        $project = $this->projectRepository->find($id, \request()->get('relations'));

        if (empty($project)) {
            return $this->sendError('Project not found');
        }

        $project = $this->projectRepository->update($input, $id);

        return $this->sendResponse($project->toArray(), 'Project updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/projects/{id}",
     *      summary="Remove the specified Project from storage",
     *      tags={"Project"},
     *      description="Delete Project",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Project",
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
        /** @var Project $project */
        $project = $this->projectRepository->find($id, \request()->get('relations'));

        if (empty($project)) {
            return $this->sendError('Project not found');
        }

        $project->delete();

        return $this->sendResponse($id, 'Project deleted successfully');
    }
}
