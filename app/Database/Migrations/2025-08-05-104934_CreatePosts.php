<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePosts extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'auto_increment' => true],
            'title'       => ['type' => 'VARCHAR', 'constraint' => 255],
            'slug'        => ['type' => 'VARCHAR', 'constraint' => 255],
            'content'     => ['type' => 'TEXT'],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('posts');
    }


    public function down()
    {
        //
    }
}
