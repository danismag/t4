<?php


namespace App\Models;


use T4\Fs\Helpers;
use T4\Orm\Model;

/**
 * Class Image
 * @package App\Models
 * @property string $path
 * @property \App\Models\Performer $performer
 */
class Image
    extends Model
{
    protected static $schema = [

        'table' => 'images',

        'columns' => [

            'path' => ['type' => 'string']
        ],
        'relations' => [

            'performer' => ['model' => Performer::class, 'type' => self::BELONGS_TO]
        ]
    ];

    public function afterDelete()
    {
        if($this->path){
            try {
                Helpers::removeFile(ROOT_PATH_PUBLIC.$this->path);
                $this->path='';
            }
            catch (\T4\Fs\Exception $e) {
            }
        }
        return parent::afterDelete();
    }

}