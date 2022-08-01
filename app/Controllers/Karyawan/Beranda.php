<?php

namespace App\Controllers\Karyawan;

use App\Models\PengajuanTugasKerjaModel;
use App\Libraries\Email as SendEmail;
use App\Controllers\BaseController;
use App\Models\UserModel;

class Beranda extends BaseController
{

    public function __construct()
    {
        helper(['my_helper']);
        $this->pengajuanTugas = new PengajuanTugasKerjaModel();
        $this->user = new UserModel();
    }

    public function index() //halaman beranda
    {
        $nama_pengajuan = $this->request->getGet('cari_nama');
        $tgl_pengajuan = $this->request->getGet('cari_tgl_pengajuan');
        $lokasi = $this->request->getGet('cari_lokasi');
        $pic = $this->request->getGet('cari_pic');
        $status = $this->request->getGet('cari_status');

        $data['list'] = $this->pengajuanTugas->listPengajuan($nama_pengajuan, $tgl_pengajuan, $lokasi, false, session('no_employee'), $status);

        // status pekerjaan
        $data['pengajuan_baru'] = $this->pengajuanTugas->countAllOrRow('pengajuan_baru', 'status', session('no_employee'));
        $data['dalam_pengerjaan'] = $this->pengajuanTugas->countAllOrRow('dalam_pengerjaan', 'status', session('no_employee'));
        $data['selesai'] = $this->pengajuanTugas->countAllOrRow('selesai', 'status', session('no_employee'));
        $data['user'] = $this->user->getUserJoinRole();

        return view('karyawan/beranda', $data);
    }
}
