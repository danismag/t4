<?php


namespace App\Models;


use T4\Orm\Model;

class User extends Model
{
    public static $schema = [

        'table' => '__users',

        'columns' => [
            'email'     => ['type' => 'string'],
            'password'  => ['type' => 'string'],
            'name'      => ['type' => 'string', 'length' => 50]
        ],

        'relations' => [
            'session' => ['type' => self::HAS_ONE, 'model' => UserSession::class]
        ]
    ];

}