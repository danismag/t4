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
        $this->data->trek = Music::findLast();
        $this->data->singers = Performer::findLast();
    }

    public function actionGenres()
    {
        $this->data->genres = Genre::findAll();
    }

    public function actionMusic($filter = null, $id = null)
    {
        $this->data->music = Music::findAllFiltered($filter, $id);
        $this->data->genres = Genre::findAll();
    }

    public function actionPerformers()
    {
        $this->data->singers = Performer::findAll();
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

    public function actionViewGenre($id)
    {
        $genre = Genre::findByPK($id);

        if (false === $genre) {

            $this->app->flash->message = 'Жанр не найден';
            $this->redirect('/');
        }
        $this->data->genre = $genre;
    }

    public function actionViewPerformer($id)
    {
        $singer = Performer::findByPK($id);

        if (false === $singer) {

            $this->app->flash->message = 'Исполнитель не найден';
            $this->redirect('/');
        }
        $this->data->singer = $singer;
    }



}