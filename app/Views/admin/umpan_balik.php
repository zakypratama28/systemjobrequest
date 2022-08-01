<?= $this->extend('layouts/app_layout') ?>

<?= $this->section('content') ?>
<style>
    /**tampilan penilaian bintang di halaman umpan balik */
    .rating {
        border: none;
        float: left;
    }


    .rating>input {
        display: none;
    }

    .rating>label:before {
        margin: 5px;
        font-size: 50px;
        font-family: FontAwesome;
        display: inline-block;
        /* border-radius: 50%; */
        /* background-color: #ddd; */
        content: "\f005";
        /* content: '\25CF'; */
    }

    .rating>.half:before {
        content: "\f089";
        position: absolute;
    }

    .rating>label {
        color: #ddd;
        float: right;
        margin-bottom: 0;
    }

    /* highlight stars on hover */

    .rating>input:checked~label,
    /* show gold star when clicked */
    .rating:not(:checked)>label:hover,
    /* hover current star */
    .rating:not(:checked)>label:hover~label {
        /* hover previous stars in list */
        color: #aaa;
    }

    .rating>input:checked+label:hover,
    /* hover current star when changing rating */
    .rating>input:checked~label:hover,
    .rating>label:hover~input:checked~label,
    /* lighten current selection */
    .rating>input:checked~label:hover~label {
        color: #999;
    }

    .rating.active>input:checked~label {
        color: #f2e93d;
    }

    .rating.active:hover>input:checked~label {
        color: #ddd;
    }

    .rating.active>input:checked+label:hover,
    /* hover current star when changing rating */
    .rating.active>input:checked~label:hover,
    .rating.active>label:hover~input:checked~label,
    /* lighten current selection */
    .rating.active>input:checked~label:hover~label {
        color: #f2e93d;
    }

    /**tampilan halaman umpan balik ketika dizoom, maximal zoom 500px */
    @media only screen and (max-width: 500px) {
        .rating>label:before {
            font-size: 30px;
        }
    }
