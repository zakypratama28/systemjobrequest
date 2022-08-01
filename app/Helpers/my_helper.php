<?php
// ketika user akan menginputkan kosakata maka tidak perlu mengetik dengan panjang. cukup memanggil function.
function alert_custom($session_name, $color)
// custom session tidak perlu ketik panjang cukup panggil function di folder view
{
    if (session()->getFlashdata($session_name)) {
        echo '<div class="alert alert-' . $color . ' alert-dismissible fade show" role="alert">';
        echo session()->getFlashdata($session_name);
        echo '</div>';
    }
}

function custom_date_tgl($date) // terletak di beranda daftar pekerjaan
{
    return date('d-M-y', strtotime($date));
}
