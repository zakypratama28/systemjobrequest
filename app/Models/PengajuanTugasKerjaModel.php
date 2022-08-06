<?php

namespace App\Models;

use CodeIgniter\Model;

class PengajuanTugasKerjaModel extends Model
{
    protected $table = 'pengajuan_tugas_kerja';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'id_pengajuan',
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

    public function kodeOtomatis()
    {
	    // $query = $this->db->table($this->table);
	    // $query->select('RIGHT(id_pengajuan,3) as id_pengajuan', FALSE);
	    // $query->orderBy('id_pengajuan','DESC');    
	    // $query->limit(1);    
        $query = $this->db->query('SELECT RIGHT(id_pengajuan,3) as id_pengajuan from pengajuan_tugas_kerja ORDER BY id_pengajuan DESC LIMIT 1');
	        if($query->getNumRows() <> 0){      
	             $data = $query->getRow();
	             $kode = intval($data->id_pengajuan) + 1; 
	        }else{      
	             $kode = 1;  
	        }
	    $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);    
	    $kodetampil = "PKB".$batas;
	    return $kodetampil;  
    }

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
        //builder=class yg disediakan oleh CI yang manipulasi data dari sebuah database, menggunakan script yang lebih minimal
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
        $builder->select('*,pengajuan_tugas_kerja.status as status_tugas'); //menerima parameter kedua opsional
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
        $builder = $this->db->table($this->table); //Builder adalah class pada CodeIgniter untuk bekerja dengan Database.
        if ($id && $where) {
            $builder->where($where, $id); //builder mempermudah dalam menulis query
        }
        if ($no_employee) {
            $builder->where('penanggung_jawab', $no_employee);
        }
        return $builder->get()->getNumRows(); //menghitung data yang ada di table
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
        $builder->select('*,pengajuan_tugas_kerja.status as status_tugas');
        $builder->join('user', 'user.no_employee = ' . $this->table . '.penanggung_jawab');
        $builder->where($this->table . '.id_pengajuan', $id);
        return $builder->get()->getRowArray();
    }
}
