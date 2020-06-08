<?php
include("../../connect.php");
include("../check.php");
$tanggal = date("Y/m/d");
 $getParkingActivity = mysqli_query($con,"select * from parkir_masuk where tanggal_masuk='$tanggal'");
 while($printActivity = mysqli_fetch_array($getParkingActivity)){
   $getKeluar = mysqli_query($con,"select * from parkir_keluar where kode_parkir='$printActivity[kode_parkir]' and tanggal_keluar='$printActivity[tanggal_masuk]' ");
   $printKeluar = mysqli_fetch_array($getKeluar);

   //hitung durasi
        $mulai = $printActivity[jam_masuk];
        $selesai = $printKeluar[jam_keluar];
        list($jam,$menit,$detik)=explode(':',$mulai);
        $buatWaktuMulai=mktime($jam,$menit,$detik,1,1,1);

        list($jam,$menit,$detik)=explode(':',$selesai);
        $buatWaktuSelesai=mktime($jam,$menit,$detik,1,1,1);

        $selisihDetik=$buatWaktuSelesai-$buatWaktuMulai;
        $durasi = floor($selisihDetik/3600);

        //htung harga
        $totalproses = $durasi * 5000;
        $total = number_format($totalproses, 0, ".", ".");

   echo"<tr>
  <td>$printActivity[kode_parkir]</td>
  <td>$printActivity[tanggal_masuk]</td>
  <td>$printActivity[jam_masuk]</td>
  <td>$printKeluar[jam_keluar]</td>
  <td>$durasi Jam</td>
  <td>Rp $total</td>
 </tr>";
 }
 ?>

