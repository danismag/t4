<?php

namespace App\Components\Auth;


use App\Models\User;
use App\Models\UserSession;
use T4\Core\MultiException;
use T4\Http\Helpers;

class Identity
{
    const SEC_IN_MONTH = 30*24*60*60;
    const COOKIE_NAME = 'muslib_auth';

    public static function login($data)
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

        Helpers::setCookie(self::COOKIE_NAME, $hash, time() + self::SEC_IN_MONTH);
    }

    public static function logout()
    {
        if (Helpers::issetCookie(self::COOKIE_NAME)) {
            if (!empty($hash = Helpers::getCookie(self::COOKIE_NAME))) {

                Helpers::unsetCookie(self::COOKIE_NAME);

                $session = UserSession::findByHash($hash);

                if (!empty($session)) {

                    $session->delete();
                }
            }
        }
    }

    public function getUser()
    {
        if (Helpers::issetCookie(self::COOKIE_NAME)) {
            if (!empty($hash = Helpers::getCookie(self::COOKIE_NAME))) {
                if (!empty($session = UserSession::findByHash($hash))) {

                    return $session->user;
                }
                /* Если куки есть, а сессии нет */
                Helpers::unsetCookie(self::COOKIE_NAME);
            }
        }
        return null;
    }
}