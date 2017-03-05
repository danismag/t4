<?php


namespace App\Models;


use T4\Orm\Model;

/**
 * Class User
 * @package App\Models
 * @property string $email
 * @property string $password
 * @property string $name
 * @property \App\Models\UserSession $session
 */
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