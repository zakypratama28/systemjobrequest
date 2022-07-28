/*!
    * Start Bootstrap - SB Admin v7.0.3 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2021 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    // 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});

let formNambahAdmin = document.getElementById('formNambah');
function nambahSwalForm(){
    Swal.fire({
        title: 'Apakah Anda Yakin',
        text: "Anda Yakin Menambahkan Ini ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#87B4DE;',
        cancelButtonColor: '#d33',
        confirmButtonText: 'OK!'
    }).then((result) => {
        if (result.isConfirmed) {
            formNambahAdmin.submit()
        }
    })
}

let formNambahKaryawan = document.getElementById('formNambahKaryawan');
function nambahSwalKaryawanForm(){
    Swal.fire({
        title: 'Apakah Anda Yakin',
        text: "Anda Yakin Menambahkan Ini ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#87B4DE;',
        cancelButtonColor: '#d33',
        confirmButtonText: 'OK!'
    }).then((result) => {
        if (result.isConfirmed) {
            formNambahKaryawan.submit()
        }
    })
}
function getSelectUbah(seletedObject,id,name)
{
    if (name == 'admin') {
        let value = seletedObject.value
        window.location.href=`${window.BASE_URL}/admin/pengajuan/ubah_progress_status/${value}/${id}`;
    }
}

function getSelectUbahKaryawan(seletedObject,id,name)
{
    if (name == 'karyawan') {
        let value = seletedObject.value
        window.location.href=`${window.BASE_URL}/karyawan/pengajuan/ubah_progress_status/${value}/${id}`;
    }
}

for (i = 0; i < document.getElementsByClassName('rating-input').length; i++) {
    document.getElementsByClassName('rating-input')[i].onclick = (e) => {
        const self = this
        document.getElementsByClassName('rating')[0].classList.add('active')
        console.log(document.querySelector('input[name="rating-input-1"]:checked').value)
    }
}

function fetchNotif()
{
    // console.log('a');
    $.getJSON(`${window.BASE_URL}/baca-notifikasi`, function(result){
        console.log(result);
        $('#countIcon').html(result[0]);
        $('#countNotif').html(result[0]);
        if (result[1].list.length > 0) {
            let html = ''
            $.each(result[1].list, function(i, field){
                // $("div").append(field + " "); 
                html += '<div class="notifications-item" onmouseout="goneNotif(this,'+ field.id_notifikasi +')">'
                html += '<div class="text d-flex flex-column">'
                html += '<label>'+ field.tanggal+'</label></br>';
                html +=  '<span>'+field.pesan +'</span>'
                html += '</div>'
                html += '</div>'
            });

            $('#item-notifikasi').html(html);
        }else{
            let html = ''
                html += '<div class="notifications-item">' 
                html += '<div class="text d-flex flex-column">'
                html += '<label>Tanggal Kosong</label></br>';
                html +=  '<span>Data Kosong</span>'
                html += '</div>'
                html += '</div>'
            $('#item-notifikasi').html(html);
        }
    });
}

function goneNotif(p,id)
{
  console.log('notif')
   $.ajax({
        url: window.BASE_URL + '/sudah-baca-notifikasi/'+ id,
        type: "get",
        data: null,
        success: function(result) {
            setTimeout(() => {
                p.style.display = 'none';
                fetchNotif()
            },60000)
        },
   });
}
setInterval(fetchNotif,5000)