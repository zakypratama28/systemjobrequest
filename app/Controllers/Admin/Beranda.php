<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Beranda extends BaseController
{
    public function __construct()
    {
        helper(['my_helper']);
    }

    public function index()
    {
        return view('admin/beranda');
    }
}
