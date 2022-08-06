<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\RoleModel;

class Auth extends BaseController
{
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->roleModel = new RoleModel();
        helper(['my_helper']); // sama memanggil function di file my_helper dan function itu berulang ulang di gunakan
    }

    public function index()
    {
        return view('auth/login');
    }

    public function login()
    {
        if (!$this->validate($this->userModel->validationAuthLogin())) { //mengembalikan nilai true jika berhasil
            session()->setFlashdata('error', $this->validator->listErrors()); //flash message eror
            // return redirect()->back()->withInput();
            return redirect()->to(base_url('/'));
        } else {
            $no_employee = $this->request->getVar('no_employee');
            $password = $this->request->getVar('password');
            if ($this->userModel->countAllOrRow($no_employee, 'no_employee') > 0) {
                // mengecek apakah no_employee di table ada dan berjumlah berapa
                $data = $this->userModel->getUserJoinRole($no_employee, 'no_employee');
                // dan mengambil data dan di cocokkan isi data lalu munculkan data
                if (password_verify($password, $data['password'])) {
                    // password dari inputan dan password dari userseeder di cek keduanya apakah valid
                    // kalau valid masukan di session data yang diperlukan apa saja
                    session()->set([
                        'no_employee' => $data['no_employee'],
                        'nama_role' => $data['nama_role'],
                        'nama' => $data['nama'],
                        'login' => TRUE
                    ]);
                    session()->setFlashdata('success_text', "Selamat Datang " . $data['nama']); //flash message berhasil login
                    session()->setFlashdata('success_title', "Login Berhasil");
                    // cek lagi apakah rolenya benar berdasarkan nama role lalu masuk secara langsung ke halaman masing masing
                    if ($data['nama_role'] == $this->roleModel::ROLE_ADMIN) {
                        return redirect()->to(base_url('/admin/beranda'));
                    } else {
                        return redirect()->to(base_url('/karyawan/beranda'));
                    }
                } else {
                    // terjadi error ketika datanya tidak sesuai
                    $result = "No Employee dan Password anda tidak sesuai!";
                    session()->setFlashdata('error', $result);
                    return redirect()->to(base_url('/'));
                }
            } else {
                // terjadi error ketika No Employee tidak terdaftar
                $result = "No Employee anda tidak terdaftar!";
                session()->setFlashdata('error', $result);
                // return redirect()->back()->withInput();
                return redirect()->to(base_url('/'));
            }
        }
    }

    public function logout()
    {
        // menghapus session yang tersimpan di browser
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('/'));
    }
}
