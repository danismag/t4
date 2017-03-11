<?php


namespace App\Controllers;


use App\Models\Genre;
use App\Models\Performer;
use T4\Core\MultiException;
use T4\Mvc\Controller;

class MusicEdit
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
            $this->redirect('/admin/music/editAll');
        }
        $this->data->trek = $trek;
        $this->data->genres = Genre::findAll();
        $this->data->performers = Performer::findAll();
    }

    public function actionSave($trek, $genreId, $performerId)
    {
        try {
            if (empty($trek['pk'])) {

                $obj = new \App\Models\Music;

            } else {
                $obj = \App\Models\Music::findByPK($trek['pk']);
            }
            $obj->genre = Genre::findByPK($genreId);
            $obj->performer = Performer::findByPK($performerId);

            $obj->fill($trek)
                ->uploadTrek('musicFile')
                ->save();

            $this->app->flash->message = 'Композиция успешно сохранена';
            $this->redirect($_SERVER['HTTP_REFERER']);

        } catch (MultiException $e) {

            $this->data->errors = $e;
            $this->data->trek = $trek;
            $this->data->genres = Genre::findAll();
            $this->data->performers = Performer::findAll();
        }

    }

    public function actionDelete($id)
    {
        $music = \App\Models\Music::findByPK($id);

        if (false !== $music) {

            $music->delete();
            $this->app->flash->message = 'Музыкальная композиция успешно удалена';

        } else {

            $this->app->flash->message = 'Музыкальная композиция не найдена';
        }

        $this->redirect($_SERVER['HTTP_REFERER']);

    }

    protected function access($action, $params = [])
    {
        return !empty($this->app->user);
    }
}