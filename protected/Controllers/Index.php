<?php

namespace App\Controllers;

use App\Models\Genre;
use App\Models\Music;
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

    public function actionViewTrek($id)
    {
        $trek = Music::findByPK($id);

        if (false === $trek) {

            $this->app->flash->message = 'Трек не найден';
            $this->redirect('/');
        }
        $this->data->trek = $trek;
    }

    public function actionLastTrek()
    {
        //TODO Выбирать только последний или с наивысшим рейтингом
        $this->data->trek = Music::find();
    }


    

}