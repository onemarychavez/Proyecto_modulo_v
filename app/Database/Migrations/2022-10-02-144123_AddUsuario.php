<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUsuario extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_usuario' => [
            'type' => 'INT',
            'constraint' => 128,
            'unsigned' => true,
            'auto_increment' => true
            ],
            'username' => [
            'type' => 'VARCHAR',
            'constraint' => '128',
            ],
            'password' => [
            'type' => 'VARCHAR',
            'constraint' => '128',
            ],
            'created_at' => [
            'type' => 'TIMESTAMP',
            'null' => true
            ],
            'updated_at' => [
            'type' => 'TIMESTAMP',
            'null' => true
            ],
        ]);
        $this->forge->addPrimaryKey('id_usuario');
        $this->forge->createTable('usuarios');
    }
  
    public function down()
    {
        $this->forge->dropTable('usuarios');
    }
}
