<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1486384985_PerformerTable
    extends Migration
{

    public function up()
    {
        $this->createTable('performers', [

            'name' => ['type' => 'string'],
            'bio' => ['type' => 'text'],
            'rating' => ['type' => 'int', 'default' => 0]
        ]);
    }

    public function down()
    {
        $this->dropTable('performers');
    }
    
}