<?php


namespace App\Models;

use T4\Http\Uploader;
use T4\Mvc\Application;
use T4\Orm\Model;

/**
 * Class Performer
 * @package App\Models
 * @property string $name
 * @property string $bio
 * @property int $rating
 * @property \T4\Core\Collection $music
 * @property \T4\Core\Collection $images
 */
class Performer
    extends Model
{
    protected static $schema = [

        'columns' => [

            'name' => ['type' => 'string'],
            'bio' => ['type' => 'text'],
            'rating' => ['type' => 'int', 'default' => 0],
        ],
        'relations' => [

            'music' => ['model' => Music::class, 'type' => self::HAS_MANY],
            'images' => ['model' => Image::class, 'type' => self::HAS_MANY]
        ]
    ];

    public static function findLast($num = 3)
    {
        //TODO Переделать через запрос к БД без получения всех записей
        return self::findAll()->slice(-$num);
    }

    public function uploadImages($formFieldName)
    {
        $request = Application::instance()->request;
        if (!$request->existsFilesData() || !$request->isUploadedArray($formFieldName)) {
            return $this;
        }
        $uploader = new Uploader($formFieldName);
        $uploader->setPath('/data/images');
        foreach ($uploader() as $uploadedFilePath) {
            if (false !== $uploadedFilePath) {
                $this->images->append(new Image(['path' => $uploadedFilePath]));
            }
        }
        return $this;
    }

    public function deleteImages()
    {
        if (!empty($this->images)) {
            try {
                $this->images->delete();

            } catch (\T4\Fs\Exception $e) {
                return false;
            }
        }
        return true;
    }

    public function deleteMusic()
    {
        if (!empty($this->music)) {
            try {
                $this->music->delete();

            } catch (\T4\Fs\Exception $e) {
                return false;
            }
        }
        return true;
    }

    protected function beforeDelete()
    {
        $this->deleteMusic();
        $this->deleteImages();
        return parent::beforeDelete();
    }

    protected function validateName($name)
    {
        if (strlen(trim($name)) < 1) {
            yield new \Exception('Впишите имя исполнителя');
        }
        if (strlen(trim($name)) < 3) {
            yield new \Exception('Слишком короткое имя');
        }
        return true;
    }

    protected function validateBio($bio)
    {
        if (strlen(trim($bio)) < 3) {
            yield new \Exception('Слишком короткая биография');
        }
        return true;
    }

    protected function sanitizeName($name)
    {
        return trim($name);
    }

    protected function sanitizeBio($bio)
    {
        return trim($bio);
    }

}