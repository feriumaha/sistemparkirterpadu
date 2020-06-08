<?php
include("../../connect.php");
$hitung = mysqli_query($con,"select * from parkir_masuk where tanggal_masuk = '$tanggal' ");
$printHitung = mysqli_num_rows($hitung);
echo $printHitung;

mysqli_close($con);
?>