<?php
include("../../connect.php");
$date = date("Y/m/d");

$set=54;
$get = mysqli_query($con,"select * from tempat_parkir where status='1' and tanggal='$date'");
$count = mysqli_num_rows($get);
if($count == 0){
  $sisa = $set - $count;
  echo $sisa;
}else{
  $sisa2=$set - $count;
  echo $sisa2;
}
?>