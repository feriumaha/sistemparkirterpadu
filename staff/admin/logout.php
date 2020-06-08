<?php
  session_start();
  unset($_SESSION['EPARK-nik']);
  unset($_SESSION['EPARK-nama']);
  unset($_SESSION['EPARK-sesi']);
  if (isset($_COOKIE['EPARK-nik'])&&isset($_COOKIE['EPARK-nama'])&&isset($_COOKIE['EPARK-sesi'])) {
    setcookie('EPARK-nik', '', time() - 3600,'/');
    setcookie('EPARK-nama', '', time() - 3600,'/');
    setcookie('EPARK-sesi', '', time() - 3600,'/');
  }
  header('location:../');
?>