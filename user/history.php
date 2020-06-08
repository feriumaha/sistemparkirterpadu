<?php
include("../connect.php");
include("../check.php");

$no=0;
$email = $_SESSION['SPT-email'];
$ambil_kode = mysqli_query($con,"select * from kendaraan_customer where email = '$email' ");
$printKode = mysqli_fetch_array($ambil_kode);

$ambil_data = mysqli_query($con,"select * from parkir_masuk where kode_parkir='$printKode[kode_parkir]' ");
while($printData=mysqli_fetch_array($ambil_data)){
  $data_keluar = mysqli_query($con,"select * from parkir_keluar where kode_parkir='$printKode[kode_parkir]' and tanggal_keluar='$printData[tanggal_keluar]'");
  $printKeluar = mysqli_fetch_array($data_keluar);
  $no++;

  $mulai = $printData['jam_masuk'];
  $selesai = $printKeluar['jam_keluar'];

  $mulai = $printActivity[jam_masuk];
  $selesai = $printKeluar[jam_keluar];
  list($jam,$menit,$detik)=explode(':',$mulai);
  $buatWaktuMulai=mktime($jam,$menit,$detik,1,1,1);

  list($jam,$menit,$detik)=explode(':',$selesai);
  $buatWaktuSelesai=mktime($jam,$menit,$detik,1,1,1);

  $selisihDetik=$buatWaktuSelesai-$buatWaktuMulai;
  $durasi = floor($selisihDetik/3600);


  $totalproses = $durasi * 5000;
  $total = number_format($totalproses, 0, ".", ".");

  echo"
  <tr>
   <td>$no</td>
   <td>$printData[tanggal_masuk]</td>
   <td>$printKode[kode_parkir]</td>
   <td>$printData[jam_masuk]</td>
   <td>$printKeluar[jam_keluar]</td>
   <td>$durasi</td>
   <td>Rp $total</td>
  </tr>
  ";

}

 ?>

