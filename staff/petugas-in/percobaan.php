<?php

include("../../connect.php");

$cek3 = mysqli_query($con,"select *, min(kode) from tempat_parkir where status='0' and tanggal='2019/07/04' ");
if($count=mysqli_num_rows($cek3)){
  $print = mysqli_fetch_array($cek3);
  echo $print['min(kode)'];
}
?>