<?php

namespace App\Controllers;

use T4\Mvc\Controller;
use \T4\Core\Config;

class Index
    extends Controller
{

    public function actionDefault()
    {
        $this->app->assets->publishCssFile('/Assets/navbar.css');
        $this->app->assets->publishCssFile('/Assets/stickyfooter.css');

    }

    public function actionLogin()
    {
        $this->app->assets->publishCssFile('/Assets/signing.css');
    }
    

}