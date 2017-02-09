<?php


namespace App\Controllers;


use App\Models\Genre;
use T4\Core\MultiException;
use T4\Mvc\Controller;

class Admin
    extends Controller
{
    public function actionDefault()
    {

    }

    public function actionNewGenre()
    {

    }

    public function actionEditGenre($id)
    {
        $genre = Genre::findByPK($id);

        if (false === $genre) {

            $this->app->flash->message = 'Жанр не найден';
            $this->redirect('/admin/editAllGenres');
        }
        $this->data->genre = $genre;
    }

    public function actionSaveGenre($genre = null)
    {
        if (null !== $genre) {

            try {
                if (empty($genre['pk'])) {
                    $obj = new Genre;

                } else {
                    $obj = Genre::findByPK($genre['pk']);
                }
                    $obj
                        ->fill($genre)
                        ->save();
                $this->app->flash->message = 'Жанр успешно сохранен';
                $this->redirect('/admin/editAllGenres');

            } catch (MultiException $exc) {

                $this->data->errors = $exc;
                $this->data->genre = $obj;
            }
        }
    }

    public function actionEditAllGenres()
    {
        $this->data->genres = Genre::findAll();
    }

    public function actionDeleteGenre($id)
    {
        $genre = Genre::findByPK($id);

        if (false !== $genre) {

            $genre->delete();
            $this->app->flash->message = 'Жанр успешно удален';

        } else {

            $this->app->flash->message = 'Жанр не найден';
        }

        $this->redirect('/admin/editAllGenres');
    }

}