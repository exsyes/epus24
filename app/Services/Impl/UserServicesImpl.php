<?php

namespace App\Services\Impl;

use App\Models\User;
use App\Services\UserServices;
use Illuminate\Support\Facades\Hash;

class UserServicesImpl implements UserServices
{
    public function doLogin($username, $password):bool
    {
       $u = User::query()->where("username", $username)->first();
        if ($u == null){
            return false;
        }
       $check = Hash::check($password, $u->password);

       return $check;
    }

}
