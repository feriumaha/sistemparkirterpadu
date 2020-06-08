<?php
include("../connect.php");
include_once('address.php');
$date = date("d/m/Y");

$nik = mysqli_real_escape_string($con,$_POST['nik']);
$password = md5(mysqli_real_escape_string($con,$_POST['password']));

$getAndCheck = mysqli_query($con,"select * from users_pegawai where nik ='".$nik."' and password='".$password."' ");
$count = mysqli_num_rows($getAndCheck);
if($count > 0){
  $print = mysqli_fetch_array($getAndCheck);
  if($print['admin']==1){
    session_start();
    $_SESSION['EPARK-nik'] = $print['nik'];
    $_SESSION['EPARK-nama'] = $print['nama'];
    $_SESSION['EPARK-sesi'] = md5(base64_encode(base64_encode(date('yymmdd'))));
    header("Location: admin/index.php");
  }else{
    header("Location: petugas/");
  }
}else{
  header("Location: ../staff?status=not_found");
  }

mysqli_close('$con');
?>