<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PengajuanTugasKerja extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pengajuan'        => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true
            ],
            'no_employee'       => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
            ],
            'nama_pengajuan' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'activity' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'deskripsi' => [
                'type' => 'TEXT',
            ],
            'lokasi' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'penanggung_jawab' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'tgl_pengajuan' => [
                'type' => 'DATE',
            ],
            'tgl_rencana_selesai' => [
                'type' => 'DATE',
            ],
            'tgl_actual_selesai' => [
                'type' => 'DATE',
            ],
            'foto' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 20
            ]
        ]);
 
        // Membuat primary key
        $this->forge->addKey('id_pengajuan', TRUE);
        // $this->forge->addForeignKey('no_employee', 'user', 'no_employee'); 
        $this->forge->createTable('pengajuan_tugas_kerja', TRUE);
    }
 
    public function down()
    {
        $this->forge->dropTable('pengajuan_tugas_kerja');
    }
}
