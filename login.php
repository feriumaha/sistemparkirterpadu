<?php
include("connect.php");
include_once('address.php');
$date = date("d/m/Y");

$email = mysqli_real_escape_string($con,$_POST['email']);
$password = mysqli_real_escape_string($con,$_POST['password']);

$getAndCheck = mysqli_query($con,"select * from users_customer where email ='".$email."' and password='".$password."' ");
$count = mysqli_num_rows($getAndCheck);
if($count > 0){
  $print = mysqli_fetch_array($getAndCheck);
  if($print['status']==0){
    session_start();
    $_SESSION['SPT-email'] = $print['email'];
    $_SESSION['SPT-nama'] = $print['username'];
    $_SESSION['SPT-sesi'] = md5(base64_encode(base64_encode(date('yymmdd'))));
    header("Location: user/index.php");
    echo"masuk";
  }else{
    header("Location: ../system_parkir_terpadu/?status=users_blocked");
  }
}else{
  header("Location: ../system_parkir_terpadu/?status=not_found");
  }

mysqli_close('$con');
?>