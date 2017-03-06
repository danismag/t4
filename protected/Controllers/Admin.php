<?php


namespace App\Controllers;


use App\Components\Auth\Identity;
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
                Identity::login($login);
                $this->redirect('/admin');

            } catch (MultiException $e) {

                $this->data->errors = $e;
            }
        }
    }

    public function actionLogout()
    {
        Identity::logout();
        $this->redirect('/');
    }

    protected function access($action, $params = [])
    {
        if ('Login' === $action) {
            return parent::access($action);
        }
        return !empty($this->app->user);
    }

}