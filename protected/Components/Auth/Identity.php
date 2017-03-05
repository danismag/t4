<?php

namespace App\Components\Auth;


use App\Models\User;
use App\Models\UserSession;
use T4\Core\MultiException;
use T4\Http\Helpers;

class Identity
{
    public function login($data)
    {
        $errors = new MultiException;
        if (empty($data->email)) {
            $errors->addException('Заполните email');
        }
        if (empty($data->password)) {
            $errors->addException('Заполните пароль');
        }
        if (!$errors->isEmpty()) {
            throw $errors;
        }

        $user = User::findByEmail($data->email);

        if (empty($user)) {
            $errors->addException('Email в базе не найден');
            throw $errors;
        }
        if (!password_verify($data->password, $user->password)) {
            $errors->addException('Неверный пароль');
            throw $errors;
        }

        $hash = hash('sha1', microtime() . mt_rand());
        $session = new UserSession;
        $session->hash = $hash;
        $session->user = $user;
        $session->save();

        Helpers::setCookie('muslibauth', $hash, time() + 30*24*3600);
    }

    public function getUser()
    {
        return User::getUserByPk(1);
    }
}