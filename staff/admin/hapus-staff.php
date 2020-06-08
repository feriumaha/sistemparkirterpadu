<?php
include("../../connect.php");
include("../check.php");

$nik = $_POST['nik'];
$delete = mysqli_query($con,"delete from users_pegawai where nik = '".$nik."'");
if($delete){
  echo"Staff berhasil dihapus";
}else{
  echo"Error";
}
?>