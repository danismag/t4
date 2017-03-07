<?php

namespace App\Controllers;

use App\Models\Genre;
use T4\Mvc\Controller;

class Index
    extends Controller
{

    public function actionDefault()
    {

    }

    public function actionAllGenres()
    {
        //TODO Выводить только список из первых, например, 5 жанров
        $this->data->genres = Genre::findAll();
    }


    

}