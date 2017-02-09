<?php


namespace App\Models;


use T4\Orm\Model;

class Music
    extends Model
{
    protected static $schema = [

        'table' => 'music',

        'columns' => [

            'title' => ['type' => 'string'],
            'composer' => ['type' => 'string'],
            'rating' => ['type' => 'int'],
        ],
        'relations' => [

            'performer' => ['model' => Performer::class, 'type' => self::BELONGS_TO],
            'genre' => ['model' => Genre::class, 'type' => self::BELONGS_TO]
        ]
    ];

}