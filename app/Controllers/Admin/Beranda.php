<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PengajuanTugasKerjaModel;
use App\Libraries\Email as SendEmail;
use App\Libraries\Pdf;

class Beranda extends BaseController
{
    public function __construct()
    {
        helper(['my_helper']);
        $this->pengajuanTugas = new PengajuanTugasKerjaModel();
    }

    public function index()
    {
        $nama_pengajuan = $this->request->getGet('cari_nama');
        $tgl_pengajuan = $this->request->getGet('cari_tgl_pengajuan');
        $lokasi = $this->request->getGet('cari_lokasi');
        $data['list'] = $this->pengajuanTugas->listPengajuan($nama_pengajuan,$tgl_pengajuan,$lokasi);
        $data['pengajuan_baru'] = $this->pengajuanTugas->countAllOrRow('pengajuan_baru','status');
        $data['dalam_pengerjaan'] = $this->pengajuanTugas->countAllOrRow('dalam_pengerjaan','status');
        $data['selesai'] = $this->pengajuanTugas->countAllOrRow('selesai','status');
        return view('admin/beranda',$data);
    }

    public function cari()
    {
        $dari = $this->request->getGet('dari_tanggal');
        $pilih_status = $this->request->getGet('pilih_status');
        $sampai = $this->request->getGet('sampai_tanggal');
        $list = $this->pengajuanTugas->cari($dari,$pilih_status,$sampai);
        // $view_html = view('admin/cari',$data);
        $dari = $dari != null ? custom_date_tgl($dari) : '-';
        $sampai = $sampai != null ? custom_date_tgl($sampai) : '-';
        $status = 'Semua';
        if ($pilih_status == 'pengerjaan_baru') {
            $status = 'Pengerjaan Baru';
        } else if($pilih_status == 'dalam_pengerjaan') {
            $status = 'Dalam Pengerjaan';
        } else if($pilih_status == 'selesai') {
            $status = 'Selesai';
        }
        
        $model = new Pdf();
        $pdf = $model->setPdf();
        $pdf->AddPage();

        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(360,7,'Laporan Pekerjaan',0,1,'C');
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(50,7,'Dari Tanggal',1,0,'L');
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(70,7,$dari,1,0,'C');
        $pdf->Cell(260,21,'',1,1,'C');
        $pdf->SetY(24);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(50,7,'Sampai Tanggal',1,0,'L');
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(70,7,$sampai,1,1,'C');
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(50,7,'Status',1,0,'L');
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(70,7,$status,1,1,'C');
        $pdf->SetFont('Arial','B',12);
		$pdf->Cell(10,6,'No',1,0,'C');
		$pdf->Cell(40,6,'Nama',1,0,'L');
		$pdf->Cell(40,6,'Aktivitas',1,0,'C');
		$pdf->Cell(30,6,'Deskripsi',1,0,'C');
		$pdf->Cell(30,6,'Lokasi',1,0,'C');
		$pdf->Cell(30,6,'PIC',1,0,'C');
		$pdf->Cell(40,6,'Tgl Pengajuan',1,0,'C');
		$pdf->Cell(40,6,'Rencana Selesai',1,0,'C');
		$pdf->Cell(40,6,'Actual Selesai',1,0,'C');
		$pdf->Cell(40,6,'Photo',1,0,'C');
		$pdf->Cell(40,6,'Status',1,1,'C');

		$pdf->SetFont('Arial','',12);
		$no=0;
        if (count($list) > 0) {
            $list_image = [];
            foreach ($list as $data){
                $no++;
                // $img = './uploads/'.$data['foto'];
                // var_dump($img);
                // $m = $pdf->Image(,318 * $no,45 * $no,25);
                $m = $pdf->Image('./uploads/'.$data['foto'],318 * $no,45* $no,25);
                $pdf->Cell(10,30,$no,1,0, 'C');
                $pdf->Cell(40,30,$data['nama_pengajuan'],1,0, 'L');
                $pdf->Cell(40,30,$data['activity'],1,0, 'C');
                $pdf->Cell(30,30,$data['deskripsi'],1,0, 'C');
                $pdf->Cell(30,30,$data['lokasi'],1,0, 'C');
                $pdf->Cell(30,30,$data['penanggung_jawab'],1,0, 'C');
                $pdf->Cell(40,30,custom_date_tgl($data['tgl_pengajuan']),1,0,'C');
                $pdf->Cell(40,30,custom_date_tgl($data['tgl_rencana_selesai']),1,0,'C');
                $pdf->Cell(40,30,custom_date_tgl($data['tgl_actual_selesai']),1,0,'C');
                $pdf->Cell(40,30,$m,1,0,'C');
                $pdf->Cell(40,30,$data['status'],1,1,'C');
            }
        }else {
            $pdf->Cell(380,30,'Data Tidak Ditemukan',1,1,'C');
        }
        $pdf->Output('D','Laporan-'.date('Y-m-d').'-'.time().'.pdf');
    }
}
