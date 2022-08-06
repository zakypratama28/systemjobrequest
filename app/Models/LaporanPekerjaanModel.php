<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanPekerjaanModel extends Model
{
    // class ini tidak perlu karena sudah menggunakan window.print
    protected $table = 'laporan_pekerjaan';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'no_employee',
        'path',
        'date',
    ];
    protected $primaryKey = 'id_laporan';

    public function getLaporanPekerjaan($id = false)
    {
        if ($id) {
            return $this->where($this->primaryKey, $id)
                ->first();
        } else {
            return $this->findAll();
        }
    }

    public function saveLaporanPekerjaan($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function updateLaporanPekerjaan($data, $id)
    {
        $builder = $this->db->table($this->table);
        return $builder->where($this->primaryKey, $id)->update($data);
    }

    public function deleteLaporanPekerjaan($id)
    {
        $builder = $this->db->table($this->table);
        return $builder->where($this->primaryKey, $id)->delete();
    }
}
