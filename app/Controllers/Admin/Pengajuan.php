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
        helper(['my_helper']); //jika data yang sama dipakai berulang2 cukup memanggil 1 kali saja,ada di helpers>my_helper
        $this->pengajuanTugasKerjaModel = new PengajuanTugasKerjaModel();
        $this->notifikasiController = new Notifikasi();
        $this->userModel = new UserModel();
    }

    public function nambah() //menambah data pekerjaan
    {
        $upload = $this->request->getFile('photo'); //upload foto di galeri dengan nama yg sama
        $fileNameUpload = $upload->getRandomName(); // membuat nama file acak
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
            'tgl_actual_selesai' => NULL,
            'foto' => $fileNameUpload,
            'status' => $this->request->getVar('status')
        ];
        $this->pengajuanTugasKerjaModel->savePengajuan($data);
        $data['ses_nama'] = session('nama');
        $pic = $this->request->getVar('pic');
        if ($this->request->getVar('pic') == session('no_employee')) {
            // jika pic nya diri sendiri maka kirim email diri sendiri dan notifikasi diri sendiri
            $user = $this->userModel->getUser(session('no_employee'), 'no_employee');
            SendEmail::send($user['email'], $user['email'], 'Reminder Job Request', $data); //jika pic dirinya sendiri maka akan terkirim ke email
            $this->notifikasiController->sendMessage('Data pekerjaan dari Anda berupa' . $this->request->getVar('status'), session('no_employee')); //jika pic dirinya sendiri maka akan terkirim ke notif di web
        } else {
            //sebaliknya pic bukan diri sendiri maka kirim email untuk orang pic dan notifikasi diri sendiri dan picnya
            $userAdmin = $this->userModel->getUser(session('no_employee'), 'no_employee');
            $userKaryawan = $this->userModel->getUser($pic, 'no_employee');
            // var_dump($userKaryawan);
            SendEmail::send($userAdmin['email'], $userKaryawan['email'], 'Reminder Job Request', $data); //terkirim ke user
            $this->notifikasiController->sendMessage('Anda telah mengajukan pekerjaan berupa ' . $this->request->getVar('status'), session('no_employee'));
            $this->notifikasiController->sendMessage('Leader telah mengajukan pekerjaan ke anda ', $userKaryawan['no_employee']); // notifikasi di role user
        }

        session()->setFlashdata('success_text', "Anda Berhasil Menambahkan Pekerjaan Baru");
        session()->setFlashdata('success_title', "Sukses");
        return redirect()->to(base_url('/admin/beranda'));
    }

    public function ubah($id) // mengubah data pekerjaan
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

        $upload = $this->request->getFile('ubah_photo'); // jika ingin mengganti foto dengan nama yang sama
        $fileNameUpload = $upload->getRandomName(); // dengan nama foto yang acak
        if ($upload->isValid() && !$upload->hasMoved()) {
            // upload valid jika mau upload file
            // upload bergerak atau berpindah maka hasilnya false
            $upload->move(ROOTPATH . 'public/uploads/', $fileNameUpload);
            $data['foto'] = $fileNameUpload;
        }
        //notifikasi jika terjadi perubahan data pekerjaan
        $this->notifikasiController->sendMessage('Anda telah mengubah status pekerjaan anda menjadi ' . $this->request->getVar('ubah_status'), session('no_employee'));
        $this->pengajuanTugasKerjaModel->updatePengajuan($data, $id);
        session()->setFlashdata('success_text', "Anda Berhasil Mengubah Data Pekerjaan");
        session()->setFlashdata('success_title', "Sukses"); //flash message= modal berisikan informasi sukses ketika menekan "ya" dan terjadi perubahan
        return redirect()->to(base_url('/admin/beranda'));
    }

    public function hapus($id) //menghapus data pekejraan untuk role admin
    {
        $model = $this->pengajuanTugasKerjaModel->getPengajuan($id);
        if (!$model) {
            session()->setFlashdata('error', "Data Tidak Ditemukan");
            return redirect()->to(base_url('/admin/beranda'));
        }
        $this->notifikasiController->sendMessage('Data pengajuan pekerjaan anda telah dihapus', session('no_employee')); //notif jika data di hapus
        $this->pengajuanTugasKerjaModel->deletePengajuan($id);
        @unlink(ROOTPATH . 'public/uploads/' . $model['foto']); //unlink menghapus file foto di folder rootpath supaya folder upload tidak penuh
        session()->setFlashdata('success_text', "Anda Berhasil Menghapus Data");
        session()->setFlashdata('success_title', "Sukses");
        return redirect()->to(base_url('/admin/beranda'));
    }

    public function ubah_progress_status($status, $id)
    {
        // mencari data pekerjaan berdasarkan
        $nama_pengajuan = $this->request->getGet('cari_nama');
        $tgl_pengajuan = $this->request->getGet('cari_tgl_pengajuan');
        $lokasi = $this->request->getGet('cari_lokasi');
        $pic = $this->request->getGet('cari_pic');
        $statusCari = $this->request->getGet('cari_status');
        $list = $this->pengajuanTugasKerjaModel->listPengajuan($nama_pengajuan, $tgl_pengajuan, $lokasi, false, $pic, $statusCari);
        if (count($list) == 0) {
            session()->setFlashdata('error_text', "Terjadi Kesalahan");
            session()->setFlashdata('error_title', "Error");
            return redirect()->to(base_url('/admin/beranda'));
        }
        // mengubah status di halaman beranda
        if ($id == 'undefined') {
            $this->pengajuanTugasKerjaModel->ubahProgresStatus($status, $id);
        }
        //pesan yang muncul di notifikasi website ketika mengubah status
        $this->pengajuanTugasKerjaModel->ubahProgresStatus($status, $id);
        $this->notifikasiController->sendMessage('pekerjaan anda telah diubah menjadi ' . $status, session('no_employee'));
        session()->setFlashdata('success_text', "Anda Berhasil Mengubah Status");
        session()->setFlashdata('success_title', "Sukses");
        return redirect()->to(base_url('/admin/beranda'));
    }

    public function umpan_balik($id) // function untuk umpan balik
    // dilakukan oleh admin
    {
        $model = $this->pengajuanTugasKerjaModel->getUserPengajuan($id);
        if (!$model) { // jika data tidak ditemukan maka menampilkan halaman 404
            // show_404();
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data['pengajuan'] = $model;
        return view('admin/umpan_balik', $data);
    }

    public function beri_umpan_balik($id)
    // dilakukan oleh admin
    {
        $umpan_balik = $this->request->getPost('umpan'); // memberikan komentar terkait pekerjaan
        $rating = $this->request->getPost('rating-input-1'); // beri penilaian kinerja ke karyawan
        $data = [
            'umpan_balik' => $umpan_balik,
            'rating' => $rating
        ];
        $this->pengajuanTugasKerjaModel->updatePengajuan($data, $id);
        // showswal modal berhasil memberikan umpan balik dan penilaian kinerja
        session()->setFlashdata('success_text', "Anda Telah Memberikan Umpan Balik");
        session()->setFlashdata('success_title', "Sukses");
        return redirect()->to(base_url('/admin/pengajuan/umpan_balik/' . $id));
    }
}
