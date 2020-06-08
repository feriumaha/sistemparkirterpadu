<?php

include("../../connect.php");
$st = 1;
$cek3 = mysqli_query($con,"select *, min(kode) from tempat_parkir where status='1' and tanggal='2019/07/03' ");
if($count=mysqli_num_rows($cek3)){
  $print = mysqli_fetch_array($cek3);
  echo $print['min(kode)'];
  echo $print['kode'];
}
?>