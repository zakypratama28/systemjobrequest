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
            'no_employee' => '700123',
            'role_id' => $roleAdmin['role_id'],
            'password' => password_hash('leader', PASSWORD_DEFAULT),
            'nama' => 'Zaky',
            'email' => 'zakyp892@gmail.com',
            'department' => 'Facility',
            'jabatan' => 'Asisten Supervisor',
            'tahun_masuk' => 2022,
            'tahun_habis_kontrak' => 2024,
            'status' => 'Tetap'
        ]);
        $user->saveUser([
            'no_employee' => '700101',
            'role_id' => $roleAdmin['role_id'],
            'password' => password_hash('leader', PASSWORD_DEFAULT),
            'nama' => 'zaky mhd',
            'email' => 'zaky892@gmail.com',
            'department' => 'Facility',
            'jabatan' => 'Asisten Supervisor',
            'tahun_masuk' => 2022,
            'tahun_habis_kontrak' => 2024,
            'status' => 'Tetap'
        ]);
        $user->saveUser([
            'no_employee' => '700102',
            'role_id' => $roleAdmin['role_id'],
            'password' => password_hash('leader', PASSWORD_DEFAULT),
            'nama' => 'Otrianto',
            'email' => 'prtmnur.46@gmail.com',
            'department' => 'Facility',
            'jabatan' => 'Asisten Supervisor',
            'tahun_masuk' => 2022,
            'tahun_habis_kontrak' => 2024,
            'status' => 'Kontrak'
        ]);
        $user->saveUser([
            'no_employee' => '700321',
            'role_id' => $roleKaryawan['role_id'],
            'password' => password_hash('karyawan', PASSWORD_DEFAULT),
            'nama' => 'Pratama',
            'email' => 'prtmnur.46@gmail.com',
            'department' => 'Facility',
            'jabatan' => 'Operator facility',
            'tahun_masuk' => 2022,
            'tahun_habis_kontrak' => 2024,
            'status' => 'Kontrak'
        ]);
        $user->saveUser([
            'no_employee' => '700100',
            'role_id' => $roleKaryawan['role_id'],
            'password' => password_hash('karyawan', PASSWORD_DEFAULT),
            'nama' => 'aldy',
            'email' => 'prtmnur.46@gmail.com',
            'department' => 'Facility',
            'jabatan' => 'Operator facility',
            'tahun_masuk' => 2022,
            'tahun_habis_kontrak' => 2024,
            'status' => 'Kontrak'
        ]);
        $user->saveUser([
            'no_employee' => '700103',
            'role_id' => $roleKaryawan['role_id'],
            'password' => password_hash('karyawan', PASSWORD_DEFAULT),
            'nama' => 'Dalimun',
            'email' => 'prtmnur.46@gmail.com',
            'department' => 'Facility',
            'jabatan' => 'Operator facility',
            'tahun_masuk' => 2022,
            'tahun_habis_kontrak' => 2024,
            'status' => 'Kontrak'
        ]);
        $user->saveUser([
            'no_employee' => '700104',
            'role_id' => $roleKaryawan['role_id'],
            'password' => password_hash('karyawan', PASSWORD_DEFAULT),
            'nama' => 'Nickson',
            'email' => 'prtmnur.46@gmail.com',
            'department' => 'Facility',
            'jabatan' => 'Operator facility',
            'tahun_masuk' => 2022,
            'tahun_habis_kontrak' => 2024,
            'status' => 'Kontrak'
        ]);
        $user->saveUser([
            'no_employee' => '700105',
            'role_id' => $roleKaryawan['role_id'],
            'password' => password_hash('karyawan', PASSWORD_DEFAULT),
            'nama' => 'Yuni',
            'email' => 'prtmnur.46@gmail.com',
            'department' => 'Facility',
            'jabatan' => 'Operator facility',
            'tahun_masuk' => 2022,
            'tahun_habis_kontrak' => 2024,
            'status' => 'Kontrak'
        ]);
        $user->saveUser([
            'no_employee' => '700106',
            'role_id' => $roleKaryawan['role_id'],
            'password' => password_hash('karyawan', PASSWORD_DEFAULT),
            'nama' => 'Rinda',
            'email' => 'prtmnur.46@gmail.com',
            'department' => 'Facility',
            'jabatan' => 'Operator facility',
            'tahun_masuk' => 2022,
            'tahun_habis_kontrak' => 2024,
            'status' => 'Kontrak'
        ]);
        $user->saveUser([
            'no_employee' => '700107',
            'role_id' => $roleKaryawan['role_id'],
            'password' => password_hash('karyawan', PASSWORD_DEFAULT),
            'nama' => 'Wira',
            'email' => 'prtmnur.46@gmail.com',
            'department' => 'Facility',
            'jabatan' => 'Operator facility',
            'tahun_masuk' => 2022,
            'tahun_habis_kontrak' => 2024,
            'status' => 'Kontrak'
        ]);
        $user->saveUser([
            'no_employee' => '700108',
            'role_id' => $roleKaryawan['role_id'],
            'password' => password_hash('karyawan', PASSWORD_DEFAULT),
            'nama' => 'Heriansyah',
            'email' => 'prtmnur.46@gmail.com',
            'department' => 'Facility',
            'jabatan' => 'Operator facility',
            'tahun_masuk' => 2022,
            'tahun_habis_kontrak' => 2024,
            'status' => 'Kontrak'
        ]);
        $user->saveUser([
            'no_employee' => '700109',
            'role_id' => $roleKaryawan['role_id'],
            'password' => password_hash('karyawan', PASSWORD_DEFAULT),
            'nama' => 'Agusman',
            'email' => 'prtmnur.46@gmail.com',
            'department' => 'Facility',
            'jabatan' => 'Operator facility',
            'tahun_masuk' => 2022,
            'tahun_habis_kontrak' => 2024,
            'status' => 'Kontrak'
        ]);
        $user->saveUser([
            'no_employee' => '700110',
            'role_id' => $roleKaryawan['role_id'],
            'password' => password_hash('karyawan', PASSWORD_DEFAULT),
            'nama' => 'Hotman',
            'email' => 'prtmnur.46@gmail.com',
            'department' => 'Facility',
            'jabatan' => 'Operator facility',
            'tahun_masuk' => 2022,
            'tahun_habis_kontrak' => 2024,
            'status' => 'Kontrak'
        ]);
        $user->saveUser([
            'no_employee' => '700111',
            'role_id' => $roleKaryawan['role_id'],
            'password' => password_hash('karyawan', PASSWORD_DEFAULT),
            'nama' => 'Turnip',
            'email' => 'prtmnur.46@gmail.com',
            'department' => 'Facility',
            'jabatan' => 'Operator facility',
            'tahun_masuk' => 2022,
            'tahun_habis_kontrak' => 2024,
            'status' => 'Kontrak'
        ]);
        $user->saveUser([
            'no_employee' => '700112',
            'role_id' => $roleKaryawan['role_id'],
            'password' => password_hash('karyawan', PASSWORD_DEFAULT),
            'nama' => 'Erik',
            'email' => 'prtmnur.46@gmail.com',
            'department' => 'Facility',
            'jabatan' => 'Operator facility',
            'tahun_masuk' => 2022,
            'tahun_habis_kontrak' => 2024,
            'status' => 'Kontrak'
        ]);
        $user->saveUser([
            'no_employee' => '700113',
            'role_id' => $roleKaryawan['role_id'],
            'password' => password_hash('karyawan', PASSWORD_DEFAULT),
            'nama' => 'Heru',
            'email' => 'prtmnur.46@gmail.com',
            'department' => 'Facility',
            'jabatan' => 'Operator facility',
            'tahun_masuk' => 2022,
            'tahun_habis_kontrak' => 2024,
            'status' => 'Kontrak'
        ]);
        $user->saveUser([
            'no_employee' => '700114',
            'role_id' => $roleKaryawan['role_id'],
            'password' => password_hash('karyawan', PASSWORD_DEFAULT),
            'nama' => 'Samuel',
            'email' => 'prtmnur.46@gmail.com',
            'department' => 'Facility',
            'jabatan' => 'Operator facility',
            'tahun_masuk' => 2022,
            'tahun_habis_kontrak' => 2024,
            'status' => 'Kontrak'
        ]);
        $user->saveUser([
            'no_employee' => '700115',
            'role_id' => $roleKaryawan['role_id'],
            'password' => password_hash('karyawan', PASSWORD_DEFAULT),
            'nama' => 'Hizkia Samosir',
            'email' => 'prtmnur.46@gmail.com',
            'department' => 'Facility',
            'jabatan' => 'Operator facility',
            'tahun_masuk' => 2022,
            'tahun_habis_kontrak' => 2024,
            'status' => 'Kontrak'
        ]);
        $user->saveUser([
            'no_employee' => '700116',
            'role_id' => $roleKaryawan['role_id'],
            'password' => password_hash('karyawan', PASSWORD_DEFAULT),
            'nama' => 'Ricky Imanuel',
            'email' => 'prtmnur.46@gmail.com',
            'department' => 'Facility',
            'jabatan' => 'Operator facility',
            'tahun_masuk' => 2022,
            'tahun_habis_kontrak' => 2024,
            'status' => 'Kontrak'
        ]);
        $user->saveUser([
            'no_employee' => '700117',
            'role_id' => $roleKaryawan['role_id'],
            'password' => password_hash('karyawan', PASSWORD_DEFAULT),
            'nama' => 'Aulia',
            'email' => 'prtmnur.46@gmail.com',
            'department' => 'Facility',
            'jabatan' => 'Operator facility',
            'tahun_masuk' => 2022,
            'tahun_habis_kontrak' => 2024,
            'status' => 'Kontrak'
        ]);
        $user->saveUser([
            'no_employee' => '700118',
            'role_id' => $roleKaryawan['role_id'],
            'password' => password_hash('karyawan', PASSWORD_DEFAULT),
            'nama' => 'Ghufron R',
            'email' => 'prtmnur.46@gmail.com',
            'department' => 'Facility',
            'jabatan' => 'Operator facility',
            'tahun_masuk' => 2022,
            'tahun_habis_kontrak' => 2024,
            'status' => 'Kontrak'
        ]);
        $user->saveUser([
            'no_employee' => '700119',
            'role_id' => $roleKaryawan['role_id'],
            'password' => password_hash('karyawan', PASSWORD_DEFAULT),
            'nama' => 'Andrean Aldy',
            'email' => 'prtmnur.46@gmail.com',
            'department' => 'Facility',
            'jabatan' => 'Operator facility',
            'tahun_masuk' => 2022,
            'tahun_habis_kontrak' => 2024,
            'status' => 'Kontrak'
        ]);
        $user->saveUser([
            'no_employee' => '700120',
            'role_id' => $roleKaryawan['role_id'],
            'password' => password_hash('karyawan', PASSWORD_DEFAULT),
            'nama' => 'Rama Mahesa',
            'email' => 'prtmnur.46@gmail.com',
            'department' => 'Facility',
            'jabatan' => 'Operator facility',
            'tahun_masuk' => 2022,
            'tahun_habis_kontrak' => 2024,
            'status' => 'Kontrak'
        ]);
        $user->saveUser([
            'no_employee' => '700121',
            'role_id' => $roleKaryawan['role_id'],
            'password' => password_hash('karyawan', PASSWORD_DEFAULT),
            'nama' => 'Dani Gustanta',
            'email' => 'prtmnur.46@gmail.com',
            'department' => 'Facility',
            'jabatan' => 'Operator facility',
            'tahun_masuk' => 2022,
            'tahun_habis_kontrak' => 2024,
            'status' => 'Kontrak'
        ]);
        $user->saveUser([
            'no_employee' => '700122',
            'role_id' => $roleKaryawan['role_id'],
            'password' => password_hash('karyawan', PASSWORD_DEFAULT),
            'nama' => 'Pasrama H',
            'email' => 'prtmnur.46@gmail.com',
            'department' => 'Facility',
            'jabatan' => 'Operator facility',
            'tahun_masuk' => 2022,
            'tahun_habis_kontrak' => 2024,
            'status' => 'Kontrak'
        ]);
        $user->saveUser([
            'no_employee' => '700124',
            'role_id' => $roleKaryawan['role_id'],
            'password' => password_hash('karyawan', PASSWORD_DEFAULT),
            'nama' => 'Heri Kurniawan',
            'email' => 'prtmnur.46@gmail.com',
            'department' => 'Facility',
            'jabatan' => 'Operator facility',
            'tahun_masuk' => 2022,
            'tahun_habis_kontrak' => 2024,
            'status' => 'Kontrak'
        ]);
        $user->saveUser([
            'no_employee' => '700125',
            'role_id' => $roleKaryawan['role_id'],
            'password' => password_hash('karyawan', PASSWORD_DEFAULT),
            'nama' => 'Wendrik',
            'email' => 'prtmnur.46@gmail.com',
            'department' => 'Facility',
            'jabatan' => 'Operator facility',
            'tahun_masuk' => 2022,
            'tahun_habis_kontrak' => 2024,
            'status' => 'Kontrak'
        ]);
        $user->saveUser([
            'no_employee' => '700126',
            'role_id' => $roleKaryawan['role_id'],
            'password' => password_hash('karyawan', PASSWORD_DEFAULT),
            'nama' => 'Enra',
            'email' => 'prtmnur.46@gmail.com',
            'department' => 'Facility',
            'jabatan' => 'Operator facility',
            'tahun_masuk' => 2022,
            'tahun_habis_kontrak' => 2024,
            'status' => 'Kontrak'
        ]);
        $user->saveUser([
            'no_employee' => '700127',
            'role_id' => $roleKaryawan['role_id'],
            'password' => password_hash('karyawan', PASSWORD_DEFAULT),
            'nama' => 'Ramadhoni',
            'email' => 'prtmnur.46@gmail.com',
            'department' => 'Facility',
            'jabatan' => 'Operator facility',
            'tahun_masuk' => 2022,
            'tahun_habis_kontrak' => 2024,
            'status' => 'Kontrak'
        ]);
        $user->saveUser([
            'no_employee' => '700128',
            'role_id' => $roleKaryawan['role_id'],
            'password' => password_hash('karyawan', PASSWORD_DEFAULT),
            'nama' => 'Josua S',
            'email' => 'prtmnur.46@gmail.com',
            'department' => 'Facility',
            'jabatan' => 'Operator facility',
            'tahun_masuk' => 2022,
            'tahun_habis_kontrak' => 2024,
            'status' => 'Kontrak'
        ]);
    }
}
