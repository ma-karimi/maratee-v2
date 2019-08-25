<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateUserAPIRequest;
use App\Http\Requests\Api\UpdateUserAPIRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class UserController
 * @package App\Http\Controllers\Api
 */
class UserAPIController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/users",
     *      summary="Get a listing of the Users.",
     *      tags={"User"},
     *      description="Get all Users",
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
     *                  @SWG\Items(ref="#/definitions/User")
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
        $users = $this->userRepository->paginate(
            $request->get('per_page'),
            $request->except('per_page'),
            $request->get('relations')
        );

        return $this->sendResponse($users->toArray(), 'Users retrieved successfully');
    }

    /**
     * @param CreateUserAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/users",
     *      summary="Store a newly created User in storage",
     *      tags={"User"},
     *      description="Store User",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="title",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *       @SWG\Parameter(
     *          name="email",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="first_name",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="last_name",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="password",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="education",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="degree",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="national_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="birthday",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="nationality",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="passport_no",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="nickname",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="is_author",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="mobile",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="phone",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="work_experience",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
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
     *                  ref="#/definitions/User"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateUserAPIRequest $request)
    {
        $input = $request->all();

        $user = $this->userRepository->create($input);

        return $this->sendResponse($user->toArray(), 'User saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/users/{id}",
     *      summary="Display the specified User",
     *      tags={"User"},
     *      description="Get User",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of User",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *       @SWG\Parameter(
     *          name="title",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *       @SWG\Parameter(
     *          name="email",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="first_name",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="last_name",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="password",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="education",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="degree",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="national_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="birthday",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="nationality",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="passport_no",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="nickname",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="is_author",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="mobile",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="phone",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="work_experience",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
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
     *                  ref="#/definitions/User"
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
        /** @var User $user */
        $user = $this->userRepository->find($id, \request()->get('relations'));

        if ($user === null) {
            return $this->sendError('User not found');
        }

        return $this->sendResponse($user->toArray(), 'User retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateUserAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/users/{id}",
     *      summary="Update the specified User in storage",
     *      tags={"User"},
     *      description="Update User",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="title",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *       @SWG\Parameter(
     *          name="email",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="first_name",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="last_name",
     *          in="body",
     *          required=true,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="password",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="education",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="degree",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="national_id",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="birthday",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="nationality",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="passport_no",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="nickname",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="is_author",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="mobile",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="phone",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
     *      ),
     *      @SWG\Parameter(
     *          name="work_experience",
     *          in="body",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/User")
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
     *                  ref="#/definitions/User"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateUserAPIRequest $request)
    {
        $input = $request->all();

        /** @var User $user */
        $user = $this->userRepository->find($id, \request()->get('relations'));

        if ($user === null) {
            return $this->sendError('User not found');
        }

        $user = $this->userRepository->update($input, $id);

        return $this->sendResponse($user->toArray(), 'User updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @throws \Exception
     * @SWG\Delete(
     *      path="/users/{id}",
     *      summary="Remove the specified User from storage",
     *      tags={"User"},
     *      description="Delete User",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of User",
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
        /** @var User $user */
        $user = $this->userRepository->find($id, \request()->get('relations'));

        if ($user === null) {
            return $this->sendError('User not found');
        }

        $user->delete();

        return $this->sendResponse($id, 'User deleted successfully');
    }
}
