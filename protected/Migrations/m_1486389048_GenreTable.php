<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1486389048_GenreTable
    extends Migration
{

    public function up()
    {
        $this->createTable('genres', [

            'title' => ['type' => 'string'],
            'description' => ['type' => 'text']
        ]);

        $this->addIndex('genres', [
            'title' => ['type' => 'unique']
        ]);
    }

    public function down()
    {
        $this->dropTable('genres');
    }
    
}