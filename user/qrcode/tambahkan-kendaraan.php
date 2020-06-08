<?php
include("../../connect.php");
include("../../check.php");
include("../phpqrcode/qrlib.php");

$nopol = mysqli_real_escape_string($con,$_POST['nopol']);

function acak($panjang)
{
    $karakter= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789';
    $string = '';
    for ($i = 0; $i < $panjang; $i++) {
  $pos = rand(0, strlen($karakter)-1);
  $string .= $karakter{$pos};
    }
    return $string;
}
//cara memanggilnya
$random= acak(4);

$kode_parkir = $random.$nopol;

$insert = mysqli_query($con,"insert into kendaraan_customer (email, nopol, kode_parkir) values ('".$_SESSION['SPT-email']."','".$nopol."','".$kode_parkir."') ");
if($insert){
  echo 1;
  QRcode::png("$kode_parkir","$kode_parkir.png","H",4,4);
}else{
  echo 0;
}

?>