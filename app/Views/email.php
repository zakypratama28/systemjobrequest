<?php
use App\Models\UserModel;
$user = new UserModel();
$pic = $user->getUser($penanggung_jawab,'no_employee');
?>
<p>Hi, <?= $pic['nama'];?></p>
<p>We have new request from facility</p>

<table>
    <tr>
        <td>Requested by</td>
        <td>:</td>
        <td><?= $ses_nama;?></td>
    </tr>
    <tr>
        <td>Activity</td>
        <td>:</td>
        <td><?= $activity; ?> </td>
    </tr>
    <tr>
        <td>Description</td>
        <td>:</td>
        <td><?= $deskripsi; ?></td>
    </tr>
    <tr>
        <td>Location</td>
        <td>:</td>
        <td><?= $lokasi; ?></td>
    </tr>
</table>

<p>Please update the request immediately</p>
<p>Thanks in advance for your cooperation</p>
<p>Kind Regards</p>
<p><?= $ses_nama; ?></p>