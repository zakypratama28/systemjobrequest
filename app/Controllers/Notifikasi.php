<?php

namespace App\Controllers;

use App\Models\NotifikasiModel;
// use App\Libraries\Email as SendEmail;

class Notifikasi extends BaseController
{

    public function __construct()
    {
        $this->notifikasiModel = new NotifikasiModel();
    }

    public function fetchAll() // mengambil semua data yang data di table lalu munculkan di bagian notifikasi berdasarkan kolom aktif isi data nya belum
    {
        $count = $this->notifikasiModel->countAllOrRow();
        $data['list'] = $this->notifikasiModel->all();
        return json_encode([ // mengkonversikan data dari php ke json
            $count,
            $data
        ]);
    }

    public function sendMessage($pesan, $no_employee) // controler untuk notifikasi disistem
    {
        $data = [
            'pesan' => $pesan,
            'no_employee' => $no_employee,
            'tanggal' => date('Y-m-d'),
        ];
        $this->notifikasiModel->saveNotifikasi($data); // tabel untuk jika muncul notifikasi
    }

    public function readAll($id) // jika sudah dibaca maka pesan notif akan hilang
    {
        $data = [
            'aktif' => "baca" //jika aktif maka akan terbaca pesan notifnya
        ];
        $this->notifikasiModel->update($id, $data);
    }
}
