<?php


namespace App\Controllers;


use T4\Core\MultiException;
use T4\Mvc\Controller;

class GenreEdit
    extends Controller
{
    public function actionNew()
    {

    }

    public function actionEdit($id)
    {
        $genre = \App\Models\Genre::findByPK($id);

        if (false === $genre) {

            $this->app->flash->message = 'Жанр не найден';
            $this->redirect('/admin/genre/editAll');
        }
        $this->data->genre = $genre;
    }

    public function actionSave($genre)
    {
        try {
            if (empty($genre['pk'])) {
                $obj = new \App\Models\Genre;

            } else {
                $obj = \App\Models\Genre::findByPK($genre['pk']);
            }
            $obj->fill($genre)
                ->save();
            $this->app->flash->message = 'Жанр успешно сохранен';
            $this->redirect('/admin/genre/editAll');

        } catch (MultiException $exc) {

            $this->data->errors = $exc;
            $this->data->genre = $genre;
        }
    }

    public function actionEditAll()
    {
        $this->data->genres = \App\Models\Genre::findAll();
    }

    public function actionDelete($id)
    {
        $genre = \App\Models\Genre::findByPK($id);

        if (false !== $genre) {

            $genre->delete();
            $this->app->flash->message = 'Жанр успешно удален';

        } else {

            $this->app->flash->message = 'Жанр не найден';
        }

        $this->redirect($_SERVER['HTTP_REFERER']);
    }

    protected function access($action, $params = [])
    {
        return !empty($this->app->user);
    }


}