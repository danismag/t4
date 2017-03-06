<?php


namespace App\Models;


use T4\Orm\Model;

/**
 * Class UserSession
 * @package App\Models
 * @property string $hash
 * @property \App\Models\User $user
 * @method \App\Models\UserSession findByHash(string $hash)
 */
class UserSession extends Model
{
    public static $schema = [

        'table' => '__user_sessions',

        'columns' => [
            'hash' => ['type' => 'string']
        ],

        'relations' => [
            'user' => ['type' => self::BELONGS_TO, 'model' => User::class]
        ]
    ];

}