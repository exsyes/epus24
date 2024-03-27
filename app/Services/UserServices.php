<?php

namespace App\Services;

interface UserServices
{
    public function doLogin($username, $password):bool;
}
