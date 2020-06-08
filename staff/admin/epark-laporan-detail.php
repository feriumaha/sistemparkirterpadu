<?php
include("../../connect.php");
$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];
$tanggal = date("Y/m/d");

//ambil banyak mobil masuk
$getData = mysqli_query($con,"select * from parkir_masuk where month(tanggal_masuk)='$bulan' and year(tanggal_masuk)='$tahun' ");
$count=mysqli_num_rows($getData);
?>

<a class="btn btn-danger" href="epark-laporan-print.php?bulan=<?php echo $bulan ?>&tahun=<?php echo $tahun?>" target="_blank">PRINT</a>
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