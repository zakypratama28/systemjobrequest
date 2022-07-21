<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Role extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'role_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true
            ],
            'nama_role'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '20'
            ],

        ]);
 
        // Membuat primary key
        $this->forge->addKey('role_id', TRUE);
 
        $this->forge->createTable('role', TRUE);
    }
 
    public function down()
    {
        $this->forge->dropTable('role');
    }
}
