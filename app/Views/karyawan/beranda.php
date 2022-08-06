<?= $this->extend('layouts/app_layout') ?>

<?= $this->section('content') ?>
<?php

use App\Models\RoleModel as RLModel;

$role = new RLModel();
?>
<div class="container-fluid px-4 mt-5">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a><i class="fas fa-chart-area"></i> Dashboard Job Request</a>

    </div>

    <?php alert_custom('error', 'danger'); ?>
    <!-- Content Row -->
    <div class="row justify-content-center">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                Pekerjaan Baru</div>
                            <div class="h5 mb-0 font-weight-bold text-danger"><?= $pengajuan_baru; ?></div>
                        </div>
                        <div class="col-auto">
                            <a href="..."> <img src="<?= base_url() . '/assets/img/baru.png'; ?>" width="70" height="70"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                Dalam Pengerjaan</div>
                            <div class="h5 mb-0 font-weight-bold text-warning"><?= $dalam_pengerjaan; ?></div>
                        </div>
                        <div class="col-auto">
                            <a href="..."> <img src="<?= base_url() . '/assets/img/progres.png'; ?>" width="70" height="70"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <!-- <div class="card py-2" onclick="showSwalSelesai('selesai');"> -->
            <div class="card py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Pekerjaan Selesai
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-success"><?= $selesai; ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <a href="..."> <img src="<?= base_url() . '/assets/img/complete.png'; ?>" width="70" height="70"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-4 py-2">
        <div class="d-flex justify-content-between">
            <div>
                <button type="button" class=" btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">
                    <a class="fas fa-plus"></a> Tambah Pekerjaan Baru</button>

                <!-- <a href="javascript:void" data-bs-toggle="modal" data-bs-target="#exampleDownload" data-bs-whatever="@getbootstrap" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                    <i class="fas fa-download fa-sm text-white-50"></i> Download Record</a> -->
            </div>
            <div>
                Cari Berdasarkan :
                <a href="javascript:void" data-bs-toggle="modal" data-bs-target="#examplePencarian" data-bs-whatever="@getbootstrap" class="btn btn-sm btn-secondary shadow-sm">
                    <i class="fas fa-search fa-sm text-white-50"></i> Cari Data...</a>
            </div>
        </div>

    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Daftar Pekerjaan
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr class="bg-info">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Aktivitas</th>
                        <th>Deskripsi</th>
                        <th>Lokasi</th>
                        <th>PIC</th>
                        <th>Tgl Pengajuan</th>
                        <th>Rencana Selesai</th>
                        <th>Actual Selesai</th>
                        <th>Foto</th>
                        <th>Status</th>
                        <th scope="col">Edit/Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($list as $k) {
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $k['nama_pengajuan']; ?></td>
                            <td><?= $k['activity']; ?></td>
                            <td><?= $k['deskripsi']; ?></td>
                            <td><?= $k['lokasi']; ?></td>
                            <td><?= $k['nama']; ?></td>
                            <td>
                                <?php if ($k['tgl_pengajuan'] == NULL) {
                                    echo '-';
                                } else {
                                    echo custom_date_tgl($k['tgl_pengajuan']);
                                } ?>

                            </td>
                            <td>
                                <?php if ($k['tgl_rencana_selesai'] == NULL) {
                                    echo '-';
                                } else {
                                    echo custom_date_tgl($k['tgl_rencana_selesai']);
                                } ?>
                            </td>
                            <td>
                                <?php if ($k['tgl_actual_selesai'] == NULL) {
                                    echo '-';
                                } else {
                                    echo custom_date_tgl($k['tgl_actual_selesai']);
                                } ?>
                            </td>
                            <td>
                                <a href="">
                                    <img src="<?= base_url() . '/uploads/' . $k['foto']; ?>" width="100" height="100">
                                </a>
                            </td>
                            <td <?php $status = 'text-success'; ?> <?php if ($k['status_tugas'] == 'pengajuan_baru') { ?> <?php $status = 'text-danger'; ?> <?php } else if ($k['status_tugas'] == 'dalam_pengerjaan') { ?> <?php $status = 'text-warning'; ?> <?php } ?> class="<?= $status; ?>">
                                <!-- <form action=""> -->
                                <?php if ($k['status_tugas'] == 'pengajuan_baru') { ?>
                                    <select style="background-color:white;border:none;" name="select_ubah" onchange="getSelectUbahKaryawan(this,<?= $k['id_pengajuan']; ?>,'karyawan')">
                                        <option value="" disabled selected><?= $k['status_tugas']; ?></option>
                                        <option style="color:yellow;" value="dalam_pengerjaan">Dalam Pengerjaan</option>
                                        <option style="color:green" value="selesai">Selesai</option>
                                    </select>
                                <?php } else if ($k['status_tugas'] == 'dalam_pengerjaan') { ?>
                                    <select style="background-color:white;border:none;" name="select_ubah" onchange="getSelectUbahKaryawan(this,<?= $k['id_pengajuan']; ?>,'karyawan')">
                                        <option style="color:yellow;" value="" disabled selected><?= $k['status_tugas']; ?></option>
                                        <option style="color:green;" value="selesai">Selesai</option>
                                    </select>
                                <?php } else { ?>
                                    <?= $k['status_tugas']; ?>
                                <?php } ?>
                                <!-- </form> -->
                            </td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleUbah<?= $no; ?>">
                                    <span class="fas fa-edit p-1 text-white rounded"></span>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleHapus<?= $no; ?>">
                                    <span class="fas fa-trash-alt p-1 text-white rounded" onclick="deleteData()"></span>
                                </button>
                            </td>
                        </tr>
                        <div class="modal fade" id="exampleHapus<?= $no; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Pekerjaan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="<?= base_url('/karyawan/pengajuan/hapus/' . $k['id_pengajuan']); ?>" enctype="multipart/form-data">
                                            <div class="d-flex flex-column align-items-center justify-center">
                                                <img src="<?= base_url() . '/assets/img/cancel.png'; ?>" alt="">
                                                <h2>Apakah kamu Yakin.</h2>
                                                <p>Akan menghapus data pekerjaan ini?</p>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-danger">Iya</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="exampleUbah<?= $no; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"><a class="fas fa-edit"></a> Ubah Pekerjaan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" id="formUbahKaryawan<?= $no; ?>" action="<?= base_url('/karyawan/pengajuan/ubah/' . $k['id_pengajuan']); ?>" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="mb-3 col-12">
                                                    <div class="d-flex justify-between row">
                                                        <div class="col-3">
                                                            <label class="form-label">Permintaan Oleh:</label>
                                                        </div>
                                                        <div class="col-9">
                                                            <input type="text" required value="<?= $k['nama_pengajuan']; ?>" name="ubah_nama" class="form-control" placeholder="Tulis Nama" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-2 col-12">
                                                    <div class="d-flex justify-between row">
                                                        <div class="col-3">
                                                            <label class="form-label">Aktivitas Pekerjaan:</label>
                                                        </div>
                                                        <div class="col-9">
                                                            <input type="text" required value="<?= $k['activity']; ?>" name="ubah_aktivitas" class="form-control" placeholder="Tulis Aktivitas Pekerjaan">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-2 col-12">
                                                    <div class="d-flex justify-between row">
                                                        <div class="col-3">
                                                            <label class="form-label">Deskripsi:</label>
                                                        </div>
                                                        <div class="col-9">
                                                            <textarea class="form-control" required name="ubah_deskripsi" placeholder="Tulis Deskripsi"><?= $k['deskripsi']; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-2 col-12">
                                                    <div class="d-flex justify-between row">
                                                        <div class="col-3">
                                                            <label class="form-label">Lokasi:</label>
                                                        </div>
                                                        <div class="col-9">
                                                            <input type="text" value="<?= $k['lokasi']; ?>" required name="ubah_lokasi" id="ubaLokasi" class="form-control" placeholder="Tulis Lokasi">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-2 col-12">
                                                    <div class="d-flex justify-between row">
                                                        <div class="col-3">
                                                            <label class="form-label">PIC:</label>
                                                        </div>
                                                        <div class="col-9">

                                                            <select name="ubah_pic" class="form-control">
                                                                <option value="">--Pilih PIC--</option>
                                                                <option selected value="<?= session('no_employee');?>"><?= session('nama');?> - <?= session('nama_role');?></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-2 col-12">
                                                    <div class="d-flex justify-between row">
                                                        <div class="col-3">
                                                            <label class="form-label">Tgl Pengajuan:</label>
                                                        </div>
                                                        <div class="col-9">
                                                            <input type="date" required name="ubah_tgl_pengajuan" value="<?= $k['tgl_pengajuan']; ?>" class="form-control" placeholder="Tulis Tanggal Pengajuan">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-2 col-12">
                                                    <div class="d-flex justify-between row">
                                                        <div class="col-3">
                                                            <label class="form-label">Tgl Rencana Selesai:</label>
                                                        </div>
                                                        <div class="col-9">
                                                            <input type="date" value="<?= $k['tgl_rencana_selesai']; ?>" required name="ubah_tgl_rencana_selesai" class="form-control" placeholder="Tulis Tanggal Rencana Selesai">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-2 col-12">
                                                    <div class="d-flex justify-between row">
                                                        <div class="col-3">
                                                            <label class="form-label">Tgl Actual Selesai:</label>
                                                        </div>
                                                        <div class="col-9 d-flex flex-column">
                                                            <div class="form-group mt-1">
                                                                <button type="button" id="toggleDisabledKaryawan<?= $no;?>" class="btn btn-sm btn-primary">Toggle Disabled Or Sabled</button>
                                                            </div>
                                                            <div class="form-group">
                                                                <input disabled id="ubahActualSelesaiKaryawan<?= $no;?>" type="date" value="<?= $k['tgl_actual_selesai']; ?>" required name="ubah_tgl_actual_selesai" class="form-control" placeholder="Tulis Tanggal Actual Selesai">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-12">
                                                    <div class="d-flex justify-between row">
                                                        <div class="col-3">
                                                            <label for="formFile" class="form-label">Foto : </label>
                                                        </div>
                                                        <div class="col-9">
                                                            <input class="form-control" type="file" id="formFile" name="ubah_photo">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-12">
                                                    <div class="d-flex justify-between row">
                                                        <div class="col-3">
                                                            <label class="form-label">Status : </label>
                                                        </div>
                                                        <div class="col-9">
                                                            <select name="ubah_status" class="form-control" id="ubahSelect" required>
                                                                <!-- <option value="">--Pilih Status--</option> -->
                                                                <?php if ($k['status_tugas'] == 'pengajuan_baru') { ?>
                                                                    <option value="pengajuan_baru" selected>Pengajuan Baru</option>
                                                                    <option value="dalam_pengerjaan">Dalam Pengerjaan</option>
                                                                    <option value="selesai">Selesai</option>
                                                                <?php } else if ($k['status_tugas'] == 'dalam_pengerjaan') { ?>
                                                                    <option value="dalam_pengerjaan" selected>Dalam Pengerjaan</option>
                                                                    <option value="selesai">Selesai</option>
                                                                <?php } else { ?>
                                                                    <option value="selesai" selected>Selesai</option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-12">
                                                    <div class="row d-flex justify-between">
                                                        <div class="col-3">
                                                            Hasil:
                                                        </div>
                                                        <div class="col-9">
                                                            <img src="<?= base_url() . '/uploads/' . $k['foto']; ?>" class="img-fluid zoom-gambar" width="150" height="150">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="button" class="btn btn-primary" onclick="<?= 'ubahSwalFormKaryawan' . $no . '()'; ?>">Ubah</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="examplePencarian" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cari Berdasarkan :</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-2">
                                        <label class="form-label">Permintaan Oleh: </label>
                                    </div>
                                    <div class="col-1">
                                        :
                                    </div>
                                    <div class="col-9">
                                        <input type="text" name="cari_nama" class="form-control" value="<?php if (isset($_GET['cari_nama'])) {
                                                                                                            echo  $_GET['cari_nama'];
                                                                                                        } ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-2">
                                        <label class="form-label">Tgl Pengajuan </label>
                                    </div>
                                    <div class="col-1">
                                        :
                                    </div>
                                    <div class="col-9">
                                        <input type="date" name="cari_tgl_pengajuan" class="form-control" value="<?php if (isset($_GET['cari_tgl_pengajuan'])) {
                                                                                                                        echo  $_GET['cari_tgl_pengajuan'];
                                                                                                                    } ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-2">
                                        <label class="form-label">Lokasi: </label>
                                    </div>
                                    <div class="col-1">
                                        :
                                    </div>
                                    <div class="col-9">
                                        <input type="text" name="cari_lokasi" class="form-control" value="<?php if (isset($_GET['cari_lokasi'])) {
                                                                                                                echo  $_GET['cari_lokasi'];
                                                                                                            } ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-2">
                                        <label class="form-label">PIC: </label>
                                    </div>
                                    <div class="col-1">
                                        :
                                    </div>
                                    <div class="col-9">
                                        <!-- <input type="text" name="cari_pic" class="form-control" value="<?php if (isset($_GET['cari_pic'])) {
                                                                                                                echo  $_GET['cari_pic'];
                                                                                                            } ?>" > -->
                                        <select name="cari_pic" class="form-control">
                                            <option value="">--Pilih PIC--</option>
                                            <?php foreach ($user as $k) { ?>
                                                <?php if ($k['nama_role'] == $role::ROLE_KARYAWAN) { ?>
                                                    <option value="<?= $k['no_employee']; ?>"><?= $k['nama']; ?> - <?= $k['nama_role']; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-2">
                                        <label class="form-label">Status: </label>
                                    </div>
                                    <div class="col-1">
                                        :
                                    </div>
                                    <div class="col-9">
                                        <!-- <input type="text" name="cari_pic" class="form-control" value="<?php if (isset($_GET['cari_pic'])) {
                                                                                                                echo  $_GET['cari_pic'];
                                                                                                            } ?>" > -->
                                        <select name="cari_status" class="form-control">
                                            <option value="">--Pilih Status--</option>
                                            <option value="pengajuan_baru">Pengajuan Baru</option>
                                            <option value="dalam_pengerjaan">Dalam Pengerjaan</option>
                                            <option value="selesai">Selesai</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Cari</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleDownload" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Download Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url() . '/admin/beranda/cari'; ?>">
                    <div class="d-flex row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Dari Tanggal: </label>
                                <input type="date" name="dari_tanggal" class="form-control">
                            </div>
                            <div class="form-group mt-1">
                                <label class="form-label">Pilih Status: </label>
                                <select name="pilih_status" class="form-control">
                                    <option value="semua">Semua</option>
                                    <option value="pengajuan_baru">Pengajuan Baru</option>
                                    <option value="dalam_pengerjaan">Dalam Pengerjaan</option>
                                    <option value="selesai">Selesai</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Sampai Tanggal: </label>
                                <input type="date" name="sampai_tanggal" class="form-control">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Download Laporan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><a class="fas fa-edit"></a> Tambah Pekerjaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formNambahKaryawan" action="<?= base_url('/karyawan/pengajuan/nambah'); ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="mb-3 col-12">
                            <div class="d-flex justify-between row">
                                <div class="col-3">
                                    <label class="form-label">ID Pengajuan</label>
                                </div>
                                <div class="col-5">
                                    <input type="text" required value="<?= $kode_otomatis; ?>" name="id_pengajuan" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 col-12">
                            <div class="d-flex justify-between row">
                                <div class="col-3">
                                    <label class="form-label">No Employee</label>
                                </div>
                                <div class="col-5">
                                    <input type="text" required value="<?= session('no_employee'); ?>" name="no_employee" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 col-12">
                            <div class="d-flex justify-between row">
                                <div class="col-3">
                                    <label class="form-label">Permintaan Oleh:</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" required value="<?= session('nama'); ?>" id="nama" name="nama" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="mb-2 col-12">
                            <div class="d-flex justify-between row">
                                <div class="col-3">
                                    <label class="form-label">Aktivitas Pekerjaan:</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" required name="aktivitas" class="form-control" placeholder="Tulis Aktivitas Pekerjaan">
                                </div>
                            </div>
                        </div>
                        <div class="mb-2 col-12">
                            <div class="d-flex justify-between row">
                                <div class="col-3">
                                    <label class="form-label">Deskripsi:</label>
                                </div>
                                <div class="col-9">
                                    <textarea class="form-control" required name="deskripsi" placeholder="Tulis Deskripsi"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="mb-2 col-12">
                            <div class="d-flex justify-between row">
                                <div class="col-3">
                                    <label class="form-label">Lokasi:</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" required name="lokasi" class="form-control" placeholder="Tulis Lokasi">
                                </div>
                            </div>
                        </div>
                        <div class="mb-2 col-12">
                            <div class="d-flex justify-between row">
                                <div class="col-3">
                                    <label class="form-label">PIC:</label>
                                </div>
                                <div class="col-9">
                                    <!-- <input type="text" required name="pic" class="form-control" placeholder="Tulis PIC"> -->
                                    <select name="pic" required class="form-control">
                                        <option value="">--PILIH PIC--</option>
                                        <option value="<?= session('no_employee');?>"><?= session('nama');?></option>
                                        <?php// foreach ($user as $k) { ?>
                                            <?php// if ($k['nama_role'] == $role::ROLE_KARYAWAN) { ?>
                                                <!-- <option value="<?php// $k['no_employee']; ?>"><?php // $k['nama']; ?> - <?php //$k['nama_role']; ?></option> -->
                                            <?php //} ?>
                                        <?php //} ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-2 col-12">
                            <div class="d-flex justify-between row">
                                <div class="col-3">
                                    <label class="form-label">Tgl Pengajuan:</label>
                                </div>
                                <div class="col-9">
                                    <input type="date" required name="tgl_pengajuan" class="form-control" placeholder="Tulis Tanggal Pengajuan">
                                </div>
                            </div>
                        </div>
                        <div class="mb-2 col-12">
                            <div class="d-flex justify-between row">
                                <div class="col-3">
                                    <label class="form-label">Tgl Rencana Selesai:</label>
                                </div>
                                <div class="col-9">
                                    <input type="date" required name="tgl_rencana_selesai" class="form-control" placeholder="Tulis Tanggal Rencana Selesai">
                                </div>
                            </div>
                        </div>
                        <div class="mb-2 col-12">
                            <div class="d-flex justify-between row">
                                <div class="col-3">
                                    <label class="form-label">Tgl Actual Selesai:</label>
                                </div>
                                <div class="col-9">
                                    <input type="date" disabled required name="tgl_actual_selesai" class="form-control" placeholder="Tulis Tanggal Actual Selesai">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 col-12">
                            <div class="d-flex justify-between row">
                                <div class="col-3">
                                    <label for="formFile" class="form-label">Foto : </label>
                                </div>
                                <div class="col-9">
                                    <input class="form-control" type="file" id="formFile" name="photo">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 col-12">
                            <div class="d-flex justify-between row">
                                <div class="col-3">
                                    <label class="form-label">Status : </label>
                                </div>
                                <div class="col-9">
                                    <select name="status" class="form-control" required>
                                        <option value="">--Pilih Status--</option>
                                        <option value="pengajuan_baru">Pengajuan Baru</option>
                                        <option value="dalam_pengerjaan">Dalam Pengerjaan</option>
                                        <option value="selesai">Selesai</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-md-12">
                            <div id="my_camera"></div>
                            <br />
                            <input type=button value="Take Snapshot" onClick="take_snapshot()">
                            <input type="hidden" name="image" id="image-tag">
                        </div>
                        <div class="col-md-12 mb-3">
                            <div id="results">Your captured image will appear here...</div>
                        </div> -->
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="nambahSwalKaryawanForm()">Kirim</button>
            </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>