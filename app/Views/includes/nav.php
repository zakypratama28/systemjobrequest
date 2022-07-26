<?php
use App\Models\RoleModel as RLModel;
$role = new RLModel();
?>
<style>
.icon{cursor: pointer;margin-right: 30px; margin-top: 5px;}
.icon span{background: #f00;padding: 7px;border-radius: 50%;color: #fff;vertical-align: top;margin-left: -25px}
.icon img{display: inline-block;width: 26px;margin-top: 4px}
.icon:hover{opacity: .7}.logo{flex: 1;margin-left: 50px;color: #eee;font-size: 20px;font-family: monospace}
.notifications{display: none;width: 250px;height: 0px;opacity: 0;position: absolute;top: 63px;right: 180px;border-radius: 5px 0px 5px 5px;background-color:#5091CF;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); color: #fff;}
.notifications h2{font-size: 14px;padding: 10px;border-bottom: 1px solid #eee;color: #fff}
.notifications h2 span{color: red}
.notifications-item{background-color: #fff;border-bottom: 1px solid #eee;padding: 6px 9px;margin-bottom: 0px;cursor: pointer}
.notifications-item:hover{background-color: #eee}
.notifications-item img{display: block;width: 50px;height: 50px;margin-right: 9px;border-radius: 50%;margin-top: 2px}
.notifications-item .text label{color: #aaa;font-size: 12px}
.notifications-item .text span{color:black;font-size: 12px}
</style>
    <nav class="sb-nav-fixed sb-topnav navbar navbar-expand navbar-dark bgfooter">
        <!-- Navbar Brand-->
        <a 
            <?php if(session('nama_role') == $role::ROLE_ADMIN) { ?>
            href="<?= base_url().'/admin/beranda';?>"
            <?php } else { ?>
            href="<?= base_url().'/karyawan/beranda';?>"
            <?php } ?>
        ><img src="<?= base_url().'/assets/img/logo.png';?>" alt="" width="200" height="55" class=""></a>

        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

        <!-- Navbsssar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        </form>
        <!-- Navccccbadffjsadsxzcrygygygybhuub-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <div class="nav-item icon position-relative" id="bell"> 
                <img src="<?= base_url().'/assets/img/bell.png';?>" alt="">
                <span id="countIcon" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    0+
                    <span class="visually-hidden">unread messages</span>
                </span> 
            </div>
                <div class="notifications" id="box">
                    <h2>Notifications - <span id="countNotif">0</span></h2>
                    <div id="item-notifikasi" class="notifications-item">
                        <div class="text">
                            <label>Tanggal Kosong</label><br>
                            <span>Data Kosong</span>
                        </div>
                    </div>
                    <!-- <div class="notifications-item"> 
                        <div class="text">
                            <p>September 12, 2021</p>
                            <span>Data pengajuan pekerjaan dari karyawan jono telah diubah</span>
                        </div>
                    </div>
                    <div class="notifications-item"> 
                        <div class="text">
                            <p>September 12, 2021</p>
                            <span>Status pekerjaan dari karyawan jono selesai</span>
                        </div>
                    </div> -->
                </div>
            <li class="nav-item dropdown">
                <a class="me-3 btn btn-secondary dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Hi, <?= session('nama');?><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <?php if(session('nama_role') == $role::ROLE_ADMIN){ ?>
                    <li><a class="dropdown-item" href="<?= base_url('/admin/profile');?>">Profile</a></li>
                    <?php } else { ?>
                    <li><a class="dropdown-item" href="<?= base_url('/karyawan/profile');?>">Profile</a></li>
                    <?php } ?>
                    <li><a class="dropdown-item" href="javascript:void" onclick="swalLogout()">Logout</a></li>
                </ul>
            </li>
        </ul>

    </nav>


<script>
  var down = false;
  var bell = document.getElementById('bell');
  var box = document.getElementById('box');
  bell.addEventListener('click',(e) => {

    if(down){
        
        box.style.height = '0px';
        box.style.opacity = 0;
        box.style.display = 'none';
        down = false;
    }else{
        
        box.style.height = 'auto';
        box.style.opacity = '1';
        box.style.display = 'block';
        down = true;
    }
  })
</script>