<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\RoleModel;

class Auth extends BaseController
{
    public function __construct(){
       $this->userModel = new UserModel();
       $this->roleModel = new RoleModel();
        helper(['my_helper']);
    }

    public function index()
    {
        return view('auth/login');
    }

    public function login(){
        if (!$this->validate($this->userModel->validationAuthLogin())) {
            session()->setFlashdata('error', $this->validator->listErrors());
            // return redirect()->back()->withInput();
            return redirect()->to(base_url('/'));
        } else {
            $no_employee = $this->request->getVar('no_employee');
            $password = $this->request->getVar('password');
            if ($this->userModel->countAllOrRow($no_employee,'no_employee') > 0){
                $data = $this->userModel->getUserJoinRole($no_employee,'no_employee');
                if (password_verify($password,$data['password'])){
                    session()->set([
                        'no_employee' => $data['no_employee'],
                        'nama_role' => $data['nama_role'],
                        'nama' => $data['nama'],
                        'login' => TRUE
                    ]);
                    session()->setFlashdata('success_login', "Selamat Datang ".$data['nama']);
                    if ($data['nama_role'] == $this->roleModel::ROLE_ADMIN) {
                        return redirect()->to(base_url('/admin/beranda'));
                    }else{
                        return redirect()->to(base_url('/karyawan/beranda'));
                    }
                }else{
                    $result="No Employee dan Password tidak cocok";
                    session()->setFlashdata('error', $result);
                    return redirect()->to(base_url('/'));
                }
            }else{
                $result="No Employee tidak terdaftar";
                session()->setFlashdata('error', $result);
                // return redirect()->back()->withInput();
                return redirect()->to(base_url('/'));
            }
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('/'));
    }
}
