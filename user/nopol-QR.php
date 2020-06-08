<?php
include("../connect.php");
include("../check.php");

$id = $_POST['id'];  
echo"<img src='qrcode/$id.png' width='100%' height='auto'>";
?>