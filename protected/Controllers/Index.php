<?php

namespace App\Controllers;

use App\Models\Genre;
use App\Models\Music;
use App\Models\Performer;
use T4\Dbal\QueryBuilder;
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
        $this->data->trek = Music::findLast();
    }

    public function actionLastSingers()
    {
//        var_dump(Performer::findLast());
        $this->data->singers = Performer::findLast();
    }
    

}