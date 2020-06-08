<?php
include("../../connect.php");
include("../check.php");
$date = date("d/M/Y");
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SPT | Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <!--Jquery for ajax-->
  <script src="js/jquery.min.js"></script>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <?php
    include("nav.php");
    ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>


          <?php include("nav-top.php");?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Staff</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <div class="col-lg-12 mb-4">

              <!-- Approach -->
              <div class="card shadow mb-4">
                <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>NIK</th>
                      <th>Nama</th>
                      <th>Alamat</th>
                      <th>Shift</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>NIK</th>
                      <th>Nama</th>
                      <th>Alamat</th>
                      <th>Shift</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php
                    $getInfo = mysqli_query($con,"select * from users_pegawai order by nik");
                    while($printPegawai=mysqli_fetch_array($getInfo)){
                    ?>
                    <tr>
                      <td><?php echo $printPegawai['nik']; ?></td>
                      <td><?php echo $printPegawai['nama']; ?></td>
                      <td><?php echo $printPegawai['alamat']; ?></td>
                      <td><?php echo $printPegawai['shift']; ?></td>
                      <td><?php if($printPegawai['status']==0){echo"Akun Aktif";}else{echo"Akun diblokir";} ?></td>
                      <td>
                        <button class="btn btn-primary btn-sm" title="Laporan" data-toggle="modal" data-target="#myLaporan"><i class='fas fa-list-alt'></i></button>
                        <button class="btn btn-warning btn-sm" title="Bekukan Akun"><i class='fas fa-lock'></i></button>
                        <button class="btn btn-danger btn-sm" title="Hapus Akun & Data" id="hapus" onclick='hapus("<?php echo $printPegawai['nik']?>")'><i class='far fa-trash-alt'></i></button>
                      </td>
                    </tr>
                    <?php }?>
                  </tbody>
                </table>
              </div>
            </div>

              </div>

            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include("footer.php"); ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

<script>
function hapus(nik) {
$.ajax({
      type: 'POST',
      data: 'nik='+nik,
      url: 'hapus-staff.php',
      success: function(result) {
        var response = JSON.parse(result);
        if(response.status){
          alert('berhasil');
          var table = document.getElementById ("dataTable");
          table.refresh ();
        }else{
          alert('gagal');
        }
      }
    });
}
</script>

 <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

<!--Modal Laporan -->
<!-- The Modal -->
  <div class="modal fade" id="myLaporan">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Laporan</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          Modal body..
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>
<!--End Modal Laporan-->

</body>

</html>
<?php
mysqli_close('$con');
?>