</style>
<div class="container-fluid">

    <!-- Content Row -->
    <div class="row d-flex flex-column justify-content-center align-items-center">

        <!-- Mengambil data dari pengajuan tugas -->
        <div class="col-xl-8 col-md-12 mt-5 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center">Umpan Balik Pekerjaan</h1>
                    <form id="formUmpan" action="<?= base_url() . '/admin/pengajuan/beri_umpan_balik/' . $pengajuan['id_pengajuan']; ?>" method="post">
                        <!--memulai ngambil tabel dan menampilkan hasil dari pengajuan kerja dan menambahkan kolom untuk beri komentar umpan balik dan penilaian-->
                        <table class="table">
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td colspan="2"><?= $pengajuan['nama']; ?></td>
                            </tr>
                            <tr>
                                <td>Aktivitas</td>
                                <td>:</td>
                                <td colspan="2"><?= $pengajuan['activity']; ?></td>
                            </tr>
                            <tr>
                                <td>Deskripsi</td>
                                <td>:</td>
                                <td colspan="2"><?= $pengajuan['deskripsi']; ?></td>
                            </tr>
                            <tr>
                                <td>Lokasi</td>
                                <td>:</td>
                                <td><?= $pengajuan['lokasi']; ?></td>
                                <td rowspan="6">
                                    <img class="img-fluid" style="height:300px;width:300px;" src="<?= base_url() . '/uploads/' . $pengajuan['foto']; ?>">
                                <td>
                            </tr>
                            <tr>
                                <td>PIC</td>
                                <td>:</td>
                                <td><?= $pengajuan['penanggung_jawab']; ?></td>
                            </tr>
                            <tr>
                                <td>Tgl Pengajuan</td>
                                <td>:</td>
                                <td>
                                    <?php if ($pengajuan['tgl_pengajuan'] == NULL) {
                                        echo '-';
                                    } else {
                                        echo custom_date_tgl($pengajuan['tgl_pengajuan']);
                                    } ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Tgl Rencana Selesai</td>
                                <td>:</td>
                                <td>
                                    <?php if ($pengajuan['tgl_rencana_selesai'] == NULL) {
                                        echo '-';
                                    } else {
                                        echo custom_date_tgl($pengajuan['tgl_rencana_selesai']);
                                    } ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Tgl Actual Selesai</td>
                                <td>:</td>
                                <td>
                                    <?php if ($pengajuan['tgl_actual_selesai'] == NULL) {
                                        echo '-';
                                    } else {
                                        echo custom_date_tgl($pengajuan['tgl_actual_selesai']);
                                    } ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td><?= $pengajuan['status_tugas']; ?></td>
                            </tr>
                            <!-- end mengambil data dari tabel pengajuan dan status selesai-->
                            <tr>
                                <!--memulai menambahkan kolom untuk beri komentar umpan balik-->
                                <td colspan="2">Beri Umpan Balik</td>
                                <td colspan="2">
                                    <?php if ($pengajuan['umpan_balik'] == "") { ?>
                                        <textarea type="text" class="form-control" name="umpan" placeholder="Beri Umpan Balik" required></textarea>
                                    <?php } else { ?>
                                        <?= $pengajuan['umpan_balik']; ?>
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <!--memulai menambahkan kolom untuk memberikan penilaian kinerja-->
                                <td colspan="2" valign="middle">Beri Penilaian</td>
                                <td colspan="2">
                                    <fieldset class="rating <?php if ($pengajuan['rating'] > 0) {
                                                                echo 'active';
                                                            } ?>">
                                        <input type="radio" value="5" <?php if ($pengajuan['rating'] == 5 && $pengajuan['rating'] != null) {
                                                                            echo 'checked';
                                                                        } ?> class="rating-input" id="rating-input-1-5" name="rating-input-1" />
                                        <label for="rating-input-1-5" class="star"></label>

                                        <input type="radio" value="4" <?php if ($pengajuan['rating'] == 4 && $pengajuan['rating'] != null) {
                                                                            echo 'checked';
                                                                        } ?> class="rating-input" id="rating-input-1-4" name="rating-input-1" />
                                        <label for="rating-input-1-4" class="star"></label>

                                        <input type="radio" value="3" <?php if ($pengajuan['rating'] == 3 && $pengajuan['rating'] != null) {
                                                                            echo 'checked';
                                                                        } ?> class="rating-input" id="rating-input-1-3" name="rating-input-1" />
                                        <label for="rating-input-1-3" class="star"></label>

                                        <input type="radio" value="2" <?php if ($pengajuan['rating'] == 2 && $pengajuan['rating'] != null) {
                                                                            echo 'checked';
                                                                        } ?> class="rating-input" id="rating-input-1-2" name="rating-input-1" />
                                        <label for="rating-input-1-2" class="star"></label>

                                        <input type="radio" required value="1" <?php if ($pengajuan['rating'] == 1 && $pengajuan['rating'] != null) {
                                                                                    echo 'checked';
                                                                                } ?> class="rating-input" id="rating-input-1-1" name="rating-input-1" />
                                        <label for="rating-input-1-1" class="star"></label>
                                    </fieldset>
                                </td>
                            </tr>
                            <!--kolom akhir dari menambahkan kolom untuk beri komentar umpan balik dan penilaian-->
                        </table>
                        <!--button untuk menampilkan showswal pemberian umpan balik-->
                        <?php if ($pengajuan['rating'] == 0 && $pengajuan['umpan_balik'] == '') { ?>
                            <button type="button" onclick="showSwalUmpan()" class="float-end btn btn-primary">Kirim</button>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    //menampilkan modal utk menyetujui umpan balik
    function showSwalUmpan() {
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Akan Memberikan Umpan Balik dan Penilaian?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#87B4DE;',
            cancelButtonColor: '#d33',
            confirmButtonText: 'YA!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('formUmpan').submit();
            }
        })
    }
</script>
<?= $this->endSection() ?>