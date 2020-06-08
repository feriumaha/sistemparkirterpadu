<?php
include("../../connect.php");
$date = date("Y/m/d");

$get = mysqli_query($con,"select * from tempat_parkir where status='1' and tanggal='$tanggal'");
$count = mysqli_num_rows($get);
if($count < 1){
  $set = 3;
  $sisa = $set - $count;
  echo $sisa;
}
?>