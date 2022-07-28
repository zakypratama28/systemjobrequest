<?= $this->extend('layouts/app_layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid">

     <!-- Content Row -->
     <div class="row d-flex flex-column justify-content-center align-items-center">

          <!-- Earnings (Monthly) Card Example -->
          <div class="col-xl-6 col-md-12 mt-5">
               <h1 class="text-center">Profile Saya</h1>
               <div class="form-group">
                    <label class="form-label">EE. No</label>
                    <input class="form-control" type="text" value="<?= $user['no_employee']; ?>" readonly>
               </div>
               <div class="form-group">
                    <label class="form-label">Role</label>
                    <input class="form-control" type="text" value="<?= session('nama_role'); ?>" readonly>
               </div>
               <div class="form-group">
                    <label class="form-label">Password</label>
                    <input class="form-control" type="text" value="<?= $user['password']; ?>" readonly>
               </div>
               <div class="form-group">
                    <label class="form-label">Nama</label>
                    <input class="form-control" type="text" value="<?= $user['nama']; ?>" readonly>
               </div>
               <div class="form-group">
                    <label class="form-label">Department</label>
                    <input class="form-control" type="text" value="<?= $user['department']; ?>" readonly>
               </div>
               <div class="form-group">
                    <label class="form-label">Jabatan</label>
                    <input class="form-control" type="text" value="<?= $user['jabatan']; ?>" readonly>
               </div>
               <div class="form-group mb-4">
                    <label class="form-label">Tahun Join</label>
                    <input class="form-control" type="text" value="<?= $user['tahun_masuk']; ?>" readonly>
               </div>
               <div class="form-group mb-4">
                    <label class="form-label">Tahun Habis Kontrak</label>
                    <input class="form-control" type="text" value="<?= $user['tahun_habis_kontrak']; ?>" readonly>
               </div>
               <div class="form-group mb-4">
                    <label class="form-label">Status</label>
                    <input class="form-control" type="text" value="<?= $user['status']; ?>" readonly>
               </div>
               <div class="d-flex justify-content-center align-items-center">
                    <?php

                    use App\Models\RoleModel as RLModel;

                    $role = new RLModel();
                    if (session('nama_role') == $role::ROLE_KARYAWAN) {
                    ?>
                         <a href="<?= base_url('karyawan/beranda'); ?>" class="btn btn-primary">Kembali</a>
                    <?php  } else { ?>
                         <a href="<?= base_url('admin/beranda'); ?>" class="btn btn-primary">Kembali</a>
                    <?php } ?>
               </div>
          </div>

     </div>
</div>

<?= $this->endSection() ?>