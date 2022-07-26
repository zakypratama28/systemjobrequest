<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\UserModel;
use App\Models\RoleModel;

class UserSeeder extends Seeder
{
    public function run()
    {
        $role = new RoleModel();
        $roleAdmin = $role->where('nama_role',$role::ROLE_ADMIN)->first();
        $roleKaryawan = $role->where('nama_role',$role::ROLE_KARYAWAN)->first();
        $user = new UserModel();
        $user->saveUser([
            'no_employee' => '0123456789',
            'role_id' => $roleAdmin['role_id'],
            'password' => password_hash('admin',PASSWORD_DEFAULT),
            'nama' => 'admin',
            'email' => 'afifarman50@gmail.com',
            'department' => 'IT',
            'jabatan' => 'IT Staff',
            'tahun_masuk' => 2022,
            'tahun_habis_kontrak' => 2024,
            'status' => 'tidak_aktif'
        ]);
        $user->saveUser([
            'no_employee' => '987654321',
            'role_id' => $roleKaryawan['role_id'],
            'password' => password_hash('karyawan',PASSWORD_DEFAULT),
            'nama' => 'karyawan',
            'email' => 'karyawan@example.com',
            'department' => 'IT',
            'jabatan' => 'IT Staff',
            'tahun_masuk' => 2022,
            'tahun_habis_kontrak' => 2024,
            'status' => 'tidak_aktif'
        ]);
    }
}
