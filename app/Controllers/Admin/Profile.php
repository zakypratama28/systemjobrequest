<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Profile extends BaseController
{
    public function index() //controler untuk menampilkan halaman profil role admin
    {
        $user = new UserModel();
        $data['user'] = $user->getUser(session('no_employee'), 'no_employee');
        return view('admin/profile', $data);
    }
}
