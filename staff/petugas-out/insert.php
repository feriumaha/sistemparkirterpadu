<?php
include("../../connect.php");
$date = date("Y/m/d");
date_default_timezone_set('Asia/Jakarta');
$jam = date("G:i:s");

$kode_parkir = $_POST['kode_parkir'];

$cek_masuk = mysqli_query($con,"select * from parkir_masuk where kode_parkir='$kode_parkir' and tanggal_masuk='$date' ");
if($count_masuk=mysqli_num_rows($cek_masuk) > 0){
  $print_masuk = mysqli_fetch_array($cek_masuk);
  $cek_keluar = mysqli_query($con,"select * from parkir_keluar where id_parkir_masuk='$print_masuk[id_parkir_masuk]' and tanggal_keluar='$date' ");
  if($count_keluar=mysqli_num_rows($cek_keluar) > 0){
    echo"<h3>Anda sudah scan keluar</h3>";
  }else{
    $insert = mysqli_query($con,"insert into parkir_keluar (id_parkir_masuk, kode_parkir, jam_keluar, tanggal_keluar) values ('".$print_masuk['id_parkir_masuk']."','".$kode_parkir."','".$jam."','".$date."')");
    if($insert){
      $update = mysqli_query($con,"update tempat_parkir set status='0' where kode='$print_masuk[tempat_parkir]' ");
      if($update){
        $get_keluar = mysqli_query($con,"select * from parkir_keluar where id_parkir_masuk='$print_masuk[id_parkir_masuk]' and tanggal_keluar='$date'  ");
        $print_keluar = mysqli_fetch_array($get_keluar);
       //hitung durasi
        $mulai = $print_masuk['jam_masuk'];
        $selesai = $print_keluar['jam_keluar'];
        list($jam,$menit,$detik)=explode(':',$mulai);
        $buatWaktuMulai=mktime($jam,$menit,$detik,1,1,1);

        list($jam,$menit,$detik)=explode(':',$selesai);
        $buatWaktuSelesai=mktime($jam,$menit,$detik,1,1,1);

        $selisihDetik=$buatWaktuSelesai-$buatWaktuMulai;
        $durasi = floor($selisihDetik/3600);

        //htung harga
        $totalproses = $durasi * 5000;
        $total = number_format($totalproses, 0, ".", ".");

        echo"
          <p style='font-size: 250%'><strong>Posisi Parkir : TERIMAKASIH</strong></p>
         <div class='form-group'>
            <label>Date</label>
            <input type='text' value='$date' class='form-control' disabled='disabled'>
         </div>
         <div class='form-group'>
            <label>Time in</label>
            <input type='text' value='$print_masuk[jam_masuk]' class='form-control' disabled='disabled'>
         </div>
         <div class='form-group'>
            <label>Time out</label>
            <input type='text' value='$print_keluar[jam_keluar]' class='form-control' disabled='disabled'>
         </div>
         <div class='form-group'>
            <label>Durasi</label>
            <input type='text' value='$durasi' class='form-control' disabled='disabled'>
         </div>
         <div class='form-group'>
            <label>Total</label>
            <h6>$total</h6>
         </div>
         <div class='alert alert-success alert-dismissible fade show'>
            <button type='button' class='close' data-dismiss='alert'>&times;</button>
            <strong style='font-size: 200%'>GO !!!</strong>
         </div>
          ";
      }
    }
  }
}else{
  echo"<h3>Anda belum scan masuk</h3>";
}
?>