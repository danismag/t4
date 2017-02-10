<?php


namespace App\Models;


use T4\Core\Collection;
use T4\Fs\Helpers;
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
            'rating' => ['type' => 'int'],
        ],
        'relations' => [

            'music' => ['model' => Music::class, 'type' => self::HAS_MANY],
            'images' => ['model' => Image::class, 'type' => self::HAS_MANY]
        ]
    ];

    public function uploadImages($formFieldName)
    {
        $request = Application::instance()->request;
        if (!$request->existsFilesData() || !$request->isUploadedArray($formFieldName)) {
            return $this;
        }
        $uploader = new Uploader($formFieldName);
        $uploader->setPath('/public/data/images');
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
                foreach ($this->images as $image) {
                    Helpers::removeFile(ROOT_PATH_PUBLIC . $image->path);
                }
                $this->images = new Collection();
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
                foreach ($this->music as $music) {
                    $music->delete();
                }
                $this->images = new Collection();
            } catch (\T4\Fs\Exception $e) {
                return false;
            }
        }
        return true;
    }

    public function beforeDelete()
    {
        $this->deleteMusic();
        $this->deleteImages();
        return parent::beforeDelete();
    }

}