<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  
    <style>
@media print {
  table, td {
    caption-side: bottom;
    border-collapse: collapse;
    width: 100%;
    margin-bottom: 1rem;
    color: #212529;
    vertical-align: top;
    /* border-color: #dee2e6; */
    border: 5px solid;
  }
}
    </style>
      <?php
        $dari = $dari != null ? custom_date_tgl($dari) : '-';
        $sampai = $sampai != null ? custom_date_tgl($sampai) : '-';
        $status = 'Semua';
        if ($pilih_status == 'pengerjaan_baru') {
            $status = 'Pengerjaan Baru';
        } else if($pilih_status == 'dalam_pengerjaan') {
            $status = 'Dalam Pengerjaan';
        } else if($pilih_status == 'selesai') {
            $status = 'Selesai';
        }
      ?>
   <table  class="table table-bordered">
        <tr>
          <td colspan="2">Dari Tanggal</td>
          <td colspan="2" valign="middle"><?= $dari; ?></td>
          <td colspan="7" rowspan="3"></td>
        </tr>
        <tr>
          <td colspan="2">Sampai Tanggal</td>
          <td colspan="2" valign="middle"><?= $sampai; ?></td>
        </tr>
        <tr>
          <td colspan="2">Status</td>
          <td colspan="2" valign="middle"><?= $status; ?>
        </tr>
        <tr>
            <td>No</td>
            <td>Nama</td>
            <td>Aktivitas</td>
            <td>Deskripsi</td>
            <td>Lokasi</td>
            <td>PIC</td>
            <td>Tgl Pengajuan</td>
            <td>Rencana Selesai</td>
            <td>Actual Selesai</td>
            <td>Photo</td>
            <td>Status</td>
        </tr>

        <?php 
            $no = 1;
            if (count($list) > 0) {
            foreach ($list as $k) { 
            $path =  ROOTPATH.'public/uploads/'.$k['foto'];
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $k['nama_pengajuan'];?></td>
            <td><?= $k['activity'];?></td>
            <td><?= $k['deskripsi'];?></td>
            <td><?= $k['lokasi'];?></td>
            <td><?= $k['nama'];?></td>
            <td><?=  custom_date_tgl($k['tgl_pengajuan']);?></td>
            <td><?= custom_date_tgl($k['tgl_rencana_selesai']);?></td>
            <td><?= custom_date_tgl($k['tgl_actual_selesai']);?></td>
            <td>
                <img src="<?= $base64; ?>" width="100" height="100">
            </td>
            <td 
                <?php $status = 'text-success';?>
                <?php if($k['status_tugas'] == 'pengajuan_baru') { ?>
                <?php $status = 'text-danger'; ?>
                <?php } else if($k['status_tugas'] == 'dalam_pengajuan') { ?>
                <?php $status = 'text-warning'; ?>
                <?php }?>
                class="<?= $status;?>"
            ><?= $k['status_tugas'];?></td>
        </tr>
    <?php }} else { ?>
        <tr>
            <td colspan="11" align="center">Data Tidak Ditemukan</td>
        </tr>
    <?php }?>
   </table> 

<script>
  window.print();
</script>

</body>
</html>