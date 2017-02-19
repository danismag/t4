<?php


namespace App\Controllers;


use App\Models\Image;
use T4\Core\MultiException;
use T4\Mvc\Controller;

class Performer
    extends Controller
{
    public function actionNew()
    {

    }

    public function actionEdit($id)
    {
        $singer = \App\Models\Performer::findByPK($id);

        if (false === $singer) {

            $this->app->flash->message = 'Исполнитель не найден';
            $this->redirect('/performer/editAll');
        }
        $this->data->singer = $singer;
    }

    public function actionSave($singer)
    {
        try {
            if (empty($singer['pk'])) {
                $obj = new \App\Models\Performer;

            } else {
                $obj = \App\Models\Performer::findByPK($singer['pk']);
            }
            $obj->fill($singer)
                ->uploadImages('images')
                ->save();            
            $this->app->flash->message = 'Исполнитель успешно сохранен';
            $this->redirect($_SERVER['HTTP_REFERER']);

        } catch (MultiException $e) {

            $this->data->errors = $e;
            $this->data->singer = $singer;
        }
    }

    public function actionEditAll()
    {
        $this->data->singers = \App\Models\Performer::findAll();
    }

    public function actionDelete($id)
    {
        $singer = \App\Models\Performer::findByPK($id);

        if (false !== $singer) {

            $singer->delete();
            $this->app->flash->message = 'Исполнитель успешно удален';

        } else {

            $this->app->flash->message = 'Исполнитель не найден';
        }

        $this->redirect('/performer/editAll');
    }

    public function actionDeleteImage($id)
    {
        $image = Image::findByPK($id);

        if (false !== $image) {

            $image->delete();
            $this->app->flash->message = 'Фотография удалена';

        } else {

            $this->app->flash->message = 'Фотография не найдена';
        }

        $this->redirect($_SERVER['HTTP_REFERER']);
    }


}