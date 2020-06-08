<?php
include("../../connect.php");
$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];

// Koneksi library FPDF
require('fpdf/fpdf.php');
// Setting halaman PDF
$pdf = new FPDF('l','mm','A5');
// Menambah halaman baru
$pdf->AddPage();
// Setting jenis font
$pdf->SetFont('Arial','B',16);
$pdf->Cell(190,7,'Laporan E-PARK',0,1,'C');

$pdf->SetFont('Arial','B',9);
$pdf->Cell(190,7,'Periode',0,1,'C');

// Setting spasi kebawah supaya tidak rapat
$pdf->Cell(10,7,'',0,1);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,6,'#',1,0);
$pdf->Cell(35,6,'Tanggal',1,0);
$pdf->Cell(35,6,'Kode Parkir',1,0);
$pdf->Cell(25,6,'Jam Masuk',1,0);
$pdf->Cell(25,6,'Jam Keluar',1,0);
$pdf->Cell(25,6,'Durasi',1,0);
$pdf->Cell(35,6,'Total Bayar',1,1);

$pdf->SetFont('Arial','',10);
$query = mysqli_query($con, "select * from parkir_masuk where month(tanggal_masuk)='".$_POST['bulan']."' and year(tanggal_masuk)='".$_POST['tahun']."'");
while ($row = mysqli_fetch_array($query)){
    $pdf->Cell(10,6,$row[''],1,0);
    $pdf->Cell(50,6,$row['tanggal_masuk'],1,0);
    $pdf->Cell(35,6,$row[''],1,0);
    $pdf->Cell(30,6,$row[''],1,0);
    $pdf->Cell(25,6,$row[''],1,0);
    $pdf->Cell(25,6,$row[''],1,1);
}

$pdf->Output();
?>