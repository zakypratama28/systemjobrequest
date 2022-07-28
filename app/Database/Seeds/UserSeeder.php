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
        $roleAdmin = $role->where('nama_role', $role::ROLE_ADMIN)->first();
        $roleKaryawan = $role->where('nama_role', $role::ROLE_KARYAWAN)->first();
        $user = new UserModel();
        $user->saveUser([
            'no_employee' => '0123456789',
            'role_id' => $roleAdmin['role_id'],
            'password' => password_hash('admin', PASSWORD_DEFAULT),
            'nama' => 'admin',
            'email' => 'zakyp892@gmail.com',
            'department' => 'IT',
            'jabatan' => 'IT Staff',
            'tahun_masuk' => 2022,
            'tahun_habis_kontrak' => 2024,
            'status' => 'Tetap'
        ]);
        $user->saveUser([
            'no_employee' => '987654321',
            'role_id' => $roleKaryawan['role_id'],
            'password' => password_hash('karyawan', PASSWORD_DEFAULT),
            'nama' => 'karyawan',
            'email' => 'prtmnur.46@gmail.com',
            'department' => 'IT',
            'jabatan' => 'Teknisi',
            'tahun_masuk' => 2022,
            'tahun_habis_kontrak' => 2024,
            'status' => 'Kontrak'
        ]);
        $user->saveUser([
            'no_employee' => '700142',
            'role_id' => $roleAdmin['role_id'],
            'password' => password_hash('admin', PASSWORD_DEFAULT),
            'nama' => 'afif',
            'email' => 'afif@gmail.com',
            'department' => 'fasilitas',
            'jabatan' => 'asisten supervisor',
            'tahun_masuk' => 2022,
            'tahun_habis_kontrak' => 2024,
            'status' => 'Tetap'
        ]);
        $user->saveUser([
            'no_employee' => '700203',
            'role_id' => $roleKaryawan['role_id'],
            'password' => password_hash('karyawan', PASSWORD_DEFAULT),
            'nama' => 'aldy',
            'email' => 'aldy@gmail.com',
            'department' => 'fasilitas',
            'jabatan' => 'asisten produksi',
            'tahun_masuk' => 2022,
            'tahun_habis_kontrak' => 2024,
            'status' => 'Kontrak'
        ]);
        $user->saveUser([
            'no_employee' => '700150',
            'role_id' => $roleAdmin['role_id'],
            'password' => password_hash('admin', PASSWORD_DEFAULT),
            'nama' => 'zaky mhd',
            'email' => 'zaky@gmail.com',
            'department' => 'informasi sistem department',
            'jabatan' => 'asisten supervisor',
            'tahun_masuk' => 2022,
            'tahun_habis_kontrak' => 2024,
            'status' => 'Tetap'
        ]);
        $user->saveUser([
            'no_employee' => '700200',
            'role_id' => $roleKaryawan['role_id'],
            'password' => password_hash('karyawan', PASSWORD_DEFAULT),
            'nama' => 'arman nasu',
            'email' => 'arman@gmail.com',
            'department' => 'fasilitas',
            'jabatan' => 'operator',
            'tahun_masuk' => 2022,
            'tahun_habis_kontrak' => 2024,
            'status' => 'Kontrak'
        ]);
    }
}
