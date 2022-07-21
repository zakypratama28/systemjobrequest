<?= $this->extend('layouts/app_layout') ?>

<?= $this->section('content') ?>
                <div class="container-fluid px-4 mt-5">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Task Dashboard</h1>

                    </div>

                    <?php alert_custom('error','danger');?>
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
                                            <div class="h5 mb-0 font-weight-bold text-danger">20</div>
                                        </div>
                                        <div class="col-auto">
                                            <a href="..."> <img src="<?= base_url().'/assets/img/baru.png';?>" width="70" height="70"></a>
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
                                            <div class="h5 mb-0 font-weight-bold text-warning">15</div>
                                        </div>
                                        <div class="col-auto">
                                            <a href="..."> <img src="<?= base_url().'/assets/img/progres.png';?>" width="70" height="70"></a>
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
                                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Selesai
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-success">1</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <a href="..."> <img src="<?= base_url().'/assets/img/complete.png';?>" width="70" height="70"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4 py-2">
                        <div class="d-flex justify-content-between ">
                            <div>
                                <button type="button" class=" btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">
                                    Add New Task</button>
                                
                                <a href="javascript:void" data-bs-toggle="modal" data-bs-target="#exampleDownload" data-bs-whatever="@getbootstrap" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                    <i class="fas fa-download fa-sm text-white-50"></i> Download Record</a>
                            </div>
                            <div >
                                <a href="javascript:void" data-bs-toggle="modal" data-bs-target="#examplePencarian" data-bs-whatever="@getbootstrap" class="btn btn-sm btn-info shadow-sm">
                                    <i class="fas fa-search fa-sm text-white-50"></i> Pencarian</a>
                            </div>
                        </div>

                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            DataTable Example
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr class="bg-warning">
                                        <th scope="col">Edit/Delete</th>
                                        <th>No</th>
                                        <th>Request</th>
                                        <th>Activity</th>
                                        <th>Location</th>
                                        <th>Date Request</th>
                                        <th>Due Date</th>
                                        <th>Action</th>
                                        <th>PIC</th>
                                        <th>Status</th>
                                        <th>Photo</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th scope="col">Edit/Delete</th>
                                        <th>No</th>
                                        <th>Request</th>
                                        <th>Activity</th>
                                        <th>Location</th>
                                        <th>Date Request</th>
                                        <th>Due Date</th>
                                        <th>Action</th>
                                        <th>PIC</th>
                                        <th>Status</th>
                                        <th>Photo</th>
                                    </tr>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <tr>
                                        <td>
                                            <a href="editdata.php"><span class="fas fa-edit bg-success p-1 text-white rounded"></span></a>
                                            <a href="#"><span class="fas fa-trash-alt bg-danger p-1 text-white rounded" onclick="deleteData()"></span></a>
                                        </td>
                                        <td>1</td>
                                        <td>Hanny</td>
                                        <td>Repair Lamp</td>
                                        <td>Nijo Room</td>
                                        <td>02/09/2021</td>
                                        <td>03/09/2021</td>
                                        <td>Internal</td>
                                        <td>Zaky</td>
                                        <td class="text-warning">On Progres</td>
                                        <td><a href=""><img src="assets/img/Mechanical.png" width="100" height="100"></a></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="editdata.php"><span class="fas fa-edit bg-success p-1 text-white rounded"></span></a>
                                            <a href="#"><span class="fas fa-trash-alt bg-danger p-1 text-white rounded" onclick="deleteData()"></span></a>
                                        </td>
                                        <td>2</td>
                                        <td>Hanny</td>
                                        <td>Repair Lamp</td>
                                        <td>Nijo Room</td>
                                        <td>02/09/2021</td>
                                        <td>03/09/2021</td>
                                        <td>Internal</td>
                                        <td>Ilham</td>
                                        <td class="text-warning">On Progres</td>
                                        <td><img src="assets/img/facility.png" width="100" height="100"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="editdata.html"><span class="fas fa-edit bg-success p-1 text-white rounded"></span></a>
                                            <a href="#"><span class="fas fa-trash-alt bg-danger p-1 text-white rounded" onclick="deleteData()"></span></a>
                                        </td>
                                        <td>3</td>
                                        <td>Hanny</td>
                                        <td>Repair Lamp</td>
                                        <td>Nijo Room</td>
                                        <td>02/09/2021</td>
                                        <td>03/09/2021</td>
                                        <td>Internal</td>
                                        <td>Rokki</td>
                                        <td class="text-warning">On Progres</td>
                                        <td><img src="assets/img/Purchase.png" width="100" height="100"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="editdata.html"><span class="fas fa-edit bg-success p-1 text-white rounded"></span></a>
                                            <a href="#"><span class="fas fa-trash-alt bg-danger p-1 text-white rounded" onclick="deleteData()"></span></a>
                                        </td>
                                        <td>4</td>
                                        <td>Ilham</td>
                                        <td>Repair Lamp</td>
                                        <td>Nijo Room</td>
                                        <td>02/09/2021</td>
                                        <td>03/09/2021</td>
                                        <td>Internal</td>
                                        <td>Zaky</td>
                                        <td>On Progres</td>
                                        <td><img src="assets/img/Electrical.png" width="100" height="100"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

<div class="modal fade" id="examplePencarian" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cari Berdasarkan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-2">
                                        <label class="form-label">Nama: </label>
                                    </div>
                                    <div class="col-1">
                                        :
                                    </div>
                                    <div class="col-9">
                                        <input type="text" name="nama" class="form-control" >
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
                                        <input type="date" name="nama" class="form-control" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-2">
                                        <label class="form-label">Lokasi: </label>
                                    </div>
                                    <div class="col-1">
                                        :
                                    </div>
                                    <div class="col-9">
                                        <input type="text" name="lokasi" class="form-control" >
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary">Cari</button>
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
                <form>
                <div class="d-flex row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Dari Tanggal: </label>
                                <input type="date" name="dari" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label class="form-label">Pilih Status: </label>
                                <select name="status" class="form-control">
                                    <option value="semua">Semua</option>
                                    <option value="pekerjaanbaru">Pekerjaan Baru</option>
                                    <option value="dalampengerjaan">Dalam Pengerjaan</option>
                                    <option value="selesai">Selesai</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Sampai Tanggal: </label>
                                <input type="date" name="sampai" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label class="form-label">Hasil Cetakan: </label>
                                <select name="cetakan" class="form-control">
                                    <option value="pdf">PDF</option>
                                    <option value="excel">EXCEL</option>
                                </select>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CLOSE</button>
                <button type="button" class="btn btn-primary">Download Laporan</button>
                    </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Activity
                            : </label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="mb-2">
                        <label for="exampleFormControlTextarea1" class="form-label">Location
                            : </label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="1"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Photo : </label>
                        <input class="form-control" type="file" id="formFile">
                    </div>
                    <div class="col-md-6">
                        <div id="my_camera"></div>
                        <br />
                        <input type=button value="Take Snapshot" onClick="take_snapshot()">
                        <input type="hidden" name="image" class="image-tag">
                    </div>
                    <div class="col-md-6">
                        <div id="results">Your captured image will appear here...</div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CLOSE</button>
                <button type="button" class="btn btn-primary">SUBMIT</button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>