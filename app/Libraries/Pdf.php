<?php

namespace App\Libraries;

class Pdf
{ //libraries ini tidak digunakan, tidak menggunakan fpdf/tcpdf. menggunakan window.print

    function __construct()
    {
        include_once APPPATH . '/ThirdParty/fpdf184/fpdf.php';
        include_once APPPATH . '/ThirdParty/TCPDF/tcpdf.php';
    }

    public function setPdf()
    {
        return new \FPDF('L', 'mm', [450, 250]);
    }
}
