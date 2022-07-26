<?php

namespace App\Controllers\Karyawan;
use App\Models\PengajuanTugasKerjaModel;
use App\Libraries\Email as SendEmail;
use App\Controllers\BaseController;


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
        $data['list'] = $this->pengajuanTugas->listPengajuan($nama_pengajuan,$tgl_pengajuan,$lokasi,session('no_employee'));
        $data['pengajuan_baru'] = $this->pengajuanTugas->countAllOrRow('pengajuan_baru','status');
        $data['dalam_pengerjaan'] = $this->pengajuanTugas->countAllOrRow('dalam_pengerjaan','status');
        $data['selesai'] = $this->pengajuanTugas->countAllOrRow('selesai','status');
        return view('karyawan/beranda',$data);
    }
}
