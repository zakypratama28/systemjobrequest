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

    public function updatePengajuan($data,$id)
    {
        $builder = $this->db->table($this->table);
        return $builder->where($this->primaryKey,$id)->update($data);
    }

    public function deletePengajuan($id)
    {
        $builder = $this->db->table($this->table);
        return $builder->where($this->primaryKey,$id)->delete();
    }

    public function listPengajuan($name,$tgl,$lokasi,$no_employee = false)
    {
        $builder = $this->db->table($this->table);
        if (isset($name) && $name != '') {
            $builder->like('nama_pengajuan',$name);
        } 
        if (isset($tgl) && $tgl != '') {
            $builder->orLike('tgl_pengajuan',$tgl);
        }
        if (isset($lokasi) && $lokasi != '') {
            $builder->orLike('lokasi',$lokasi);
        }
        if ($no_employee) {
            $builder->where('no_employee',$no_employee);
        }
        return $builder->get()->getResultArray();
    }

    public function ubahProgresStatus($status,$id)
    {
        if ($id == 'undefined') {
            return $this->db->query('UPDATE pengajuan_tugas_kerja SET status="'.$status.'"');
        }
        return $this->db->query('UPDATE pengajuan_tugas_kerja SET status="'.$status.'" WHERE id_pengajuan = "'.$id.'"');
    }

    public function countAllOrRow($id = false, $where = null)
    {
        $builder = $this->db->table($this->table);
        if ($id && $where) {
            $builder->where($where,$id);
        }
        return $builder->get()->getNumRows();
    }

    public function cari($dari,$status,$sampai)
    {
        $builder = $this->db->table($this->table);
        if ($status == 'dalam_pengerjaan' || $status == 'selesai' || $status == 'pengajuan_baru') {
            $builder->where('status',$status);
        }
        $builder->where('tgl_pengajuan >=', $dari);
        $builder->where('tgl_pengajuan <=', $sampai);
        return $builder->get()->getResultArray();
    }

    public function getUserPengajuan($id)
    {
        $builder = $this->db->table($this->table);
        $builder->join('user','user.no_employee = '.$this->table.'.no_employee');
        $builder->where($this->table.'.id_pengajuan',$id);
        return $builder->get()->getRowArray();
    }
}