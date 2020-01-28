<?php

namespace App\Repositories;

use App\Models\User;

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

    public function update($input, $id)
    {
        if (!request()->filled('password')) {
            unset($input['password']);
        }

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
