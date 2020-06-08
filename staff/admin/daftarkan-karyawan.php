<?php
include("../../connect.php");

$getCheck = mysqli_query($con,"select from users_pegawai where nik = '".mysqli_real_escape_string($con,$_POST['nik'])."' ");
$countCheck = mysqli_num_rows($getCheck);
if($countCheck > 0){
  echo"NIK sudah digunakan dalam database karyawan";
}else{
  $insert = mysqli_query($con,"insert into users_pegawai (nik, nama, alamat, shift, password) values ('".mysqli_real_escape_string($con,$_POST['nik'])."','".mysqli_real_escape_string($con,$_POST['nama'])."','".mysqli_real_escape_string($con,$_POST['alamat'])."','".mysqli_real_escape_string($con,$_POST['shift'])."','".mysqli_real_escape_string($con,$_POST['password'])."') ");
  if($insert){
    echo 1;
  }else{
    echo"Maaf terjadi kesalahan saat menyimpan data karyawan";
  }
}

?>