<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 7/13/19
 * Time: 4:00 PM
 */

namespace App\Services;


use App\Models\Connection;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserServices
{
    /**
     * @param $request
     * @return mixed
     */
    public function create($request)
    {
        $request['password'] = Hash::make($request->password);
        return User::create($request->all());
    }

    /**
     * @param $nationalId
     * @param $email
     * @return mixed
     */
    public function findByNationalIdOrEmail($nationalId, $email)
    {
        return User::where('national_id', $nationalId)->orWhere('email', $email)->first();
    }


    /**
     * @param $user
     * @param $newPassword
     */
    public function updateUserWithNewPassword($user, $newPassword)
    {
        $user->password = Hash::make($newPassword);
        $user->save();
    }

    /**
     * @param $email
     * @return mixed
     */
    public function findByEmail($email)
    {
        return User::ofEmail($email)->first();
    }

    public function assignDepartmentAndLocation($userId,$request)
    {

        Validator::make($request->all(), [
            'department_id' => 'required',
            'location_id' => 'required',
        ],$messages=['location_id.required'=>'مکان الزامی است'])->validate();
        $connection = new Connection();
        $connection->user_id = $userId;
        $connection->department_id = $request->department_id;
        $connection->location_id = $request->location_id;
        $connection->save();
    }

}