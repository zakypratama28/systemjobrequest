<?php
namespace App\Libraries;
class Pdf {
 
    function __construct() {
        include_once APPPATH . '/ThirdParty/fpdf184/fpdf.php';
        include_once APPPATH . '/ThirdParty/TCPDF/tcpdf.php';
    }

    public function setPdf(){
        return new \FPDF('L', 'mm',[450,250]);
    }
}
?>