<?php
include("../../connect.php");
date_default_timezone_set('Asia/Jakarta');
$tanggal = date("Y/m/d");
$jam = date("G:i:s");
$kode_parkir = $_POST['kode_parkir'];

$cekkondisi = mysqli_query($con,"select * from parkir_masuk where kode_parkir = '$kode_parkir' and tanggal_masuk = '$tanggal' ");
if($countCek = mysqli_query($cekkondisi) > 1){
  $cekkondisi2 = mysqli_query($con,"select * from parkir_keluar where kode_parkir = '$kode_parkir' and tanggal_keluar = '$tanggal' ");
  if($countCek2 = mysqli_query($cekkondisi2) < 1){
   echo"
    <div class='alert alert-danger alert-dismissible fade show'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
        <strong>Peringatan!</strong> Anda sudah scan parkir masuk dan belum scan parkir keluar.
    </div>
  ";
  }
}else{
  $cek = mysqli_query($con,"select * from tempat_parkir where status='1' and tanggal='$tanggal'");
   if($count=mysqli_num_rows($cek) < 1){
      $kode = 1;
      $status = 1;
      $insert_tempat_parkir = mysqli_query($con,"insert into tempat_parkir (tanggal, kode, status) values ('".$tanggal."','".$kode."','".$status."') ");
      if($insert_tempat_parkir){
        $insert_parkir_masuk = mysqli_query($con,"insert into parkir_masuk (kode_parkir, tanggal_masuk, jam_masuk, tempat_parkir) values ('".$kode_parkir."','".$tanggal."','".$jam."','".$kode."') ");
        if($insert_parkir_masuk){
          echo"
          <p style='font-size: 400%'><strong>Posisi Parkir : P$kode</strong></p>
         <div class='form-group'>
            <label>Date</label>
            <input type='text' value='$tanggal' class='form-control' disabled='disabled'>
         </div>
         <div class='form-group'>
            <label>Time</label>
            <input type='text' value='$jam' class='form-control' disabled='disabled'>
         </div>
         <div class='alert alert-success alert-dismissible fade show'>
            <button type='button' class='close' data-dismiss='alert'>&times;</button>
            <strong style='font-size: 200%'>GO !!!</strong>
         </div>
          ";
        }
      }
   }else{
     $cek2 = mysqli_query($con,"select * from tempat_parkir where status='1' and tanggal='$tanggal'");
     if($count2=mysqli_num_rows($cek2) > 0){
       $ambilKodeTerakhir = mysqli_query($con,"select * from tempat_parkir order by kode DESC LIMIT 1");
       $print = mysqli_fetch_array($ambilKodeTerakhir);
       $kodekod = $print['kode'];
       if($print['kode'] <= 53){ // penentu Stok 54 slot
         $kode_baru = $kodekod+ 1;
         $status_baru = 1;
         $insert_tempat_parkir2 = mysqli_query($con,"insert into tempat_parkir (tanggal, kode, status) values ('".$tanggal."','".$kode_baru."','".$status_baru."')");
         if($insert_tempat_parkir2){
           $insert_parkir_masuk2 = mysqli_query($con,"insert into parkir_masuk (kode_parkir, tanggal_masuk, jam_masuk, tempat_parkir) values ('".$kode_parkir."','".$tanggal."','".$jam."','".$kode_baru."') ");
           if($insert_parkir_masuk2){
             echo"
                <p style='font-size: 400%'><strong>Posisi Parkir : P$kode_baru</strong></p>
                <div class='form-group'>
                    <label>Date</label>
                    <input type='text' value='$tanggal' class='form-control' disabled='disabled'>
                </div>
                <div class='form-group'>
                    <label>Time</label>
                    <input type='text' value='$jam' class='form-control' disabled='disabled'>
                </div>
                <div class='alert alert-success alert-dismissible fade show'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong style='font-size: 200%'>GO !!!</strong>
                </div>
          ";
           }
         }
       }else{
       $cek3 = mysqli_query($con,"select *, min(kode) from tempat_parkir where status='0' and tanggal='$tanggal' ");
        if(!is_null($count=mysqli_num_rows($cek3))){
            $print3 = mysqli_fetch_array($cek3);
            echo $print3['min(kode)'];
            $status = 1;
            $insert_tempat_parkir3 = mysqli_query($con,"insert into tempat_parkir (tanggal, kode, status) values ('".$tanggal."','".$print3['min(kode)']."','".$status."')");
            if($insert_tempat_parkir3){
              $insert_parkir_masuk3 = mysqli_query($con,"insert into parkir_masuk (kode_parkir, tanggal_masuk, jam_masuk, tempat_parkir) values ('".$kode_parkir."','".$tanggal."','".$jam."','".$print3['min(kode)']."') ");
              if($insert_parkir_masuk3){
                echo"
                <p style='font-size: 400%'><strong>Posisi Parkir : P$print3[kode]</strong></p>
                <div class='form-group'>
                    <label>Date</label>
                    <input type='text' value='$tanggal' class='form-control' disabled='disabled'>
                </div>
                <div class='form-group'>
                    <label>Time</label>
                    <input type='text' value='$jam' class='form-control' disabled='disabled'>
                </div>
                <div class='alert alert-success alert-dismissible fade show'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong style='font-size: 200%'>GO !!!</strong>
                </div>
                ";
              }
            }
        }else{
          echo"
                <p style='font-size: 400%'><strong>Posisi Parkir : MAAF PARKIRAN PENUH</strong></p>
                <div class='alert alert-success alert-dismissible fade show'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <strong style='font-size: 200%'>STOP !!!</strong>
                </div>
          ";
        }

       }
     }
   }

}




?>