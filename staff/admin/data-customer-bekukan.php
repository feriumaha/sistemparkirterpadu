<?php
include("../../connect.php");
$email = $_GET['email'];
$id=base64_decode($email);
$delete = mysqli_query($con,$aadc="update users_customer set status='1' where email='$id' ");
if($delete){
  header('location:data-customer.php');
}else{
  echo 0;
}

mysqli_close($con);
?>