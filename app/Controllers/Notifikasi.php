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

    public function fetchAll()
    {
        $count = $this->notifikasiModel->countAllOrRow();
        $data['list'] = $this->notifikasiModel->all();
        return json_encode([
            $count,
            $data
        ]);
    }

    public function sendMessage($pesan,$no_employee)
    {
        $data = [
            'pesan' => $pesan,
            'no_employee' => $no_employee,
            'tanggal' => date('Y-m-d'),
        ];
        $this->notifikasiModel->saveNotifikasi($data);
    }

    public function readAll($id)
    {
        $data = [
            'aktif' => "baca"
        ];
        $this->notifikasiModel->update($id,$data);
    }
}
