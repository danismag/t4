<?php


namespace App\Models;


use T4\Orm\Model;

class Performer
    extends Model
{
    protected static $schema = [

        'columns' => [

            'name'      => ['type' => 'string'],
            'text'      => ['type' => 'text'],
            'rating'    => ['type' => 'int'],
        ],
        'relations' => [

            'music' => ['model' => Music::class, 'type' => self::HAS_MANY],
            'images' => ['model' => Image::class, 'type' => self::HAS_MANY]
        ]
    ];

}