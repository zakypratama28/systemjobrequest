<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PengajuanTugasKerjaModel;
use App\Libraries\Email as SendEmail;

class Beranda extends BaseController
{
    public function __construct()
    {
        helper(['my_helper']);
        $this->pengajuanTugas = new PengajuanTugasKerjaModel();
    }

    public function index()
    {
        $nama_pengajuan = $this->request->getGet('cari_nama');
        $tgl_pengajuan = $this->request->getGet('cari_tgl_pengajuan');
        $lokasi = $this->request->getGet('cari_lokasi');
        $data['list'] = $this->pengajuanTugas->listPengajuan($nama_pengajuan,$tgl_pengajuan,$lokasi);
        // SendEmail::send('adam@gmail.com','kevin@gmail.com','Reminder Job Request',$data);
        return view('admin/beranda',$data);
    }
}
