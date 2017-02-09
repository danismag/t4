<?php


namespace App\Controllers;


use App\Models\Genre;
use App\Models\Music;
use T4\Core\MultiException;
use T4\Mvc\Controller;

class Admin
    extends Controller
{
    public function actionDefault()
    {
        $trek = new Music;
        $genre = Genre::findByPK(1);
        $trek-> = $genre;
        var_dump($trek);

    }

}