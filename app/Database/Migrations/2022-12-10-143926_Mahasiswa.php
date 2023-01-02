<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Mahasiswa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nrp' => [
                'type' => 'CHAR',
                'constraint' => 9,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 250,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 250,
            ],
            'jurusan' => [
                'type' => 'VARCHAR',
                'constraint' => 64,
            ],
            'create_at datetime default current_timestamp',
            'update_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('mahasiswa');
    }

    public function down()
    {
        $this->forge->dropTable('mahasiswa');
    }
}
