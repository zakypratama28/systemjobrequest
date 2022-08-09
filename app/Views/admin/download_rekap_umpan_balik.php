<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
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

  <?php // mengambil data cetak pdf berdasarkan rentang waktu dan status
  $dari = $dari != null ? custom_date_tgl($dari) : '-';
  $sampai = $sampai != null ? custom_date_tgl($sampai) : '-';
  ?>
  <table class="table table-bordered">
    <tr>
      <td colspan="2">Dari Tanggal</td>
      <td colspan="2" valign="middle"><?= $dari; ?></td>
      <td colspan="9" rowspan="3"></td>
    </tr>
    <tr>
      <td colspan="2">Sampai Tanggal</td>
      <td colspan="2" valign="middle"><?= $sampai; ?></td>
    </tr>
    <tr>
      <td colspan="2">Status</td>
      <td colspan="2" valign="middle">Selesai</td>
    </tr>
    <tr>
      <td>ID Pengajuan</td>
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
      <td>Umpan Balik</td>
      <td>Rating</td>
    </tr>

    <?php //mengubah ke base64 masukan ke dalam tag img(mengambil data dari pengajuan ke cetak pdf)
    $no = 1;
    // var_dump($list);
    if (count($list) > 0) {
      foreach ($list as $k) {
        $path =  ROOTPATH . 'public/uploads/' . $k['foto'];
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    ?>
        <tr>
          <td><?= $k['id_pengajuan']; ?></td>
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
            <img src="<?= $base64; ?>" width="100" height="100">
          </td>
          <td class="text-success"><?= $k['status_tugas']; ?></td>
          <td>
            <?= $k['umpan_balik'];?>
          </td>
          <td>
            <?php for ($i=1; $i < $k['rating'] + 1; $i++) {  ?>
            <?php if($i <= $k['rating']){ ?>
                <img style="width:10px;height:10px;" src="<?= base_url().'/assets/img/star-icon.svg';?>"/>
            <?php } else { ?>
                <img style="width:10px;height:10px;" src="<?= base_url().'/assets/img/star-line-yellow-icon.svg';?>"/>
            <?php } ?>
            <?php } ?>
          </td>
        </tr>
      <?php }?>

    <?php
    // var_dump($jumlahDanRata);
    ?>
    <tr>
        <td colspan="12" align="center">Jumlah</td>
        <td><?php echo $jumlahDanRata['jmlh_rating'];?><td>
    </tr>
    <tr>
        <td colspan="12" align="center">Rata-Rata</td>
        <td><?php echo (int) $jumlahDanRata['rata_rating'];?><td>
    </tr>
    <?php } else { ?>
      <tr>
        <td colspan="13" align="center">Data Tidak Ditemukan</td>
      </tr>
    <?php } ?>
  </table>

  <script>
    // fitur javascript untuk mencetak data ke pdf
    window.print(); //cetak pdf
  </script>

</body>

</html>