<?php


namespace App\Models;


use T4\Orm\Model;

class Image
    extends Model
{
    protected static $schema = [

        'columns' => [

            'path' => ['type' => 'string']
        ],
        'relations' => [

            'performer' => ['model' => Performer::class, 'type' => self::BELONGS_TO]
        ]
    ];

}