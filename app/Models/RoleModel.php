<?php
 
namespace App\Models;
 
use CodeIgniter\Model;
 
class RoleModel extends Model
{
    const ROLE_ADMIN = 'admin';
    const ROLE_KARYAWAN = 'karyawan';
    protected $table = 'role';
    protected $useTimestamps = false; 
    protected $allowedFields = [
    	'nama_role'
    ];
 	protected $primaryKey = 'role_id';

    public function getRole($id = false,$where = null)
    {
        if ($id && $where) {
            return $this->where($where, $id)
                  ->first();
        } else {
            return $this->findAll();
        }
    }

    public function saveRole($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function updateRole($data,$id)
    {
        $builder = $this->db->table($this->table);
        return $builder->where($this->primaryKey,$id)->update($data);
    }

    public function deleteRole($id)
    {
        $builder = $this->db->table($this->table);
        return $builder->where($this->primaryKey,$id)->delete();
    }

}