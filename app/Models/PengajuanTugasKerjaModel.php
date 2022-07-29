<?php

namespace App\Models;

use CodeIgniter\Model;

class PengajuanTugasKerjaModel extends Model
{
    protected $table = 'pengajuan_tugas_kerja';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'no_employee',
        'nama_pengajuan',
        'activity',
        'deskripsi',
        'lokasi',
        'penanggung_jawab',
        'tgl_pengajuan',
        'tgl_rencana_selesai',
        'tgl_actual_selesai',
        'foto',
        'status',
        'umpan_balik',
        'rating'
    ];
    protected $primaryKey = 'id_pengajuan';

    public function getPengajuan($id = false)
    {
        if ($id) {
            return $this->where($this->primaryKey, $id)
                ->first();
        } else {
            return $this->findAll();
        }
    }

    public function savePengajuan($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function updatePengajuan($data, $id)
    {
        $builder = $this->db->table($this->table);
        return $builder->where($this->primaryKey, $id)->update($data);
    }

    public function deletePengajuan($id)
    {
        $builder = $this->db->table($this->table);
        return $builder->where($this->primaryKey, $id)->delete();
    }

    public function listPengajuan($name, $tgl, $lokasi, $no_employee = false, $pic = false, $status = false)
    {
        $builder = $this->db->table($this->table);
        $builder->select('*,pengajuan_tugas_kerja.status as status_tugas');
        $builder->join('user', 'user.no_employee =  pengajuan_tugas_kerja.penanggung_jawab');
        if (isset($name) && $name != '') {
            $builder->like('pengajuan_tugas_kerja.nama_pengajuan', $name);
        }
        if (isset($tgl) && $tgl != '') {
            $builder->orLike('pengajuan_tugas_kerja.tgl_pengajuan', $tgl);
        }
        if (isset($lokasi) && $lokasi != '') {
            $builder->orLike('pengajuan_tugas_kerja.lokasi', $lokasi);
        }
        if ($no_employee) {
            $builder->where('pengajuan_tugas_kerja.no_employee', $no_employee);
        }
        if ($pic) {
            $builder->where('pengajuan_tugas_kerja.penanggung_jawab', $pic);
        }
        if ($status) {
            $builder->where('pengajuan_tugas_kerja.status', $status);
        }
        return $builder->get()->getResultArray();
    }

    public function ubahProgresStatus($status, $id)
    {
        if ($id == 'undefined') {
            return $this->db->query('UPDATE pengajuan_tugas_kerja SET status="' . $status . '"');
        }
        return $this->db->query('UPDATE pengajuan_tugas_kerja SET status="' . $status . '" WHERE id_pengajuan = "' . $id . '"');
    }

    public function countAllOrRow($id = false, $where = null, $no_employee = false)
    {
        $builder = $this->db->table($this->table);
        if ($id && $where) {
            $builder->where($where, $id);
        }
        if ($no_employee) {
            $builder->where('penanggung_jawab', $no_employee);
        }
        return $builder->get()->getNumRows();
    }

    public function cari($dari, $status, $sampai)
    {
        $builder = $this->db->table($this->table);
        $builder->select('*,pengajuan_tugas_kerja.status as status_tugas');
        if ($status == 'dalam_pengerjaan' || $status == 'selesai' || $status == 'pengajuan_baru') {
            $builder->where('pengajuan_tugas_kerja.status', $status);
        }
        $builder->join('user', 'user.no_employee = ' . $this->table . '.penanggung_jawab');
        $builder->where('pengajuan_tugas_kerja.tgl_pengajuan >=', $dari);
        $builder->where('pengajuan_tugas_kerja.tgl_pengajuan <=', $sampai);
        return $builder->get()->getResultArray();
    }

    public function getUserPengajuan($id)
    {
        $builder = $this->db->table($this->table);
        $builder->select('*, pengajuan_tugas_kerja.status as status_tugas');
        $builder->join('user', 'user.no_employee = ' . $this->table . '.no_employee');
        $builder->where($this->table . '.id_pengajuan', $id);
        return $builder->get()->getRowArray();
    }
}
