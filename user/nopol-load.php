<?php
include("../connect.php");
include("../check.php");
$no=0;
$email = $_SESSION['SPT-email'];
$getNOPOL = mysqli_query($con,"select * from kendaraan_customer where email = '$email' ");
while($printNOPOL = mysqli_fetch_array($getNOPOL)){
$no++;
echo"
<tr>
 <td>$no</td>
 <td>$printNOPOL[nopol]</td>
 <td><button class='view_data btn btn-primary btn-sm' data-toggle='modal' data-target='#QRCODE' id='$printNOPOL[kode_parkir]'><i class='fas fa-eye'></i></button></td>
</tr>
";
}
?>
<script>
  $(document).ready(function(){
    $('.view_data').click(function(){
      var id = $(this).attr("id");
      $.ajax({
        url: 'nopol-QR.php',
        method: 'post',
        data: {id:id},
        success:function(data){
          $('#data_QR').html(data);
        }
      });
    });
  });
</script>
