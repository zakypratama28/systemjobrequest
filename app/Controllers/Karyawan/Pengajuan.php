<?php

namespace App\Controllers\Karyawan;

use App\Controllers\BaseController;
use App\Models\PengajuanTugasKerjaModel;
use App\Libraries\Email as SendEmail;
use App\Controllers\Notifikasi;
use App\Models\UserModel;
use App\Models\RoleModel;

class Pengajuan extends BaseController
{
    public function __construct()
    {
        helper(['my_helper']);
        $this->pengajuanTugasKerjaModel = new PengajuanTugasKerjaModel();
        $this->notifikasiController = new Notifikasi();
        $this->userModel = new UserModel();
        $this->roleModel = new RoleModel();
    }

    public function nambah()
    {
        $upload = $this->request->getFile('photo');
        $fileNameUpload = $upload->getRandomName();
        if ($upload->isValid() && !$upload->hasMoved()) {
            // upload valid jika mau upload file
            // upload bergerak atau berpindah maka hasilnya false
            $upload->move(ROOTPATH . 'public/uploads/', $fileNameUpload);
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
        $pic = $this->request->getVar('pic');
        $data['ses_nama'] = session('nama');
        if ($this->request->getVar('pic') == session('no_employee')) {
            // jika pic nya diri sendiri maka kirim email diri sendiri dan notifikasi diri sendiri
            $user = $this->userModel->getUser(session('no_employee'), 'no_employee');
            SendEmail::send($user['email'], $user['email'], 'Reminder Job Request', $data);
            $this->notifikasiController->sendMessage('Anda telah berhasil menambahkan ' . $this->request->getVar('status'), session('no_employee'));
            $userAn = $this->userModel->getUserJoinRole();
            foreach ($userAn as $k) {
                if ($k['nama_role'] == $this->roleModel::ROLE_ADMIN) {
                    $this->notifikasiController->sendMessage('' . session('nama') . ' telah menambahkan pekerjaan berupa pengajuan baru', $k['no_employee']);
                }
            }
        } else {
            //sebaliknya pic bukan diri sendiri maka kirim email untuk orang pic dan notifikasi diri sendiri dan picnya
            $userKaryawan = $this->userModel->getUser(session('no_employee'), 'no_employee');
            $userAdmin = $this->userModel->getUser($pic, 'no_employee');
            SendEmail::send($userKaryawan['email'], $userAdmin['email'], 'Reminder Job Request', $data);
            $this->notifikasiController->sendMessage('Anda telah mengajukan pekerjaan', $userAdmin['no_employee']);
        }
        // SendEmail::send('zaky@gmail.com','kevin@gmail.com','Reminder Job Request',$data);
        // $this->notifikasiController->sendMessage('Data Pekerjaan dari Karyawan '.session('nama').' Pengajuan Baru');
        session()->setFlashdata('success_text', "Anda berhasil menambahkan pekerjaan baru");
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
            // upload valid jika mau upload file
            // upload bergerak atau berpindah maka hasilnya false
            $upload->move(ROOTPATH . 'public/uploads/', $fileNameUpload);
            $data['foto'] = $fileNameUpload;
        }
        $userAdmin = $this->userModel->getUserJoinRole();
        //kirim notifikasi untuk semua admin
        foreach ($userAdmin as $k) {
            if ($k['nama_role'] == $this->roleModel::ROLE_ADMIN) {
                $this->notifikasiController->sendMessage('Data Pekerjaan dari  ' . session('nama') . ' Telah diubah', $k['no_employee']);
            }
        }
        $this->notifikasiController->sendMessage('Anda telah mengubah status pekerjaan ', session('no_employee'));
        $this->pengajuanTugasKerjaModel->updatePengajuan($data, $id);
        session()->setFlashdata('success_text', "Anda berhasil mengubah data pekerjaan");
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
        $userAdmin = $this->userModel->getUserJoinRole();

        // jadi cari berdasarkan role admin
        // lalu kirim notifikasi untuk semua admin 
        foreach ($userAdmin as $k) { //foreach? as @k??
            if ($k['nama_role'] == $this->roleModel::ROLE_ADMIN) {
                $this->notifikasiController->sendMessage('Data Pekerjaan dari  ' . session('nama') . ' Telah dihapus', $k['no_employee']);
            }
        }
        $this->notifikasiController->sendMessage('Anda telah menghapus pekerjaan ', session('no_employee'));
        $this->pengajuanTugasKerjaModel->deletePengajuan($id);
        @unlink(ROOTPATH . 'public/uploads/' . $model['foto']);
        session()->setFlashdata('success_text', "Anda berhasil menghapus data pekerjaan");
        session()->setFlashdata('success_title', "Sukses");
        return redirect()->to(base_url('/karyawan/beranda'));
    }

    public function ubah_progress_status($status, $id)
    {

        $nama_pengajuan = $this->request->getGet('cari_nama');
        $tgl_pengajuan = $this->request->getGet('cari_tgl_pengajuan'); // cari berdasarkan tanggal pengajuan
        $lokasi = $this->request->getGet('cari_lokasi'); // cari berdasarkan lokasi terjadinya kerusakan
        $pic = $this->request->getGet('cari_pic'); //cari berdasarkan PIC
        $statusCari = $this->request->getGet('cari_status'); //cari berdasarkan status
        $list = $this->pengajuanTugasKerjaModel->listPengajuan($nama_pengajuan, $tgl_pengajuan, $lokasi, false, session('no_employee'), $statusCari);
        if (count($list) == 0) {
            //jika data yang di table kosong maka terjadinya error
            session()->setFlashdata('error_text', "Terjadi Kesalahan");
            session()->setFlashdata('error_title', "Error");
            return redirect()->to(base_url('/karyawan/beranda'));
        }
        if ($id == 'undefined') {
            $this->pengajuanTugasKerjaModel->ubahProgresStatus($status, $id);
        }
        $this->pengajuanTugasKerjaModel->ubahProgresStatus($status, $id);
        $userAdmin = $this->userModel->getUserJoinRole();
        foreach ($userAdmin as $k) { // jika karyawan mengubah status maka seluruh admin mengetahui nya di notifikasi ada yang mengubah status di pekerjaan
            if ($k['nama_role'] == $this->roleModel::ROLE_ADMIN) {
                $this->notifikasiController->sendMessage('Data Pekerjaan dari Karyawan ' . session('nama') . ' telah diubah menjadi' . $status, $k['no_employee']);
            }
        }
        $this->notifikasiController->sendMessage('Anda telah mengubah status pekerjaan menjadi ' . $status, session('no_employee'));
        session()->setFlashdata('success_text', "Anda berhasil mengubah status pekerjaan");
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
