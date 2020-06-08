<script>
window.print();
</script>
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<?php
include("../../connect.php");
$bulan = $_GET['bulan'];
$tahun = $_GET['tahun'];
$tanggal = date("Y/m/d");

//ambil banyak mobil masuk
$getData = mysqli_query($con,"select * from parkir_masuk where month(tanggal_masuk)='$bulan' and year(tanggal_masuk)='$tahun' ");
$count=mysqli_num_rows($getData);
?>
<hr>
<div id="container">
  <center><h3>Laporan E-PARK Periode <?php echo $bulan ?>/<?php echo $tahun ?></h3></center>
  <hr>
  Total Mobil Masuk : <?php echo $count ?>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Tanggal</th>
        <th>Kode Parkir</th>
        <th>Jam Masuk</th>
        <th>Jam Keluar</th>
        <th>Durasi</th>
        <th>Total Bayar</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $no=0;
    $getData = mysqli_query($con,"select * from parkir_masuk where month(tanggal_masuk)='$bulan' and year(tanggal_masuk)='$tahun' ");
    if($count=mysqli_num_rows($getData)){
      while($print=mysqli_fetch_array($getData)){
        $getKeluar = mysqli_query($con,"select * from parkir_keluar where kode_parkir='$print[kode_parkir]' and tanggal_keluar='$print[tanggal_masuk]' ");
        $printKeluar = mysqli_fetch_array($getKeluar);

        //hitung durasi
        $mulai = $print[jam_masuk];
        $selesai = $printKeluar[jam_keluar];
        list($jam,$menit,$detik)=explode(':',$mulai);
        $buatWaktuMulai=mktime($jam,$menit,$detik,1,1,1);

        list($jam,$menit,$detik)=explode(':',$selesai);
        $buatWaktuSelesai=mktime($jam,$menit,$detik,1,1,1);

        $selisihDetik=$buatWaktuSelesai-$buatWaktuMulai;
        $durasi = floor($selisihDetik/3600);

        //htung harga
        $totalproses = $durasi * 5000;
        $total = number_format($totalproses, 0, ".", ".");

        $no++;
        echo"
        <tr>
         <td>$no</td>
         <td>$print[tanggal_masuk]</td>
         <td>$print[kode_parkir]</td>
         <td>$print[jam_masuk]</td>
         <td>$printKeluar[jam_keluar]</td>
         <td>$durasi Jam</td>
         <td>Rp $total</td>
        </tr>
        ";
      }
    }else{
      echo"Data tidak tersedia";
    }
    ?>
    </tbody>
  </table>
</div>