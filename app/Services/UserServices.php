<?php
/**
 * Created by PhpStorm.
 * User: alireza
 * Date: 7/13/19
 * Time: 4:00 PM
 */

namespace App\Services;


use App\Models\User;
use App\Utility;
use Illuminate\Support\Facades\Hash;

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


}