<?php


namespace App\Models;


use T4\Orm\Model;

class Genre
    extends Model
{
    protected static $schema = [

        'columns' => [

            'title' => ['type' => 'string'],
            'description' => ['type' => 'text']
        ],
        'relations' => [

            'music' => ['model' => Music::class, 'type' => self::HAS_MANY]
        ]
    ];

}