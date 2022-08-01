<?php

use App\Models\UserModel;

$user = new UserModel();
$pic = $user->getUser($penanggung_jawab, 'no_employee');
?>
<p>Hi, <?= $pic['nama']; ?></p>
<p>Anda mendapat permintaan pekerjaan baru.</p>

<table>
    <tr>
        <td>Permintaan Oleh</td>
        <td>:</td>
        <td><?= $ses_nama; ?></td>
    </tr>
    <tr>
        <td>Aktivitas Pekerjaan</td>
        <td>:</td>
        <td><?= $activity; ?> </td>
    </tr>
    <tr>
        <td>Deskripsi Pekerjaan</td>
        <td>:</td>
        <td><?= $deskripsi; ?></td>
    </tr>
    <tr>
        <td>Lokasi</td>
        <td>:</td>
        <td><?= $lokasi; ?></td>
    </tr>
    <tr>
        <td>PIC</td>
        <td>:</td>
        <td><?= $penanggung_jawab; ?></td>
    </tr>
    <tr>
        <td>Tgl Pengajuan</td>
        <td>:</td>
        <td>
            <?php if ($tgl_pengajuan == NULL) {
                echo '-';
            } else {
                echo custom_date_tgl($tgl_pengajuan);
            } ?>
        </td>
    </tr>
    <tr>
        <td>Tgl Rencana Selesai</td>
        <td>:</td>
        <td>
            <?php if ($tgl_rencana_selesai == NULL) {
                echo '-';
            } else {
                echo custom_date_tgl($tgl_rencana_selesai);
            } ?>
        </td>
    </tr>
    <!-- <tr>
        <td>Tgl Actual Selesai</td>
        <td>:</td>
        <td>
            <?php
            //  if ($k['tgl_actual_selesai'] == NULL) {
            //     echo '-';
            // } else {
            //     echo custom_date_tgl($k['tgl_actual_selesai']);
            // } 
            ?>
        </td>
    </tr> -->
    <!-- <tr>
        <td>Photo</td>
        <td>:</td>
        <td><?php // $penanggung_jawab; 
            ?></td>
    </tr> -->
    <tr>
        <td>Status</td>
        <td>:</td>
        <td><?= $status; ?></td>
    </tr>
</table>

<p>Tolong segera dilaksanakan dan harap perbarui pekerjaan di website beserta statusnya.</p>
<p>Terima kasih sebelumnya atas kerja sama anda</p>
<p><?= $ses_nama; ?></p>