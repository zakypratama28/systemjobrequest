    <style>
table {
  caption-side: bottom;
  border-collapse: collapse;
}
.table{
  width: 100%;
  margin-bottom: 1rem;
  color: #212529;
  vertical-align: top;
  border-color: #dee2e6;
}
.table > :not(caption) > * > *{
  padding: 0.5rem 0.5rem;
  background-color: var(--bs-table-bg);
  border-bottom-width: 1px;
  box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
}
.table > tbody, .dataTable-table > tbody {
  vertical-align: inherit;
}
.table > thead, .dataTable-table > thead {
  vertical-align: bottom;
} .table > :not(:last-child) > :last-child > *, .dataTable-table > :not(:last-child) > :last-child > * {
  border-bottom-color: currentColor;
}
.table-bordered > :not(caption) > *, .dataTable-table > :not(caption) > * {
  border-width: 1px 0;
}
.table-bordered > :not(caption) > * > *, .dataTable-table > :not(caption) > * > * {
  border-width: 0 1px;
}
    </style>
   <table class="table table-bordered">
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
            <td><?= $k['penanggung_jawab'];?></td>
            <td><?=  custom_date_tgl($k['tgl_pengajuan']);?></td>
            <td><?= custom_date_tgl($k['tgl_rencana_selesai']);?></td>
            <td><?= custom_date_tgl($k['tgl_actual_selesai']);?></td>
            <td>
                <img src="<?= $base64; ?>" width="100" height="100">
            </td>
            <td 
                <?php $status = 'text-success';?>
                <?php if($k['status'] == 'pengajuan_baru') { ?>
                <?php $status = 'text-danger'; ?>
                <?php } else if($k['status'] == 'dalam_pengajuan') { ?>
                <?php $status = 'text-warning'; ?>
                <?php }?>
                class="<?= $status;?>"
            ><?= $k['status'];?></td>
        </tr>
    <?php }} else { ?>
        <tr>
            <td colspan="11" align="center">Data Tidak Ditemukan</td>
        </tr>
    <?php }?>
   </table> 