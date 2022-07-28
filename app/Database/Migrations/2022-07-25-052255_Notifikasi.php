<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Notifikasi extends Migration
{

    public function up()
    {
        $this->forge->addField([
            'id_notifikasi'        => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true
            ],
            'pesan'       => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
                'default'        => NULL
            ],
            'no_employee' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
                // 'unsigned'       => true,
            ],
            'tanggal'  => [
                'type' => 'DATE',
                'default' => NULL
            ],
            'aktif' => [
                'type' => "ENUM('baca','belum')",
                'default' => 'belum'
            ]
        ]);

        // Membuat primary key
        $this->forge->addKey('id_notifikasi', TRUE);
        $this->forge->addForeignKey('no_employee', 'user', 'no_employee');
        $this->forge->createTable('notifikasi', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('notifikasi');
    }
}
