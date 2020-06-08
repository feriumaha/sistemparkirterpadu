<?php
    session_start();
    if (isset($_COOKIE['EPARK-nik'])&&isset($_COOKIE['EPARK-nama'])&&isset($_COOKIE['EPARK-sesi'])) {
        $_SESSION['EPARK-nik'] = $_COOKIE['EPARK-nik'];
        $_SESSION['EPARK-nama'] = $_COOKIE['EPARK-nama'];
        $_SESSION['EPARK-sesi'] = $_COOKIE['EPARK-sesi'];
    } if (!isset($_SESSION['EPARK-nik'])||!isset($_SESSION['EPARK-nama'])||!isset($_SESSION['EPARK-sesi'])) {
        echo '<a onclick="location.reload()">Something went wrong. Click this message after re-login to try again</a><script>window.open("../../staff?not=isset","_blank")</script>';

    exit(0);
  } else {
      date_default_timezone_set('Asia/Jakarta');
    if ($_SESSION['EPARK-sesi']<>md5(base64_encode(base64_encode(date('yymmdd'))))) {
      header('location:../../staff?not=today');
      exit(0);
    }
  }
?>
