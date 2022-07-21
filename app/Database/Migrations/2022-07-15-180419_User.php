<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'no_employee'        => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
                'auto_increment' => true
            ],
            'role_id'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'department' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'jabatan' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'tahun_masuk' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'tahun_habis_kontrak' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
        ]);
 
        // Membuat primary key
        $this->forge->addKey('no_employee', TRUE);
        // $this->forge->addForeignKey('role_id', 'role', 'role_id'); 
        $this->forge->createTable('user', TRUE);
    }
 
    public function down()
    {
        $this->forge->dropTable('user');
    }
}
