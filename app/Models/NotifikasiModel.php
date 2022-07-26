<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class NotifikasiModel extends Model
{
    protected $table = 'notifikasi';
    protected $useTimestamps = false; 
    protected $allowedFields = [
    	'pesan',
        'no_employee',
        'tanggal',
        'aktif'
    ];
 	protected $primaryKey = 'id_notifikasi';


    public function saveNotifikasi($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function countAllOrRow($id = false, $where = null)
    {
        $builder = $this->db->table($this->table);
        $builder->where('aktif','belum');
        if ($id && $where) {
            $builder->where($where,$id);
        }
        $builder->where('no_employee',session('no_employee'));
        return $builder->get()->getNumRows();
    }

    public function all()
    {
        $builder = $this->db->table($this->table);
        $builder->where('aktif','belum');
        $builder->where('no_employee',session('no_employee'));
        $builder->limit(3);
        $builder->orderBy('id_notifikasi','DESC');
        return $builder->get()->getResultArray();
    }
}