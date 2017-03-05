<?php


namespace App\Controllers;


use App\Components\Auth\Identity;
use App\Models\Genre;
use App\Models\Music;
use T4\Core\MultiException;
use T4\Mvc\Controller;

class Admin
    extends Controller
{
    public function actionDefault()
    {

    }

    public function actionLogin($login = null)
    {
        if (null !== $login) {

            try {
                $auth = new Identity;
                $auth->login($login);
                $this->redirect('/admin');

            } catch (MultiException $e) {

                $this->data->errors = $e;
            }
        }
    }

}