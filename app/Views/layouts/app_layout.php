<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" href="<?= base_url() . '/assets/img/logo.ico'; ?>" type="image" sizes="16x16">
    <title>System Job Request</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="<?= base_url() . '/assets/css/styles.css'; ?>" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--sweet alert-->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.23/dist/sweetalert2.min.css">
    <!--webcam-->


    <?php
    // ketika kursor diarahkan ke gambar pada modals ubah maka akan membesar dengan ukuran 2.5x dari gambar
    $uri = current_url(true);
    ?>
    <?php if ($uri->getSegment(3) == 'beranda') { ?>
        <style>
            .zoom-gambar:hover {
                transform: scale(2.5)
            }
        </style>
    <?php } ?>
    <?php

    use App\Models\PengajuanTugasKerjaModel;
    use App\Models\RoleModel;

    $pengajuan = new PengajuanTugasKerjaModel();
    $role = new RoleModel();
    ?>
</head>

<body class="sb-nav-fixed">
    <div id="layoutSidenav">
        <?= $this->include('includes/nav'); ?>
        <?= $this->include('includes/menu'); ?>
        <div id="layoutSidenav_content" style="background-color:#ECF3FF;">
            <?= $this->renderSection('content') ?>
        </div>

    </div>
    </div>
    </div>
    <!-- menampilkan alert pakai js dan php -->
    <?php if (session()->getFlashdata('success_title') && session()->getFlashdata('success_text')) { ?>
        <script>
            window.addEventListener('DOMContentLoaded', event => { //domcontentloaded ketika di refresh maka fungsi itu tersebut di eksekusi
                Swal.fire({
                    icon: 'success',
                    title: '<?= session()->getFlashdata('success_title'); ?>',
                    text: '<?= session()->getFlashdata('success_text'); ?>',
                })
            });
        </script>
    <?php } ?>
    <?php if (session()->getFlashdata('error_title') && session()->getFlashdata('error_text')) { ?>
        <script>
            window.addEventListener('DOMContentLoaded', event => {
                Swal.fire({
                    icon: 'error',
                    title: '<?= session()->getFlashdata('error_title'); ?>',
                    text: '<?= session()->getFlashdata('error_text'); ?>',
                })
            });
        </script>
    <?php } ?>
    <script>
        window.BASE_URL = '<?= base_url(); ?>'
        // Webcam.set({
        //     width: 490,
        //     height: 390,
        //     image_format: 'jpeg',
        //     jpeg_quality: 90
        // });

        // Webcam.attach('#my_camera');

        // function take_snapshot() {
        //     Webcam.snap(function(data_uri) {
        //         // $(".image-tag").val(data_uri);
        //         document.getElementById('image-tag').value = data_uri;
        //         document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';
        //     });
        // }

        function swalLogout() {
            Swal.fire({
                title: 'Apakah Anda Yakin',
                text: "Akan Log Out Akun?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#87B4DE;',
                cancelButtonColor: '#d33',
                confirmButtonText: 'YA!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "<?= base_url('/logout'); ?>"
                }
            })
        }

        function showSwalSelesai(status, id, name) {
            Swal.fire({
                title: 'Apakah Anda Yakin',
                text: "Bahwa Semua Status Akan Selesai?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#87B4DE;',
                cancelButtonColor: '#d33',
                confirmButtonText: 'YA!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `<?= base_url('/admin/pengajuan/ubah_progress_status/'); ?>/${status}/${id}`
                }
            })
        }

        function showSwalSelesaiKaryawan(status, id) {
            Swal.fire({
                title: 'Apakah Anda Yakin',
                text: "Bahwa Semua Status Akan Selesai?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#87B4DE;',
                cancelButtonColor: '#d33',
                confirmButtonText: 'YA!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `<?= base_url('/karyawan/pengajuan/ubah_progress_status/'); ?>/${status}/${id}`
                }
            })
        }
    </script>
    <script src="<?= base_url() . '/assets/js/jquery-3.3.1.min.js'; ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.23/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="<?= base_url() . 'assets/demo/chart-area-demo.js'; ?>"></script>
    <script src="<?= base_url() . 'assets/demo/chart-bar-demo.js'; ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="<?= base_url() . '/assets/js/datatables-simple-demo.js'; ?>"></script>
    <script>
        <?php
        $nama_pengajuan = isset($_GET['cari_nama']) ?? $_GET['cari_nama'];
        $tgl_pengajuan = isset($_GET['cari_tgl_pengajuan']) ?? $_GET['cari_tgl_pengajuan'];
        $lokasi = isset($_GET['cari_lokasi']) ?? $_GET['cari_lokasi'];
        $pic = isset($_GET['cari_pic']) ?? $_GET['cari_pic'];
        $status = isset($_GET['cari_status']) ?? $_GET['cari_status'];
        $l = $pengajuan->listPengajuan($nama_pengajuan, $tgl_pengajuan, $lokasi, false, $pic, $status);
        
        if (session('nama_role') == $role::ROLE_KARYAWAN) {
            $p = $pengajuan->listPengajuan($nama_pengajuan, $tgl_pengajuan, $lokasi, false, session('no_employee'), $status);
            $nol = 2;
            foreach ($p as $k) {
                echo 'function ubahSwalFormKaryawan' . $nol . '(){ ';
                echo "\n";
                echo 'Swal.fire({';
                echo "\n";
                echo    "title: 'Apakah Anda Yakin',";
                echo "\n";
                echo    'text: "Akan Mengubah Data Ini?",';
                echo "\n";
                echo     "icon: 'warning',";
                echo "\n";
                echo     "showCancelButton: true,";
                echo "\n";
                echo     "confirmButtonColor: '#87B4DE;',";
                echo "\n";
                echo     "cancelButtonColor: '#d33',";
                echo "\n";
                echo     "confirmButtonText: 'YA!'";
                echo "\n";
                echo     "}).then((result) => {";
                echo "\n";
                echo     "if (result.isConfirmed) {";
                echo "\n";
                echo     "document.getElementById('formUbahKaryawan" . $nol . "').submit()";
                echo "\n";
                echo     "}";
                echo "\n";
                echo "})";
                echo "\n";
                echo "}";
                echo "\n";
                $nol++;
            }
            ?>

        window.karyawanP = <?= count($p); ?>;
        <?php
        }
        ?>
        <?php
        $nop = 2;

        foreach ($l as $k) {
            echo 'function ubahSwalForm' . $nop . '(){ ';
            echo "\n";
            echo 'Swal.fire({';
            echo "\n";
            echo    "title: 'Apakah Anda Yakin',";
            echo "\n";
            echo    'text: "Akan Mengubah Data Ini?",';
            echo "\n";
            echo     "icon: 'warning',";
            echo "\n";
            echo     "showCancelButton: true,";
            echo "\n";
            echo     "confirmButtonColor: '#87B4DE;',";
            echo "\n";
            echo     "cancelButtonColor: '#d33',";
            echo "\n";
            echo     "confirmButtonText: 'YA!'";
            echo "\n";
            echo     "}).then((result) => {";
            echo "\n";
            echo     "if (result.isConfirmed) {";
            echo "\n";
            echo     "document.getElementById('formUbah" . $nop . "').submit()";
            echo "\n";
            echo     "}";
            echo "\n";
            echo "})";
            echo "\n";
            echo "}";
            echo "\n";
            $nop++;
        }
        ?>
        window.adminL = <?= count($l); ?>;
    </script>
    <script src="<?= base_url() . '/assets/js/scripts.js'; ?>"></script>
</body>

</html>