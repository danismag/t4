<?php

namespace App\Controllers;

use App\Models\Article;
use App\Models\News;
use App\Models\Newspaper;
use T4\Mvc\Controller;
use \T4\Core\Config;

class Index
    extends Controller
{

    public function actionDefault()
    {
        var_dump((new Newspaper)->findAll());
    }
    
    public function actionAbout()
    {
            
    }

}