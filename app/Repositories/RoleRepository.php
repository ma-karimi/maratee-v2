<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\RoleHasPermission;
use Illuminate\Support\Arr;

/**
 * Class RoleRepository
 * @package App\Repositories
 * @version October 9, 2019, 1:38 pm UTC
 */
class RoleRepository extends BaseRepository
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
        return Role::class;
    }

    public function create($input)
    {
        $role = parent::create(Arr::except($input, ['permissions']));

        $this->storePermission($input, $role->id);

        return $role;
    }

    public function update($input, $id)
    {
        $role = parent::update(Arr::except($input, ['permissions']), $id);

        $this->storePermission($input, $id);

        return $role;
    }

    public function storePermission($input, $id)
    {
        $permissions = $input['permissions'];
        RoleHasPermission::where('role_id', $id)
            ->whereNotIn('permission_id', $permissions)
            ->delete();


        if (!empty($permissions) && count($permissions)) {
            foreach ($permissions as $permission) {
                RoleHasPermission::firstOrCreate(
                    ['role_id' => $id, 'permission_id' => $permission]
                );
            }
        }
    }
}
