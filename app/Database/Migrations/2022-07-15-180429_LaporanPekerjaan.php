<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LaporanPekerjaan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_laporan'        => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true
            ],
            'no_employee'       => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
            ],
            'path' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'date' => [
                'type' => 'DATE',
            ],
        ]);
 
        // Membuat primary key
        $this->forge->addKey('id_laporan', TRUE);
        // $this->forge->addForeignKey('no_employee', 'user', 'no_employee'); 
        $this->forge->createTable('laporan_pekerjaan', TRUE);
    }
 
    public function down()
    {
        $this->forge->dropTable('laporan_pekerjaan');
    }
}
