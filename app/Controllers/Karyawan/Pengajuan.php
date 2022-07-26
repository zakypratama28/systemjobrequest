<?php

namespace App\Controllers\Karyawan;

use App\Controllers\BaseController;
use App\Models\PengajuanTugasKerjaModel;
use App\Libraries\Email as SendEmail;
use App\Controllers\Notifikasi;

class Pengajuan extends BaseController
{
    public function __construct()
    {
        helper(['my_helper']);
        $this->pengajuanTugasKerjaModel = new PengajuanTugasKerjaModel();
        $this->notifikasiController = new Notifikasi();
    }

    public function nambah()
    {
        $upload = $this->request->getFile('photo');
        $fileNameUpload = $upload->getRandomName();
        if ($upload->isValid() && !$upload->hasMoved()) {
            $upload->move(ROOTPATH.'public/uploads/', $fileNameUpload);
        }
        $data = [
            'no_employee' => session('no_employee'),
            'nama_pengajuan' => $this->request->getVar('nama'),
            'activity' => $this->request->getVar('aktivitas'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'lokasi' => $this->request->getVar('lokasi'),
            'penanggung_jawab' => $this->request->getVar('pic'),
            'tgl_pengajuan' => $this->request->getVar('tgl_pengajuan'),
            'tgl_rencana_selesai' => $this->request->getVar('tgl_rencana_selesai'),
            'tgl_actual_selesai' => $this->request->getVar('tgl_actual_selesai'),
            'foto' => $fileNameUpload,
            'status' => $this->request->getVar('status')
        ];
        $this->pengajuanTugasKerjaModel->savePengajuan($data);
        SendEmail::send('adam@gmail.com','kevin@gmail.com','Reminder Job Request',$data);
        $this->notifikasiController->sendMessage('Data Pekerjaan dari Karyawan '.session('nama').' Pengajuan Baru');
        session()->setFlashdata('success_text', "Permintaan anda telah dikirim");
        session()->setFlashdata('success_title', "Sukses");
        return redirect()->to(base_url('/karyawan/beranda'));
    }

    public function ubah($id)
    {
        $data['nama_pengajuan'] = $this->request->getVar('ubah_nama');
        $data['activity'] = $this->request->getVar('ubah_aktivitas');
        $data['deskripsi'] = $this->request->getVar('ubah_deskripsi');
        $data['lokasi'] = $this->request->getVar('ubah_lokasi');
        $data['penanggung_jawab'] = $this->request->getVar('ubah_pic');
        $data['tgl_pengajuan'] = $this->request->getVar('ubah_tgl_pengajuan');
        $data['tgl_rencana_selesai'] = $this->request->getVar('ubah_tgl_rencana_selesai');
        $data['tgl_actual_selesai'] = $this->request->getVar('ubah_tgl_actual_selesai');
        $data['status'] = $this->request->getVar('ubah_status');

        $upload = $this->request->getFile('ubah_photo');
        $fileNameUpload = $upload->getRandomName();
        if ($upload->isValid() && !$upload->hasMoved()) {
            $upload->move(ROOTPATH.'public/uploads/', $fileNameUpload);
            $data['foto'] = $fileNameUpload;
        }
        $this->notifikasiController->sendMessage('Data Pekerjaan dari Karyawan '.session('nama').' Telah diubah');
        $this->pengajuanTugasKerjaModel->updatePengajuan($data,$id);
        session()->setFlashdata('success_text', "Permintaan anda telah dikirim");
        session()->setFlashdata('success_title', "Sukses");
        return redirect()->to(base_url('/karyawan/beranda'));
    }

    public function hapus($id)
    {
        $model = $this->pengajuanTugasKerjaModel->getPengajuan($id);
        if (!$model) {
            session()->setFlashdata('error', "Data Tidak Ditemukan");
            return redirect()->to(base_url('/karyawan/beranda'));
        }
        $this->notifikasiController->sendMessage('Data Pekerjaan dari Karyawan '.session('nama').' Telah dihapus');
        $this->pengajuanTugasKerjaModel->deletePengajuan($id);
        @unlink(ROOTPATH.'public/uploads/'.$data['foto']);
        session()->setFlashdata('success_text', "Permintaan anda telah dikirim");
        session()->setFlashdata('success_title', "Sukses");
        return redirect()->to(base_url('/karyawan/beranda'));
    }

    public function ubah_progress_status($status,$id)
    {
        if($id == 'undefined'){
            $this->pengajuanTugasKerjaModel->ubahProgresStatus($status,$id);
        }
        $this->pengajuanTugasKerjaModel->ubahProgresStatus($status,$id);
        $this->notifikasiController->sendMessage('Data Pekerjaan dari Karyawan '.session('nama').' Telah '.$status);
        session()->setFlashdata('success_text', "Permintaan anda telah dikirim");
        session()->setFlashdata('success_title', "Sukses");
        return redirect()->to(base_url('/karyawan/beranda'));
    }

    // public function umpan_balik($id)
    // {
    //     $model = $this->pengajuanTugasKerjaModel->getUserPengajuan($id);
    //     if (!$model) {
    //         show_404();
    //     }
    //     $data['pengajuan'] = $model;
    //     return view('admin/umpan_balik',$data);
    // }

    // public function beri_umpan_balik($id)
    // {
    //     $umpan_balik = $this->request->getPost('umpan');
    //     $rating = $this->request->getPost('rating-input-1');
    //     $data = [
    //         'umpan_balik' => $umpan_balik,
    //         'rating' => $rating
    //     ];
    //     $this->pengajuanTugasKerjaModel->updatePengajuan($data,$id);
    //     session()->setFlashdata('success_text', "Permintaan anda telah dikirim");
    //     session()->setFlashdata('success_title', "Sukses");
    //     return redirect()->to(base_url('/admin/pengajuan/umpan_balik/'.$id));
    // }
}