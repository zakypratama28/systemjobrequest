<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Auth::index');
$routes->post('/', 'Auth::login');
$routes->get('/logout', 'Auth::logout');
$routes->group('admin', ['filter' => 'authuseradmin'], function ($routes) {
    $routes->get('beranda', 'Admin\Beranda::index');
    $routes->get('beranda/cari', 'Admin\Beranda::cari');
    $routes->get('profile', 'Admin\Profile::index');
    //menampilkan halaman tambah
    $routes->post('pengajuan/nambah', 'Admin\Pengajuan::nambah');
    $routes->post('pengajuan/ubah/(:segment)', 'Admin\Pengajuan::ubah/$1');
    $routes->post('pengajuan/hapus/(:segment)', 'Admin\Pengajuan::hapus/$1');
    // ubah status pekerjaan
    $routes->get('pengajuan/ubah_progress_status/(:segment)/(:segment)', 'Admin\Pengajuan::ubah_progress_status/$1/$2');
    // menampilkan halaman umpan balik
    $routes->get('pengajuan/umpan_balik/(:segment)', 'Admin\Pengajuan::umpan_balik/$1');
    // pesan yang ditampilkan admin ketika menambahkan umpan balik
    $routes->post('pengajuan/beri_umpan_balik/(:segment)', 'Admin\Pengajuan::beri_umpan_balik/$1');
    // cetak pdf umpan balik
    $routes->get('pengajuan/rekap_umpan_balik/(:segment)','Admin\Pengajuan::rekap_umpan_balik/$1');
    // rekap umpan balik
    $routes->get('pengajuan/download_rekap_umpan_balik','Admin\Pengajuan::download_rekap_umpan_balik');
});
// mengirimkan data notifikasi
$routes->get('/baca-notifikasi', 'Notifikasi::fetchAll');
// pesan yang ditampilkan
$routes->get('/sudah-baca-notifikasi/(:segment)', 'Notifikasi::readAll/$1');

$routes->group('karyawan', ['filter' => 'authuserkaryawan'], function ($routes) {
    $routes->get('beranda', 'Karyawan\Beranda::index');
    $routes->get('beranda/cari', 'Karyawan\Beranda::cari');
    $routes->get('profile', 'Karyawan\Profile::index');
    $routes->post('pengajuan/nambah', 'Karyawan\Pengajuan::nambah');
    $routes->post('pengajuan/ubah/(:segment)', 'Karyawan\Pengajuan::ubah/$1');
    $routes->post('pengajuan/hapus/(:segment)', 'Karyawan\Pengajuan::hapus/$1');
    $routes->get('pengajuan/ubah_progress_status/(:segment)/(:segment)', 'Karyawan\Pengajuan::ubah_progress_status/$1/$2');
    // $routes->get('pengajuan/umpan_balik/(:segment)','Admin\Pengajuan::umpan_balik/$1');
    // $routes->post('pengajuan/beri_umpan_balik/(:segment)','Admin\Pengajuan::beri_umpan_balik/$1');
});
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
