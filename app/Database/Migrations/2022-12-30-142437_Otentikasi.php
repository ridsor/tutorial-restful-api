<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Otentikasi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 15,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 250,
                'unique' => true,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 250,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('otentikasi');
    }
    
    public function down()
    {
        $this->forge->dropTable('otentikasi');
    }
}
