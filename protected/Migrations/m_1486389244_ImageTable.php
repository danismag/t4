<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1486389244_ImageTable
    extends Migration
{

    public function up()
    {
        $this->createTable('images', [

            'path' => ['type' => 'string'],
            '__performer_id' => ['type' => 'link']
        ]);
    }

    public function down()
    {
        $this->dropTable('images');
    }
    
}