<?php

namespace App\Repositories;

use App\Models\ModelHasRole;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Arr;

/**
 * Class UserRepository
 * @package App\Repositories
 * @version July 14, 2019, 11:10 am UTC
 */
class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [

    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }

    public function create($input)
    {
        $user = parent::create(Arr::except($input, ['roles']));
        $this->createHub($user->id, 'roles', $input['roles'], ['created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);

        return $user;
    }

    public function update($input, $id)
    {
        if (!request()->filled('password')) {
            unset($input['password']);
        }

        $user = parent::update(Arr::except($input, ['roles']), $id);

//        $this->createHub($user->id, 'roles', $input['roles'], ['created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);

        $this->setRoles($user->id, $input['roles']);

        return $user;
    }

    private function setRoles($id, $roles)
    {

        ModelHasRole::where(['model_type' => User::class, 'model_id' => $id])
            ->whereNotIn('role_id', $roles)
            ->delete();

        if (!empty($roles) && count($roles)) {
            foreach ($roles as $role) {
                ModelHasRole::firstOrCreate(['model_type' => User::class, 'model_id' => $id, 'role_id' => $role]);
            }
        }
    }

    public function updateUser($input, $id)
    {
        if (!request()->filled('password')) {
            unset($input['password']);
        }
        unset($input['password_confirmation']);
        return parent::update($input, $id);
    }

    /**
     * Find the user instance for the given username.
     *
     * @param string $username
     * @return User
     */
    public function findForPassport($username)
    {
        $request = request()->all();
        if (strpos($request['username'], '@')) {
            return $this->model->where('email', $username)->firstOrFail();
        }

        return $this->model->where('national_id', $username)->firstOrFail();
    }
}
