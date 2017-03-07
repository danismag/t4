<?php

namespace App\Controllers;

use App\Models\Genre;
use App\Models\Music;
use App\Models\Performer;
use T4\Mvc\Controller;

class Index
    extends Controller
{

    public function actionDefault()
    {

    }

    public function actionGenres()
    {
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
        $this->data->singers = Performer::findLast();
    }

    public function actionMusic($filter = null, $id = null)
    {
        $this->data->music = Music::findFiltered($filter, $id);
    }

    public function actionFilteredGenres()
    {
        $this->data->genres = Genre::findAll();
    }


}