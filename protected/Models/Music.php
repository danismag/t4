<?php


namespace App\Models;


use T4\Fs\Helpers;
use T4\Http\Uploader;
use T4\Mvc\Application;
use T4\Orm\Model;

/**
 * @property string $title
 * @property string $composer
 * @property string $path
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
            'path' => ['type' => 'string'],
            'rating' => ['type' => 'int', 'default' => 0],
        ],
        'relations' => [

            'performer' => ['model' => Performer::class, 'type' => self::BELONGS_TO],
            'genre' => ['model' => Genre::class, 'type' => self::BELONGS_TO]
        ]
    ];

    public static function findLast()
    {
        return self::find();

    }

    public function uploadTrek($formFieldName)
    {
        $request = Application::instance()->request;

        if (!$request->existsFilesData() || !$request->isUploaded($formFieldName)) {
            return $this;
        }

        try {
            $uploader = new Uploader($formFieldName);
            $uploader->setPath('/data/music');
            $file = $uploader();
            if ('' != $this->path) {
                $this->deleteTrek();
            }
            $this->path = $file;
        } catch (\Exception $e) {
            $this->path = '';
        }
        return $this;
    }

    public function deleteTrek()
    {
        if ($this->path) {
            try {

                Helpers::removeFile(ROOT_PATH_PUBLIC . $this->path);
                $this->path = '';

            } catch (\T4\Fs\Exception $e) {
                return false;
            }
        }
        return true;
    }

    protected function beforeDelete()
    {
        $this->deleteTrek();
        return parent::beforeDelete();
    }

    protected function validateTitle($title)
    {
        if (strlen(trim($title)) < 1) {
            yield new \Exception('Заполните название музыкальной композиции');
        }
        if (strlen(trim($title)) < 3) {
            yield new \Exception('Слишком короткое название');
        }
        return true;
    }

    protected function validateComposer($composer)
    {
        if (strlen(trim($composer)) < 1) {
            yield new \Exception('Впишите автора композиции');
        }
        return true;
    }

    protected function sanitizeTitle($title)
    {
        return trim($title);
    }

    protected function sanitizeComposer($composer)
    {
        return trim($composer);
    }

}