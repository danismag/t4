<?php


namespace App\Models;


use T4\Fs\Helpers;
use T4\Http\Uploader;
use T4\Mvc\Application;
use T4\Orm\Model;

/**
 * @property string $title
 * @property string $composer
 * @property string $trek
 * @property int $rating
 * @property \App\Models\Performer $performer
 * @property \App\Models\Genre $genre
 */
class Music
    extends Model
{
    protected static $schema = [

        'table' => 'music',

        'columns' => [

            'title' => ['type' => 'string'],
            'composer' => ['type' => 'string'],
            'trek' => ['type' => 'string'],
            'rating' => ['type' => 'int'],
        ],
        'relations' => [

            'performer' => ['model' => Performer::class, 'type' => self::BELONGS_TO],
            'genre' => ['model' => Genre::class, 'type' => self::BELONGS_TO]
        ]
    ];

    public function uploadTrek($formFieldName)
    {
        $request = Application::instance()->request;
        if (!$request->existsFilesData() || !$request->isUploaded($formFieldName))
            return $this;
        try {
            $uploader = new Uploader($formFieldName);
            $uploader->setPath('/public/data/music');
            $file = $uploader();
            if ($this->trek) {
                $this->deleteTrek();
            }
            $this->trek = $file;
        } catch (\Exception $e) {
            $this->trek = null;

        }
        return $this;
    }

    public function deleteTrek()
    {
        if ($this->trek) {
            try {
                $this->trek = '';
                Helpers::removeFile(ROOT_PATH_PUBLIC . $this->trek);
            } catch (\T4\Fs\Exception $e) {
                return false;
            }
        }
        return true;
    }

    public function beforeDelete()
    {
        $this->deleteTrek();
        return parent::beforeDelete();
    }

}