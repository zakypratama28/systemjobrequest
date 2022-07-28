<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PengajuanTugasKerjaModel;
use App\Libraries\Email as SendEmail;
use App\Controllers\Notifikasi;
use App\Models\UserModel;

class Pengajuan extends BaseController
{
    public function __construct()
    {
        helper(['my_helper']);
        $this->pengajuanTugasKerjaModel = new PengajuanTugasKerjaModel();
        $this->notifikasiController = new Notifikasi();
        $this->userModel = new UserModel();
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
            'tgl_actual_selesai' => NULL,
            'foto' => $fileNameUpload,
            'status' => $this->request->getVar('status')
        ];
        $this->pengajuanTugasKerjaModel->savePengajuan($data);
        $data['ses_nama'] = session('nama');
        $pic = $this->request->getVar('pic');
        if ($this->request->getVar('pic') == session('no_employee')) {
            $user = $this->userModel->getUser(session('no_employee'),'no_employee');
            SendEmail::send($user['email'],$user['email'],'Reminder Job Request',$data);
            $this->notifikasiController->sendMessage('Data Pekerjaan dari Anda '.$this->request->getVar('status'),session('no_employee'));
        } else {
            $userAdmin = $this->userModel->getUser(session('no_employee'),'no_employee');
            $userKaryawan = $this->userModel->getUser($pic,'no_employee');
            // var_dump($userKaryawan);
            SendEmail::send($userAdmin['email'],$userKaryawan['email'],'Reminder Job Request',$data);
            $this->notifikasiController->sendMessage('Anda Telah Mengajukan pekerjaan '.$this->request->getVar('status'),session('no_employee'));
            $this->notifikasiController->sendMessage('Leader telah mengajukan pekerjaan ke anda ',$userKaryawan['no_employee']);
        }
        
        session()->setFlashdata('success_text', "Permintaan anda telah dikirim");
        session()->setFlashdata('success_title', "Sukses");
        return redirect()->to(base_url('/admin/beranda'));
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
        // $pic = $this->request->getVar('pic');
        // if ($this->request->getVar('pic') == session('no_employee')) {
        //     $user = $this->userModel->getUser('no_employee',session('no_employee'));
        //     // SendEmail::send($user['email'],$user['email'],'Reminder Job Request',$data);
        //     $this->notifikasiController->sendMessage('Anda telah mengubah status pekerjaan anda',session('no_employee'));
        // } else {
        //     $userAdmin = $this->userModel->getUser('no_employee',session('no_employee'));
        //     $userKaryawan = $this->userModel->getUser('no_employee',$pic);
        //     // SendEmail::send($userAdmin['email'],$userKaryawan['email'],'Reminder Job Request',$data);
        //     $this->notifikasiController->sendMessage('Leader telah mengajukan pekerjaan ke anda ',$userKaryawan['email']);
        // }
        $this->notifikasiController->sendMessage('Anda telah mengubah status pekerjaan anda menjadi '.$this->request->getVar('ubah_status'),session('no_employee'));
        $this->pengajuanTugasKerjaModel->updatePengajuan($data,$id);
        session()->setFlashdata('success_text', "Permintaan anda telah dikirim");
        session()->setFlashdata('success_title', "Sukses");
        return redirect()->to(base_url('/admin/beranda'));
    }

    public function hapus($id)
    {
        $model = $this->pengajuanTugasKerjaModel->getPengajuan($id);
        if (!$model) {
            session()->setFlashdata('error', "Data Tidak Ditemukan");
            return redirect()->to(base_url('/admin/beranda'));
        }
        $this->notifikasiController->sendMessage('Data pengajuan pekerjaan anda telah dihapus',session('no_employee'));
        $this->pengajuanTugasKerjaModel->deletePengajuan($id);
        @unlink(ROOTPATH.'public/uploads/'.$data['foto']);
        session()->setFlashdata('success_text', "Permintaan anda telah dikirim");
        session()->setFlashdata('success_title', "Sukses");
        return redirect()->to(base_url('/admin/beranda'));
    }

    public function ubah_progress_status($status,$id)
    {
        $nama_pengajuan = $this->request->getGet('cari_nama');
        $tgl_pengajuan = $this->request->getGet('cari_tgl_pengajuan');
        $lokasi = $this->request->getGet('cari_lokasi');
        $pic = $this->request->getGet('cari_pic');
        $statusCari = $this->request->getGet('cari_status');
        $list = $this->pengajuanTugasKerjaModel->listPengajuan($nama_pengajuan,$tgl_pengajuan,$lokasi,false,$pic,$statusCari);
        if (count($list) == 0) {
            session()->setFlashdata('error_text', "Ada Kesalahan terjadi");
            session()->setFlashdata('error_title', "Error");
            return redirect()->to(base_url('/admin/beranda'));
        }
        if($id == 'undefined'){
            $this->pengajuanTugasKerjaModel->ubahProgresStatus($status,$id);
        }
        $this->pengajuanTugasKerjaModel->ubahProgresStatus($status,$id);
        $this->notifikasiController->sendMessage('Data pengajuan pekerjaan anda telah '.$status,session('no_employee'));
        session()->setFlashdata('success_text', "Permintaan anda telah dikirim");
        session()->setFlashdata('success_title', "Sukses");
        return redirect()->to(base_url('/admin/beranda'));
    }

    public function umpan_balik($id)
    {
        $model = $this->pengajuanTugasKerjaModel->getUserPengajuan($id);
        if (!$model) {
            show_404();
        }
        $data['pengajuan'] = $model;
        return view('admin/umpan_balik',$data);
    }

    public function beri_umpan_balik($id)
    {
        $umpan_balik = $this->request->getPost('umpan');
        $rating = $this->request->getPost('rating-input-1');
        $data = [
            'umpan_balik' => $umpan_balik,
            'rating' => $rating
        ];
        $this->pengajuanTugasKerjaModel->updatePengajuan($data,$id);
        session()->setFlashdata('success_text', "Permintaan anda telah dikirim");
        session()->setFlashdata('success_title', "Sukses");
        return redirect()->to(base_url('/admin/pengajuan/umpan_balik/'.$id));
    }
}