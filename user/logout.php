<?php
  session_start();
  unset($_SESSION['EPARK-nik']);
  unset($_SESSION['SPT-nama']);
  unset($_SESSION['SPT-sesi']);
  if (isset($_COOKIE['SPT-nik'])&&isset($_COOKIE['SPT-nama'])&&isset($_COOKIE['SPT-sesi'])) {
    setcookie('SPT-nik', '', time() - 3600,'/');
    setcookie('SPT-nama', '', time() - 3600,'/');
    setcookie('SPT-sesi', '', time() - 3600,'/');
  }
  header('location:../');
?>