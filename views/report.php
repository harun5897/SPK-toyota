<?php
session_start();
require('../FPDF/fpdf.php');

if($_SESSION['loginStatus'] != 1) {
    header('location: index.php?s');
  }

class myPDF extends FPDF {
  function header()
  {
    include_once('../modules/Connection.php');
    include_once('../modules/Module.php');
    include_once('../modules/LoginAccess.php');

    $this->SetFont('Arial', 'B', 18);
    $this->cell(0,0, 'AGUNG TOYOTA', 0, 0, 'C');
    $this->ln();
    $this->SetFont('Arial', 'B', 12);
    $this->cell(0,20, 'JL. Daeng Celak Km 8 Sei Carang Air Raja, Air Raja, Kec. Tanjungpinang Tim., Kota Tanjung Pinang, Kepulauan Riau 29123.', 0, 0, 'C');
    $this->Line(5, 30, 290, 30);
    $this->ln();
    $this->SetFont('Arial', 'B', 18);
    $this->cell(0,20, 'Laporan Tingkat Kepuasan Pelanggan', 0, 0, 'C');
    $this->ln();

    $this->SetFont('Arial', 'B', 14);
    $this->Cell(15, 10, 'No', 1,0, 'C');
    $this->Cell(90, 10, 'Nama Pemilik', 1,0,'C');
    $this->Cell(80, 10, 'Total Nilai', 1,0, 'C');
    $this->Cell(80, 10, 'Keterangan', 1,0, 'C');

    $rowcountKriteria = mysqli_query($connection, "SELECT * FROM kriteria");
    $rowcount = mysqli_num_rows($rowcountKriteria);
    $no = 0;
    $persentase = [];
    $dataCustomer = mysqli_query($connection, "SELECT * FROM customers");
    while($arrDataCustomer = mysqli_fetch_array($dataCustomer)) :
      $no++;
      $idCustomer = $arrDataCustomer['idCustomer'];
      $dataPenilaian = mysqli_query($connection, "SELECT * FROM `penilaian` WHERE `idCustomer` = '$idCustomer' ");
      $arrDataPenilaian = mysqli_fetch_array($dataPenilaian);
      if(isset($arrDataPenilaian['idCustomer'])){
        $this->ln();
        $this->SetFont('Arial', '', 14);
        $this->Cell(15, 10, $no, 1,0, 'C');
        $this->Cell(90, 10, $arrDataCustomer['namaDepan'], 1,0,'C');
        $id_no = 0;
        $jumlah = [];
        $dataPenilaian = mysqli_query($connection, "SELECT * FROM `penilaian` WHERE `idCustomer` = '$idCustomer' order by idPenilaian desc limit $rowcount ");
        while($arrDataPenilaian = mysqli_fetch_array($dataPenilaian)):
          $normalisasi = getNormalisasi($connection, $arrDataPenilaian['nilai'], $arrDataPenilaian['idKriteria']);
          $matriksTertimbang = getMatriksTertimbang($connection, $arrDataPenilaian['idKriteria'], $normalisasi);
          $nilaiElemen = perhitunganElemen($matriksTertimbang, $id_no);
          array_push($jumlah, $nilaiElemen);
        $id_no++;
        endwhile;
        $this->Cell(80, 10, array_sum($jumlah), 1,0,'C');
        if(array_sum($jumlah) > 1) {
          array_push($persentase, 1);
          $this->Cell(80, 10, 'PUAS', 1,0,'C');
        }
        else {
          array_push($persentase, 0);
          $this->Cell(80, 10, 'TIDAK PUAS', 1,0,'C');
        }
      }
    endwhile;
    $output = array_filter($persentase, function($value) {
      return $value == 1;
    });
    $this->ln();
    $this->ln();
    $this->SetFont('Arial','', 14);
    $this->cell(0,0, 'Persentase Kepuasan Pelanggan '. count($output)/count($persentase) * 100 . '%', 0, 0, 'L');
  }
  function Footer()
  {
    // FUNC DATE
    date_default_timezone_set('Asia/Jakarta');
    $date = date('d-m-Y');
    $d = 'Tanjung Pinang, '.$date;
    
    $this->SetY(-27);
    // $this->ln();
    $this->SetFont('Arial','', 14);
    $this->cell(247,-18, 'Mengetahui,', 0, 0, 'R');
    $this->ln();
    $this->SetFont('Arial','', 14);
    $this->cell(264,0, $d, 0, 0, 'R');
    $this->ln();
    $this->SetFont('Arial','', 14);
    $this->cell(250,35, 'Kepala bengkel', 0, 0, 'R');

    $this->ln();
    $this->SetFont('Arial','U', 14);
    $this->cell(255,10, 'Dasep Abdurrahman', 0, 0, 'R');
    $this->ln();
  }
}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L', 'Letter', 0);
$pdf->Output();
?>