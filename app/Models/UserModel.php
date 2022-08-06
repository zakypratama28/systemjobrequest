<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'role_id',
        'password',
        'nama',
        'email',
        'department',
        'jabatan',
        'tahun_masuk',
        'tahun_habis_kontrak',
        'status',
    ];
    protected $primaryKey = 'no_employee';

    public function getUser($id = false, $where = null)
    {
        if ($id && $where) {
            return $this->where($where, $id)
                ->first();
        } else {
            return $this->findAll();
        }
    }

    public function saveUser($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function updateUser($data, $id)
    {
        $builder = $this->db->table($this->table);
        return $builder->where($this->primaryKey, $id)->update($data);
    }

    public function deleteUser($id)
    {
        $builder = $this->db->table($this->table);
        return $builder->where($this->primaryKey, $id)->delete();
    }

    public function countAllOrRow($id = false, $where = null)
    {
        $builder = $this->db->table($this->table);
        if ($id && $where) {
            $builder->where($where, $id);
        }
        return $builder->get()->getNumRows();
    }

    public function validationAuthLogin()
    {
        return [
            'no_employee' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'No Employee Harus diisi',
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password Harus diisi'
                ]
            ],
        ];
    }
    //menampilkan semua atau satu data. 
    public function getUserJoinRole($id = false, $where = null)
    { //$builder variabel untuk mempermudah penulisan
        $builder = $this->db->table($this->table);
        $builder->join('role', 'role.role_id=user.role_id'); // join 2 tabel yg berbeda (role dan user)
        if ($id && $where) {
            $builder->where($where, $id);
            return $builder->get()->getRowArray();
        }
        return $builder->get()->getResultArray();
    }
    //function untuk mengjoinkan data
    public function getUserJoinPengajuanTugas($id = false, $where = null)
    {
        $builder = $this->db->table($this->table);
        $builder->join('pengajuan_tugas_kerja', 'pengajuan_tugas_kerja.no_employee=user.no_employee');
        if ($id && $where) {
            $builder->where($where, $id);
            return $builder->get()->getRowArray();
        }
        return $builder->get()->getResultArray();
    }
}
