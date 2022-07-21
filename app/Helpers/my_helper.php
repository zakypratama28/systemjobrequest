<?php
function alert_custom($session_name,$color){
    if (session()->getFlashdata($session_name)){
        echo '<div class="alert alert-'.$color.' alert-dismissible fade show" role="alert">';
        echo session()->getFlashdata($session_name);
        echo '</div>';
    }
}