<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1486384043_MusicTable
    extends Migration
{

    public function up()
    {
        $this->createTable('musics', [

            'title'         => ['type' => 'string'],
            'description'   => ['type' => 'text'],
            'year'          => ['type' => 'int'],
            'rating'         => ['type' => 'int', 'default' => 0],
            '__performer_id'     => ['type' => 'link'],
            '__genre_id'     => ['type' => 'link'],
        ]);
    }

    public function down()
    {
        $this->dropTable('musics');
    }
    
}