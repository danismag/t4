<?php


namespace App\Models;


use T4\Orm\Model;

class UserSession extends Model
{
    public static $schema = [

        'table' => '__user_session',

        'columns' => [
            'hash' => ['type' => 'string']
        ],

        'relations' => [
            'user' => ['type' => self::BELONGS_TO, 'model' => User::class]
        ]
    ];

}