<?php
include("../../connect.php");
?>
<table class="table">
    <thead>
      <tr>
        <th>Plat Nomor</th>
        <th>Kode Parkir</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $id = $_POST['id'];
      echo $id;
      $getData = mysqli_query($con,"select * from kendaraan_customer where email='$id'");
      while($print=mysqli_fetch_array($getData)){
        echo"
        <tr>
        <td>$print[nopol]</td>
        <td>$print[kode_parkir]</td>
        </tr>";
      }
      ?>
    </tbody>
  </table>