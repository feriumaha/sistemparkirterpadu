<?php
  $con=mysqli_connect('localhost','root','','e-parking');
  if(mysqli_connect_errno())
  {
    echo "Check your internet connection: " . mysqli_connect_error();
  }
  date_default_timezone_set('Asia/Jakarta');
  error_reporting(0);
?>