<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\RoleModel;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $role = new RoleModel();
        $role->saveRole(['nama_role' => $role::ROLE_ADMIN]);
        $role->saveRole(['nama_role' => $role::ROLE_KARYAWAN]);
    }
}
