<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PengajuanTugasKerjaModel;
use App\Libraries\Email as SendEmail;

class Pengajuan extends BaseController
{
    public function __construct()
    {
        helper(['my_helper']);
        $this->pengajuanTugasKerjaModel = new PengajuanTugasKerjaModel();
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
        $this->pengajuanTugasKerjaModel->deletePengajuan($id);
        @unlink(ROOTPATH.'public/uploads/'.$data['foto']);
        session()->setFlashdata('success_text', "Permintaan anda telah dikirim");
        session()->setFlashdata('success_title', "Sukses");
        return redirect()->to(base_url('/admin/beranda'));
    }
}