<?php
    session_start();
    if (isset($_COOKIE['SPT-email'])&&isset($_COOKIE['SPT-nama'])&&isset($_COOKIE['SPT-sesi'])) {
        $_SESSION['SPT-email'] = $_COOKIE['SPT-email'];
        $_SESSION['SPT-nama'] = $_COOKIE['SPT-nama'];
        $_SESSION['SPT-sesi'] = $_COOKIE['SPT-sesi'];
    } if (!isset($_SESSION['SPT-email'])||!isset($_SESSION['SPT-nama'])||!isset($_SESSION['SPT-sesi'])) {
        echo '<a onclick="location.reload()">Something went wrong. Click this message after re-login to try again</a><script>window.open("../?not=isset","_blank")</script>';

    exit(0);
  } else {
      date_default_timezone_set('Asia/Jakarta');
    if ($_SESSION['SPT-sesi']<>md5(base64_encode(base64_encode(date('yymmdd'))))) {
      header('location:../?not=today');
      exit(0);
    }
  }
?>
