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

    public function listPengajuan($name,$tgl,$lokasi)
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
        return $builder->get()->getResultArray();
    }
}