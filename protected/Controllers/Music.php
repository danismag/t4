<?php


namespace App\Controllers;


use App\Models\Genre;
use App\Models\Performer;
use T4\Mvc\Controller;

class Music
    extends Controller
{
    public function actionNew()
    {
        $this->data->genres = Genre::findAll();
        $this->data->performers = Performer::findAll();
    }

    public function actionEditAll()
    {
        $this->data->treks = \App\Models\Music::findAll();
    }

    public function actionEdit($id)
    {
        $trek = \App\Models\Music::findByPK($id);

        if (false === $trek) {

            $this->app->flash->message = 'Трек не найден';
            $this->redirect('/music/editAll');
        }
        $this->data->trek = $trek;

    }

    public function actionSave($trek = null)
    {

    }

    public function actionDelete($id)
    {

    }

}