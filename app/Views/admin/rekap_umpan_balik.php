<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Umpan Balik</title>
</head>
<body>
  <!--desain tampilan tabel untuk cetak pdf biar rapi window.print-->

  <style>

    
    @media print {

      table,
      td {
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

  <table class="table table-bordered">
    <tr>
      <td>Id Pengajuan</td>
      <td>:</td>
      <td><?= $pengajuan['id_pengajuan']; ?></td>
    </tr>
    <tr>
      <td>Nama</td>
      <td>:</td>
      <td><?= $pengajuan['nama_pengajuan']; ?></td>
    </tr>
    <tr>
      <td>Aktivitas</td>
      <td>:</td>
      <td><?= $pengajuan['activity']; ?></td>
    </tr> 
    <tr>
      <td>Deskripsi</td>
      <td>:</td>
      <td><?= $pengajuan['deskripsi']; ?></td>
    </tr>
    <tr>
      <td>Lokasi</td>
      <td>:</td>
      <td><?= $pengajuan['lokasi']; ?></td>
    </tr>
    <tr>
      <td>PIC</td>
      <td>:</td>
      <td><?= $pengajuan['nama']; ?></td>
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
      <td>Rencana Selesai</td>
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
      <td>Actual Selesai</td>
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

    <?php //mengubah ke base64 masukan ke dalam tag img(mengambil data dari pengajuan ke cetak pdf)
    $no = 1;
        $path =  ROOTPATH . 'public/uploads/' . $pengajuan['foto'];
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    ?>
      <td>Photo</td>
      <td>:</td>
        <td>
            <img src="<?= $base64; ?>" width="100" height="100">
        </td>
    </tr>
    <tr>
      <td>Status</td>
      <td>:</td>
      <td <?php $status = 'text-success'; ?> <?php if ($pengajuan['status_tugas'] == 'pengajuan_baru') { ?> <?php $status = 'text-danger'; ?> <?php } else if ($pengajuan['status_tugas'] == 'dalam_pengajuan') { ?> <?php $status = 'text-warning'; ?> <?php } ?> class="<?= $status; ?>"><?= $pengajuan['status_tugas']; ?></td>
    </tr>
    <tr>
        <td>Umpan Balik</td>
        <td>:</td>
        <td>
            <?= $pengajuan['umpan_balik'];?>
        </td>
    </tr>
    <tr>
        <td>Rating</td>
        <td>:</td>
        <td>
            <?php for ($i=1; $i < 6; $i++) {  ?>
            <?php if($i <= $pengajuan['rating']){ ?>
                <img style="width:10px;height:10px;" src="<?= base_url().'/assets/img/star-icon.svg';?>"/>
            <?php } else { ?>
                <img style="width:10px;height:10px;" src="<?= base_url().'/assets/img/star-line-yellow-icon.svg';?>"/>
            <?php } ?>
            <?php } ?>
            
        </td>
    </tr>
  </table>

  <script>
    // fitur javascript untuk mencetak data ke pdf
    window.print(); //cetak pdf
  </script>

</body>
</html>