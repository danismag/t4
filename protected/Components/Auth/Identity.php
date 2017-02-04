<?php

namespace App\Components\Auth;


use T4\Http\Helpers;

class Identity
{

    public function getUser()
    {
        return User::getUserByPk(1);
    }
}