<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_0000000001_User_Sessions
    extends Migration
{

    public function up()
    {
        $this->createTable('__users', [

            'email'     => ['type' => 'string'],
            'password'  => ['type' => 'string'],
            'name'      => ['type' => 'string', 'length' => 50]
        ], [
            'email_index' => ['type' => 'unique', 'columns' => ['email']]
        ]);

        $this->insert('__users', [
            'email'     => 'admin@muslib.my',
            'name'      => 'Администратор',
            'password'  => '$2y$10$MKBjxtYLhJT930moksymaeAjmGreuIEpjqQvjekdl0JdC8EFmzM3W'
        ]);

        $this->createTable('__user_sessions', [
            'hash' => ['type' => 'string'],
            '__user_id' => ['type' => 'link'],
        ], [
            'hash_index' => ['type' => 'unique', 'columns' => ['hash']],
            'user_index' => ['columns' => ['__user_id']],
        ]);
    }

    public function down()
    {
        $this->dropTable('__users');
        $this->dropTable('__user_sessions');
    }
    
}